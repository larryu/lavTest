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

    $user = App\Models\User::find(13);

    // 1) get the role of the user
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

                $treeRoles = App\Models\Role::getTreeRoles($rets, 'parent_id', 'id');
                $roleRets[$role->id] = $treeRoles;
            }
        }
    }

    // 5) return processes
    return response()->json([
        'roles' => $roleRets,
    ]);


});

//Route::get('/test/users', 'UserController@lists');


