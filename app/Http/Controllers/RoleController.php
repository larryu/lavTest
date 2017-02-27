<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class RoleController extends Controller
{
    public function lists(Request $request)
    {
        // 1) first get user from token to check validation
        $user = JWTAuth::parseToken()->authenticate();
        // $user = $request->user();

        // 2) get current roles
        $roles = $user->roles();

        // 3) check whether the roles have children
        $rawSql = "
                WITH ret AS(
                  SELECT  *
                  FROM    roles
                  WHERE   id = ?
                  UNION ALL
                  SELECT  t.*
                  FROM  roles t INNER JOIN
                        ret r ON t.parent_id = r.id
                )
                SELECT  *
                FROM    ret where id <> ?
        ";
        $roleRets = [];
        foreach($roles as $role){
            $ret = DB::select($rawSql, array($role->id, $role->id));
            if (count($ret) > 1)
            {
                $roleRets[] = $ret;
            }
        }

        // 4) return processes
        return response()->json([
            'roles' => $roleRets,
        ]);
    }
}
