<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Get the groups associated with the user.
     */
    public function groups()
    {
        return $this->hasMany(Group::class)->where('active',1);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->where('active',1);
    }
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
    /**
     * @param $flat
     * @param $pidKey
     * @param null $idKey
     * @return mixed
     */
    static public function getTreeRoles($flat, $pidKey, $idKey = null)
    {
        $grouped = array();
        $rootId = $flat[0]['parent_id'];
        foreach ($flat as $sub){
            $grouped[$sub[$pidKey]][] = $sub;
        }
        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if(isset($grouped[$id])) {
                    $sibling['children'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }

            return $siblings;
        };
        $tree = $fnBuilder($grouped[$rootId]);

        return $tree;
    }
}
