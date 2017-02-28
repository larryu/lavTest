<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['name'] = $request->user()->name;
        $data['email'] = $request->user()->email;
        return response()->json([
            'data' => $data,
        ]);
    }
    public function show(Request $request)
    {
        $user = $request->user();
        $roles = $user->roles();
        $roleNames = [];
        foreach($roles as $role)
        {
            $roleNames[] = $role->name;
        }
        $roleName = implode(', ', $roleNames);
        $user['role'] = $roleName;
        return $user;
    }
    public function lists(Request $request)
    {
        // 1) first get user from token to check validation
        // $user = JWTAuth::parseToken()->authenticate();
        $user = $request->user();

        return $user;


    }
    
}
