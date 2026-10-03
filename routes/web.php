<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;


// ==================== HOME + LOGIN ====================

Route::get('/', fn () => redirect()->route(auth()->check() ? 'dashboard' : 'login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');
});


// ==================== PROTECTED ROUTES ====================

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Employees
    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('employees.index');

    Route::get('/employees/create', [EmployeeController::class, 'create'])
        ->name('employees.create');

    Route::post('/employees', [EmployeeController::class, 'store'])
        ->name('employees.store');

    Route::get('/employees/{employee_id}/edit', [EmployeeController::class, 'edit'])
        ->name('employees.edit');

    Route::put('/employees/{employee_id}', [EmployeeController::class, 'update'])
        ->name('employees.update');

    Route::delete('/employees/{employee_id}', [EmployeeController::class, 'destroy'])
        ->name('employees.destroy');


    // Users
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{id}', [UserController::class, 'update'])
        ->name('users.update');

    Route::get('/change-password', [UserController::class, 'changePassword'])
        ->name('users.change-password');

    Route::put('/change-password', [UserController::class, 'updatePassword'])
        ->name('users.update-password');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy');


    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])
        ->name('projects.index');

    Route::get('/projects/create', [ProjectController::class, 'create'])
        ->name('projects.create');

    Route::post('/projects', [ProjectController::class, 'store'])
        ->name('projects.store');

    Route::get('/projects/{project_id}/edit', [ProjectController::class, 'edit'])
        ->name('projects.edit');

    Route::put('/projects/{project_id}', [ProjectController::class, 'update'])
        ->name('projects.update');

    Route::delete('/projects/{project_id}', [ProjectController::class, 'destroy'])
        ->name('projects.destroy');


    // Milestones
    Route::get('/milestones', [MilestoneController::class, 'index'])
        ->name('milestones.index');

    Route::get('/milestones/create', [MilestoneController::class, 'create'])
        ->name('milestones.create');

    Route::post('/milestones', [MilestoneController::class, 'store'])
        ->name('milestones.store');

    Route::get('/milestones/{milestone_id}/edit', [MilestoneController::class, 'edit'])
        ->name('milestones.edit');

    Route::put('/milestones/{milestone_id}', [MilestoneController::class, 'update'])
        ->name('milestones.update');

    Route::delete('/milestones/{milestone_id}', [MilestoneController::class, 'destroy'])
        ->name('milestones.destroy');


    // Assignments
    Route::resource('assignments', AssignmentController::class);


    // Reports
    Route::get('/reports/project-milestones', [ReportController::class, 'projectMilestones'])
        ->name('reports.project-milestones');

    Route::get('/reports/project-milestones/export', [ReportController::class, 'export'])
        ->name('reports.project-milestones.export');


    // Logout
    Route::post('/logout', [UserController::class, 'logout'])
        ->name('logout');
});