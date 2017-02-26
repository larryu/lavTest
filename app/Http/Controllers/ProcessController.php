<?php
namespace App\Http\Controllers;
use App\Models\Component;
use App\Models\Process;
use App\Models\ResourceType;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class ProcessController extends Controller
{
    public function show(Request $request)
    {
        $rules = [
            'componentName' => 'required'
        ];
        $this->validate($request, $rules);
        $componentName = $request->input('componentName');

        $component = Component::where('name', $componentName)->where('active', 1)->first();

        // 1) first get user from token to check validation
        $user = JWTAuth::parseToken()->authenticate();

        // 2) get all processes belongs to this component
        $processes = Process::where('active', 1)->where('component_id', $component->id)
            ->get(['*', DB::raw('"RW" as permission')])->keyBy('id')->toArray();
        // 2) get accessible processes based on user
        $aclProcesses = $user->getAclResourceByType(ResourceType::PROCESS);
        // 3) rebuild $mergedProcesses
        // replace the first array with keys on in first array
        $mergedProcesses = array_replace($processes, array_intersect_key($aclProcesses, $processes));

        // 4) rebuild processes with name key
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
            'processes' => json_encode($namedProcesses),
        ]);
    }
}
