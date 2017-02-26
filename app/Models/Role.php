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
}
