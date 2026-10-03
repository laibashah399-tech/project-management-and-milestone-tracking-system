<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Login Form
public function login()
{
    return view('login');
}

// Login Process
public function authenticate(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ], [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()
            ->withErrors([
                'email' => 'Invalid email or password.'
            ])
            ->withInput();
    }

    if ($user->status !== 'Active') {
        return back()
            ->withErrors([
                'email' => 'Your account is inactive.'
            ])
            ->withInput();
    }

    auth()->login($user);

    $request->session()->regenerate();

    return redirect()->route('dashboard');
}
    // User List
    public function index()
    {
        $users = User::with('employee')->get();

        return view('users.index', compact('users'));
    }


    // Add User Form
    public function create()
    {
        $employees = Employee::all();

        return view('users.create', compact('employees'));
    }


    // Store User
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'employee_id' => 'required|exists:employees,employee_id',
            'password' => 'required|string|min:8|max:255',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.required' => 'User name is required.',
            'name.max' => 'User name cannot exceed 255 characters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',
            'email.unique' => 'This email is already registered.',

            'employee_id.required' => 'Employee is required.',
            'employee_id.exists' => 'Selected employee does not exist.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 255 characters.',

            'status.required' => 'Status is required.',
            'status.in' => 'Please select a valid status.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id' => $request->employee_id,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User added successfully.');
    }


    // Edit User Form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $employees = Employee::all();

        return view('users.edit', compact('user', 'employees'));
    }


    // Update User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'employee_id' => 'required|exists:employees,employee_id',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.required' => 'User name is required.',
            'name.max' => 'User name cannot exceed 255 characters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',
            'email.unique' => 'This email is already registered.',

            'employee_id.required' => 'Employee is required.',
            'employee_id.exists' => 'Selected employee does not exist.',

            'status.required' => 'Status is required.',
            'status.in' => 'Please select a valid status.',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id' => $request->employee_id,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    // Change Password Form
public function changePassword()
{
    $user = auth()->user();

    return view('users.change-password', compact('user'));
}


// Update Password
public function updatePassword(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'old_password' => 'required|string',
        'new_password' => 'required|string|min:8|max:255',
    ], [
        'old_password.required' => 'Old password is required.',
        'new_password.required' => 'New password is required.',
        'new_password.min' => 'New password must be at least 8 characters.',
        'new_password.max' => 'New password cannot exceed 255 characters.',
    ]);

    // Check old password
    if (!Hash::check($request->old_password, $user->password)) {
        return back()
            ->withErrors([
                'old_password' => 'Old password is incorrect.'
            ])
            ->withInput();
    }

    // Old and new password must be different
    if (Hash::check($request->new_password, $user->password)) {
        return back()
            ->withErrors([
                'new_password' => 'New password must be different from the old password.'
            ])
            ->withInput();
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return redirect()
        ->route('users.change-password')
        ->with('success', 'Password changed successfully.');
}
// Logout
public function logout(Request $request)
{
    auth()->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}

    // Delete User
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}