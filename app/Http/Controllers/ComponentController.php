<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Page;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class ComponentController extends Controller
{
    public function show(Request $request)
    {
        $rules = [
            'pageName' => 'required'
        ];
        $this->validate($request, $rules);
        $pageName = $request->input('pageName');
        $page = Page::where('name', $pageName)->first();

        // 1) first get user from token to check validation
        $user = JWTAuth::parseToken()->authenticate();

        // 2) get all components belongs to this page
        $components = Component::where('active', 1)->where('page_id', $page->id)
                                 ->get(['*', DB::raw('"RW" as permission')])->keyBy('id')->toArray();
        // 2) get accessible components based on user
        $aclComponents = $user->getAclComponents();
        // 3) rebuild $mergedComponents
        // replace the first array with keys on in first array
        // $mergedComponents = array_replace($components, $aclComponents);
        $mergedComponents = array_replace($components, array_intersect_key($aclComponents, $components));
        // 4) rebuild components with name key
        $namedComponents = [];
        foreach($mergedComponents as $component)
        {
            if (isset($namedComponents[$component['name']]))
            {
                //error
                return response()->json([
                    'error' => 'Duplicated component name found in this page!',
                ]);
            }
            else
                $namedComponents[$component['name']] = $component;
        }
        // 5) return components
        return response()->json([
            'components' => json_encode($namedComponents),
        ]);
    }
}
