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

Route::get('/test/test', function() {


        $user = App\Models\User::find(14);

    // 2) get all processes belongs to this component
    $processes = App\Models\Process::where('active', 1)->where('component_id', 4)
        ->get(['*', DB::raw('"RW" as permission')])->keyBy('id')->toArray();

    // 2) get accessible processes based on user
    $aclProcesses = $user->getAclResourceByType(App\Models\ResourceType::PROCESS);
    // 3) rebuild $mergedProcesses
    // replace the first array with keys on in first array
    // $mergedComponents = array_replace($components, $aclComponents);
    $mergedProcesses = array_replace($processes, array_intersect_key($aclProcesses, $processes));
    // 4) rebuild components with name key
    $namedProcesses = [];
    foreach($mergedProcesses as $process)
    {
        if (isset($namedProcesses[$process['name']]))
        {
            //error
            return response()->json([
                'error' => 'Duplicated process name found in this page!',
            ]);
        }
        else
            $namedProcesses[$process['name']] = $process;
    }
    // 5) return processes
    return response()->json([
        'processes' => $namedProcesses,
    ]);

});



