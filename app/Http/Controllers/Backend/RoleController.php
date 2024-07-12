<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(8);
        return view('backend.role.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('backend.role.partials.form', [
            'permissions' => Permission::orderby('created_at', 'desc')->get(),
        ]);
    }

    public function store(RoleRequest $req)
    {
        try {
            $req->validated();
            if ($req->slug !== Str::slug($req->slug, '-')) {
                return redirect()->route('backend.role.create')->with('error', 'The slug is not valid')->withInput();
            }
            $role = Role::create([
                'name' => $req->name,
                'slug' => $req->slug,
            ]);

            if ($req->has('permission')) {
                $role->permission()->sync($req->permission);
            }

            return redirect()->route('backend.role.index')->with('success', 'New role has been created successfully');
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $permissions = Permission::orderby('created_at', 'desc')->get();
            $selectedPermissions = $role->permissions->pluck('id')->toArray();
            return view('backend.role.partials.form', [
                'role' => $role,
                'permissions' => $permissions,
                'selectedPermissions' => $selectedPermissions,
            ]);
        } catch (ModelNotFoundException $err) {
            return redirect()->back()->with('error', 'Role not found');
        } catch (Exception $err) {
            return redirect()->route('backend.role.index')->with('error', $err->getMessage());
        }
    }

    public function update(RoleRequest $req, string $id)
    {
        // dd($req->permission);
        try {
            $req->validated();
            if ($req->slug !== Str::slug($req->slug, '-')) {
                return redirect()->route('backend.role.create')->with('error', 'The slug is not valid')->withInput();
            }
            $role = Role::findOrFail($id);
            $role->update(
                [
                    'name' => $req->name,
                    'slug' => $req->slug
                ]
            );

            if ($req->has('permission')) {
                $role->permissions()->sync($req->permission);
            }

            return redirect()->route('backend.role.index')->with('success', 'Role has been updated successfully');
        } catch (ModelNotFoundException $err) {
            return redirect()->route('backend.role.index')->with('error', 'Role not found');
        } catch (Exception $err) {
            return redirect()->back()->with('error', 'Failed to update role : ' . $err)->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return redirect()->route('backend.role.index')->with('success', 'Role has been deleted successfully');
        } catch (ModelNotFoundException $err) {
            return redirect()->back()->with('error', 'Role not found');
        } catch (Exception $err) {
            return redirect()->back()->with('error', 'Failed to delete role');
        }
    }
}
