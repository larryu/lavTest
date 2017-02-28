<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'created_by', 'updated_by', 'updated_at', 'active',
    ];

    /**
     * @param $flat
     * @param $pidKey
     * @param null $idKey
     * @return mixed
     */
    static public function getTreeMenus($flat, $pidKey, $idKey = null)
    {
        $grouped = array();
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

        $tree = $fnBuilder($grouped[0]);

        return $tree;
    }

    /**
     * @param array $array
     * @param string $idKeyName
     * @param string $parentIdKey
     * @param string $childNodesField
     * @return array
     */
    static public function buildTreeMenus(array $array, $idKeyName = 'id', $parentIdKey = 'parent_id', $childNodesField = 'children')
    {
        $indexed = array();
        // first pass - get the array indexed by the primary id
        foreach ($array as $row) {
            $indexed[$row[$idKeyName]]                   = $row;
            $indexed[$row[$idKeyName]][$childNodesField] = array();
        }
        // second pass
        $root = array();
        foreach ($indexed as $id => $row) {
            $indexed[$row[$parentIdKey]][$childNodesField][$id] = &$indexed[$id];
            if (!$row[$parentIdKey]) {
                $root[$id] = &$indexed[$id];
            }
        }
        return $root;
    }

    /**
     * Get all of the menu's resources.
     */
    public function resources()
    {
        return $this->morphMany(GroupResourcePermission::class, 'resource', 'resource_type_id', 'resource_id')->where('active',1);
    }


}
