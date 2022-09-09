<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = auth()->user()->permissions;
        $permissions = auth()->user()->getPermissionsViaRoles();
        $permissions = auth()->user()->getAllPermissions();

        return $permissions;
    }
}
