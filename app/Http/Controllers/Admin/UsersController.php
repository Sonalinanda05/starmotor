<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function userView()
    {
        $users = User::where('role_id', '2')->latest()->get();
        return view('admin.users.view', compact('users'));
    }

    public function userCreate()
    {
        return view('admin.users.create');
    }

    public function userStore(Request $request)
    {
        {
            // Validate the form data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|numeric',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',

            ]);

            // Create a new user instance
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = Hash::make($request->input('password'));
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('profile_pic', $filename, 'public');
                $user->banner = 'profile_pic/' . $filename;
            }

            $user->save();

            return redirect()->route('admin.users.view')->with('success', 'User added successfully');
        }
    }

    public function userEdit($id)
    {
        $users = User::find($id);
        return view('admin.users.edit', compact('users'));
    }

    public function userUpdate($id, Request $request)
    {
        $users = User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->phone = $request->input('phone');
        $users->role_id = $request->input('role_id');
        $users->password = Hash::make($request->input('password'));
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_pic', $filename, 'public');
            $users->banner = 'profile_pic/' . $filename;
        }

        $users->save();

        return redirect()->route('admin.users.view')->with('success', 'User Updated successfully');
    }

    public function userDelete($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function usersearch(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('name', 'like', "%$search%")

            ->latest()->get();

        return view('admin.users.search', compact('users'));
    }

}
