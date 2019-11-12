<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PrivilegesController extends Controller
{
    public function createPrivileges(){
        Permission::create(['name' => 'view_colors']);
    }

    public function assignPrivileges(){
        $role = Role::findById(1);
        $permission = Permission::findById(6);
        $role->givePermissionTo($permission);
    }
}
