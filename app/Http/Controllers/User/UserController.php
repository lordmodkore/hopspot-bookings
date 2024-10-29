<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Display a listing of the users.
    public function index()
    {
        $users = User::with('roles')->get(); // Fetch users with roles
        return inertia('Users/Index', [
            'users' => $users
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
        $roles = Role::all();

        $userRoles = $user->getRoleNames()->toArray();  // Assuming the role names are stored in the 'name' column

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles, // Pass the user's roles to the view
        ]);
    }


    // Update the specified user in storage.
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password'   => 'nullable|string|min:8|confirmed', // Password is optional for update
            'roles'      => 'required|string|exists:roles,name', // Ensure a single role is provided and it exists
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $user)
                             ->withErrors($validator)
                             ->withInput();
        }

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Only hash if password is provided
        ]);
        $user->syncRoles([$request->roles]); // Sync the role as an array

        // Sync the single role provided


        return redirect()->route('users.index')->with('flash', ['success' => 'User updated successfully!']);
    }

    // Remove the specified user from storage.
    public function destroy(User $user)
    {
        $user->delete(); // Delete the user

        return redirect()->route('users.index')->with('flash', ['success' => 'Users deleted successfully!']);
    }
}
