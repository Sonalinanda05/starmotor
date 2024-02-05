<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profileEdit()
    {
        return view('admin.profile.setting');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'password' => 'confirmed',
        ]);
        $user = User::find(Auth::id());

        // Update the general user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Handle password update if a new password is provided
        if ($request->filled('password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
            } else {
                return redirect()->back()->withErrors(['old_password' => 'Current password is incorrect.']);
            }
        }

        // Handle profile image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('user_profile', $filename, 'public');
            $user->image = 'user_profile/' . $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Your Profile has been updated successfully');
    }

}
