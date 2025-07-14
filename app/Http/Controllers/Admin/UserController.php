<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::filter(request(['search', 'role', 'status']))->paginate()
        ]);
    }

    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:admin,moderator,user']
        ]);

        if (!auth()->user()->can('changeRole', $user)) {
            return back()->with('fail', 'You are not authorized to change this role.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }


    public function toggleStatus(User $user)
    {
        if (!auth()->user()->can('toggleStatus', $user)) {
            return back()->with('fail', 'You are not authorized to do this action.');
        }

        $user->is_active = !$user->is_active;
        $user->save();
        return back()->with('success', 'User status updated.');
    }
}
