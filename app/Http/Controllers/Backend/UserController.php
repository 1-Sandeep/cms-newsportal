<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $logged_in_user = auth()->user()->id;
        $users = User::where('id', '!=', $logged_in_user)->where('trash', 0)->orderBy('id', 'asc')->paginate(8);
        return view('backend.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view('backend.user.partials.form', [
            'roles' => $roles
        ]);
    }

    public function store(UserRequest $req)
    {
        try {
            $req->validated();
            $img_name = null;
            if ($req->has('image')) {
                $img_file = $req->file('image');
                $img_ext = $img_file->getClientOriginalExtension();
                $img_name = time() . $img_ext;
                $img_file->move(public_path('uploads/users'));
            }
            $user = new User([
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'image' => $img_name,
                'is_active' => $req->has('is_active') ? (int) $req->is_active : 0
            ]);
            $user->save();

            if ($req->has('role')) {
                $user->roles()->sync($req->role);
            }

            return redirect()->route('backend.user.index')->with('success', 'New user created successfully');
        } catch (Exception $err) {
            return redirect()->back()->with('error', 'Failed to add new user')->withInput();
        }
    }


    public function edit(string $id)
    {
        try {
            $user = User::where('trash', 0)->findOrFail($id);
            $roles = Role::orderBy('created_at', 'desc')->get();
            $selectedRole = $user->roles->first()->id ?? null;

            return view('backend.user.partials.form', [
                'user' => $user,
                'roles' => $roles,
                'selectedRole' => $selectedRole
            ]);
        } catch (Exception $err) {
            return view('backend.user.index')->with('error', 'Failed to get user');
        }
    }

    public function update(UserRequest $req, string $id)
    {
        try {
            $req->validated();
            $user = User::where('trash', 0)->findOrFail($id);
            $img_name = $user->image;
            if ($req->hasFile('image')) {
                $img_file = $req->file('image');
                $img_ext = $img_file->getClientOriginalExtension();
                $img_name = time() . "." . $img_ext;
                $img_file->move(public_path('uploads/users'), $img_name);
            }

            $data = [
                'name' => $req->name,
                'email' => $req->email,
                'is_active' => $req->has('is_active') ? (int) $req->is_active : 0,
                'image' => $img_name,
            ];

            if ($req->filled('password')) {
                $data['password'] = Hash::make($req->input('password'));
            }

            $user->update($data);

            if ($req->has('role')) {
                $user->roles()->sync($req->role);
            }


            return redirect()->route('backend.user.index')->with('success', 'User has been updated successfully');
        } catch (Exception $err) {
            return redirect()->back()->with('error', 'Failed to update user')->withInput();
        }
    }


    public function destroy(string $id)
    {
        try {
            $user = User::where('trash', 1)->findOrFail($id);
            $user->delete();
            return redirect()->route('backend.user.index')->with('success', 'User has been deleted successfully');
        } catch (Exception $err) {
            return redirect()->route('backend.user.index')->with('error', 'Failed to delete user');
        }
    }


    public function viewtrash()
    {
        try {
            $logged_in_user = auth()->user()->id;
            $users = User::where('id', '!=', $logged_in_user)->where('trash', 1)->orderBy('id', 'asc')->paginate(8);
            return view('backend.user.trash', [
                'users' => $users
            ]);
        } catch (Exception $err) {
            return redirect()->route('backend.user.index')->with('error', 'Failed to get users from trash');
        }
    }

    public function movetotrash(string $id)
    {
        try {
            $user = User::where('trash', 0)->findOrFail($id);
            $user->trash = 1;
            $user->save();
            return redirect()->route('backend.user.index')->with('success', 'User has been moved to trash');
        } catch (Exception $err) {
            return redirect()->route('backend.user.index')->with('error', 'Failed to move user to trash');
        }
    }

    public function restore(string $id)
    {
        try {
            $user = User::where('trash', 1)->findOrFail($id);
            $user->trash = 0;
            $user->save();
            return redirect()->route('backend.user.viewtrash')->with('success', 'User has been restored successfully');
        } catch (Exception $err) {
            return redirect()->back()->with('error', 'Failed to restore user. Please try again.');
        }
    }

    public function updatestatus(Request $req, string $id)
    {
        try {
            $user = User::where('trash', 0)->findOrFail($id);
            $user->is_active = $req->is_active;
            $user->save();
            return response()->json(['message' => "User's status updated successfully"], 200);
        } catch (Exception $err) {
            return response()->json(['message' => $err->getMessage()], 500);
        }
    }
}
