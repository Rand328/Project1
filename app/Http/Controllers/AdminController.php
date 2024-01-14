<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    public function __construct()
    {
        // Apply the 'admin' middleware to the entire controller
        $this->middleware('admin');
    }

    public function adminOnly()
    {
        return view('dashboard'); 
    }

    public function allUsers()
    {
        $users = User::all();
        return view('admin.all-users', compact('users'));
    }

   
    public function updateRole(Request $request, User $user)
    {
        $this->authorize('admin-panel');
        $this->authorize('admin');

        $validatedData = $request->validate([
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);

        // Update a user's role
        $user->update(['role' => $validatedData['role']]);

        return back()->with('success', 'User role updated successfully');
    }


    public function createUser(Request $request)
    {
        $this->authorize('admin-panel');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user with the specified role (admin)
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'admin', // Set the role to 'admin'
        ]);

        return back()->with('success', 'User created successfully');
    }

}
