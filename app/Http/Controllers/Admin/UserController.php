<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
       $users = User::latest()->paginate(7);
        return view('admin.users.index', compact('users'));
    }

    // Block/Unblock user
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'blocked' : 'active';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User status updated!');
    }

    // Show edit form for role
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update user role
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

       $request->validate([
          'role' => 'required|in:0,1',
          'status' => 'required|in:active,blocked'
        ]);
        
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }
}