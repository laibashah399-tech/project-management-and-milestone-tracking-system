<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Employee List
    public function index()
    {
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }


    // Add Employee Form
    public function create()
    {
        return view('employees.create');
    }


    // Store Employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:50',
        ], [
            'name.required' => 'Employee name is required.',
            'name.max' => 'Employee name cannot exceed 100 characters.',

            'role.required' => 'Role is required.',
            'role.max' => 'Role cannot exceed 50 characters.',
        ]);

        Employee::create([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee added successfully.');
    }


    // Edit Employee Form
    public function edit($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);

        return view('employees.edit', compact('employee'));
    }


    // Update Employee
    public function update(Request $request, $employee_id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:50',
        ], [
            'name.required' => 'Employee name is required.',
            'name.max' => 'Employee name cannot exceed 100 characters.',

            'role.required' => 'Role is required.',
            'role.max' => 'Role cannot exceed 50 characters.',
        ]);

        $employee = Employee::findOrFail($employee_id);

        $employee->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }


    // Delete Employee
    public function destroy($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);

        // Validation 2.1 #5: a user is registered with this employee
        if ($employee->users()->exists()) {
            return redirect()
                ->route('employees.index')
                ->with('error', 'This employee cannot be deleted because a user is registered with this employee.');
        }

        // Validation 2.1 #6: an assignment is registered with this employee
        if ($employee->assignments()->exists()) {
            return redirect()
                ->route('employees.index')
                ->with('error', 'This employee cannot be deleted because assignments are linked to this employee.');
        }

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}

