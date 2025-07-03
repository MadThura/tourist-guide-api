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

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'User role updated.');
    }

    public function toggleStatus(User $user)
    {

        $user->is_active = !$user->is_active;
        $user->save();
        return back()->with('success', 'User status updated.');
    }
}
