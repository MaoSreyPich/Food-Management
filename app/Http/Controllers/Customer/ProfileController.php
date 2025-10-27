<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Show edit profile page
    public function edit()
    {
        $user = User::find(Auth::id());

        if (! $user) {
            abort(404);
        }

        return view('customer.profile.edit', compact('user'));
    }

    // Handle profile update
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        if (! $user) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'birth' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile'), $imageName);
            $user->profile_image = 'uploads/profile/'.$imageName;
        }

        // Update user info
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birth = $request->birth;
        $user->gender = $request->gender;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
