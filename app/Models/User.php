<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserGroup;
use App\Models\Group;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'active', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    /**
     * Get the usergroups associated with the user.
     */
    public function usergroups()
    {
        return $this->hasMany('App\Models\UserGroup')->where('active',1);
    }
    /**
     * Get the groups associated with the user.
     */
    public function groups()
    {
        // return $this->hasManyThrough(Group::class, UserGroup::class, 'user_id', 'group_id', 'id');
        $groups = Group::join('user_group', 'groups.id', '=', 'user_group.group_id')
            ->whereRaw('user_group.user_id = ? and user_group.active = 1 and groups.active = 1', [$this->id])
            ->get(['groups.*']);
        return $groups;
    }
    /**
     * Get the roles associated with the user.
     */
    public function roles()
    {
        // return $this->hasManyThrough(Group::class, UserGroup::class, 'user_id', 'group_id', 'id');
        $roles = Role::join('groups', 'groups.role_id', '=', 'roles.id')
            ->join('user_group', 'groups.id', '=', 'user_group.group_id')
            ->whereRaw('user_group.user_id = ? and roles.active = 1 and groups.active = 1 and user_group.active = 1', [$this->id])
            ->orderBY('roles.id', 'asc')
            ->get(['roles.*']);
        return $roles;
    }
    /**
     * Get accessible menus
     * @return array
     */
    public function getAclMenus()
    {
        $menus = [];
        $groups = $this->groups();
        foreach($groups as $group)
        {
            //$resMenus = $group->groupMenuResourcePermissions();
            $resMenus = $group->groupResourcePermissionsByType(ResourceType::MENU);
            foreach($resMenus as $resMeu)
            {
                //$newObj = new \stdClass();
                $newObj = $resMeu->resource;
                $newObj->permission = $resMeu->permission->name;
                if (isset($menus[$newObj->id]))
                {
                    $existingMenu = $menus[$newObj->id];
                    $existingMenu['permission'] = Permission::getHigherPermission($existingMenu['permission'],
                        $newObj->permission);
                }
                else
                    $menus[$newObj->id] = $newObj->toArray();
            }
        }
        return $menus;
    }
    /**
     * Get accessible tabs
     * @return array
     */
    public function getAclTabs()
    {
        $tabs = [];
        $groups = $this->groups();

        foreach($groups as $group)
        {
            //$resTabs = $group->groupTabResourcePermissions();
            $resTabs = $group->groupResourcePermissionsByType(ResourceType::TAB);
            foreach($resTabs as $resTab)
            {
                //$newObj = new \stdClass();
                $newObj = $resTab->resource;
                $newObj->permission = $resTab->permission->name;
                if (isset($tabs[$newObj->id]))
                {
                    $existingTab = $tabs[$newObj->id];
                    $existingTab['permission'] = Permission::getHigherPermission($existingTab['permission'],
                        $newObj->permission);
                }
                else
                    $tabs[$newObj->id] = $newObj->toArray();
            }
        }
        return $tabs;
    }
    /**
     * Get accessible components
     * @return array
     */
    public function getAclComponents()
    {
        $components = [];
        $groups = $this->groups();

        foreach($groups as $group)
        {
            $resComponents = $group->groupResourcePermissionsByType(ResourceType::COMPONENT);
            foreach($resComponents as $resComponent)
            {
                //$newObj = new \stdClass();
                $newObj = $resComponent->resource;
                $newObj->permission = $resComponent->permission->name;
                if (isset($components[$newObj->id]))
                {
                    $existingComponent = $components[$newObj->id];
                    $existingComponent['permission'] = Permission::getHigherPermission($existingComponent['permission'],
                        $newObj->permission);
                }
                else
                    $components[$newObj->id] = $newObj->toArray();
            }
        }
        return $components;
    }
    /**
     * Get accessible processes
     * @return array
     */
    public function getAclProcesses()
    {
        $processes = [];
        $groups = $this->groups();

        foreach($groups as $group)
        {
            $resProcesses= $group->groupResourcePermissionsByType(ResourceType::PROCESS);
            foreach($resProcesses as $resProcesse)
            {
                $newObj = $resProcesse->resource;
                $newObj->permission = $resProcesse->permission->name;
                if (isset($processes[$newObj->id]))
                {
                    $existingProcess = $processes[$newObj->id];
                    $existingProcess['permission'] = Permission::getHigherPermission($existingProcess['permission'],
                        $newObj->permission);
                }
                else
                    $processes[$newObj->id] = $newObj->toArray();
            }
        }
        return $processes;
    }
    /**
     * Get accessible resources
     * @return array
     */
    public function getAclResourceByType($resourceType)
    {
        $resRets = [];
        $groups = $this->groups();

        foreach($groups as $group)
        {
            $resources= $group->groupResourcePermissionsByType($resourceType);
            foreach($resources as $resource)
            {
                $newObj = $resource->resource;
                $newObj->permission = $resource->permission->name;
                if (isset($resRets[$newObj->id]))
                {
                    $existingRes = $resRets[$newObj->id];
                    $existingRes['permission'] = Permission::getHigherPermission($existingRes['permission'],
                        $newObj->permission);
                }
                else
                    $resRets[$newObj->id] = $newObj->toArray();
            }
        }
        return $resRets;
    }
}
