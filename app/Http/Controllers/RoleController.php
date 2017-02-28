<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Role;
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
                FROM    ret order by id asc
        ";

        $roleRets = [];
        foreach($roles as $role)
        {
            if ($role->canEdit) {
                $rets = DB::select($rawSql, array($role->id));
                $rets = json_decode(json_encode($rets), true);
                if (count($rets) > 0) {
                    $treeRoles = Role::getTreeRoles($rets, 'parent_id', 'id');
                    $roleRets[$role->id] = $treeRoles;
                }
            }
        }
        // 4) return processes
        return response()->json([
            'assingedRoles' => json_encode($roles),
            'childRoles' => json_encode($roleRets),
        ]);
    }
}
