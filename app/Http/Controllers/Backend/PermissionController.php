<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // single action controller, to only display permission
    public function __invoke()
    {
        // $permissions = Permission::orderBy('id', 'asc')->paginate(8);
        $permissions = Permission::orderBy('id', 'asc')->paginate(8);
        return view('backend.permission.index', [
            'permissions' => $permissions,
        ]);
    }
}
