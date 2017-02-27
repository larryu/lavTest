<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class MenuController extends Controller
{

    public function show(Request $request)
    {
        // 1) first get user from token to check validation
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $userId = $user->email;

        // 2) get all menus
        $menus = Menu::where('active', 1)->get(['*', DB::raw("'RW' as permission")])->keyBy('id')->toArray();
        //$treeMenus = Menu::buildTreeMenus($menus, 'id', 'parent_id');
        $treeMenus = Menu::getTreeMenus($menus, 'parent_id', 'id');

        // 2) get accessible menus based on user
        $aclMenus = $user->getAclMenus();

        // 3) rebuild menus
        $mergedMenus = array_replace($menus, $aclMenus);

        // 4) build tree menus
        $treeMenus = Menu::getTreeMenus($mergedMenus, 'parent_id', 'id');
        return response()->json([
            'menus' => $treeMenus,
        ]);
    }

}
