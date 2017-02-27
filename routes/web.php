<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{vue_capture?}', function () {
    return view('welcome');
});

Route::get('/test/users', function() {

    $user = App\Models\User::find(14);

    // 1) get the role of the user
    $roles = $user->roles();

    // 2) check whether the roles have children
    foreach($roles as role){

    }

    // 5) return processes
    return response()->json([
        'users' => $roles,
    ]);


});

//Route::get('/test/users', 'UserController@lists');


