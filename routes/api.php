<?php

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\UserGroup;
use App\Models\Process;
use App\Models\Menu;

Route::post('authenticate', 'Auth\AuthController@authenticate');

Route::group(['middleware' => 'jwt.auth'], function()
{
    Route::get('user', 'UserController@show');
    Route::post('user/profile/update', 'UserController@updateProfile');
    Route::post('user/password/update', 'UserController@updatePassword');
    Route::get('menus', 'MenuController@show');
    Route::get('tabs', 'TabController@show');
    Route::get('components', 'ComponentController@show');
    Route::get('processes', 'ProcessController@show');
});

Route::get('roles', function() {
    return Role::all();
});


Route::get('user_groups', function() {
    return UserGroup::all();
});


// Route::get('menus', function() {
//     return Menu::all();
// });


//Route::get('menus', 'MenuController@show');