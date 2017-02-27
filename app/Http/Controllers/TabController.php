<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tab;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class TabController extends Controller
{
    public function show(Request $request)
    {
        // 1) first get user from token to check validation
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $userId = $user->email;

        // 2) get all tabs
        $tabs = Tab::where('active', 1)->get(['*', DB::raw("'RW' as permission")])->keyBy('id')->toArray();

        // 2) get accessible tabs based on user
        $aclTabs = $user->getAclTabs();

        // 3) rebuild tabs
        $mergedTabs = array_replace($tabs, $aclTabs);

        // 4) return tabs
        return response()->json([
            'tabs' => $mergedTabs,
        ]);
    }
}
