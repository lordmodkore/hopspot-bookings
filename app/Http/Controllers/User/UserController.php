<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Display a listing of the users.
    public function index()
    {
        $users = User::all(); // Fetch all users
        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    // Show the form for creating a new user.
    public function create()
    {
        // Fetch all permissions from the database
        $roles = Role::all(['id', 'name']);

        // Pass the permissions to the Inertia view
        return Inertia::render('Users/Create', [
            'roles' => $roles,
        ]);
    }

    // Store a newly created user in storage.
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255', // Validate name
            'email' => 'required|email|unique:users,email', // Validate email
            'password' => 'required|min:8|confirmed', // Validate password
            'roles' => 'required|string', // Ensure a role is selected
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name, // Store the name
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the 'staff' role to the user
        $user->assignRole($request->roles); // Assign the selected role

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Display the specified user.
    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }

    // Show the form for editing the specified user.
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }

    // Update the specified user in storage.
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Password is optional for update
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $user)->withErrors($validator)->withInput();
        }

        // Update user details
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Only hash if password is provided
        ]);

        return redirect()->route('users.index')->with('flash', ['success' => 'Users updated successfully!']);
    }

    // Remove the specified user from storage.
    public function destroy(User $user)
    {
        $user->delete(); // Delete the user

        return redirect()->route('users.index')->with('flash', ['success' => 'Users deleted successfully!']);
    }
}
