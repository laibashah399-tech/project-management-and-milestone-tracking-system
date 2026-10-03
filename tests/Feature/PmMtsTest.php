<?php

use App\Models\Assignment;
use App\Models\Employee;
use App\Models\Milestone;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function makeEmployee(string $name = 'Emp One'): Employee
{
    return Employee::create(['name' => $name, 'role' => 'Developer']);
}

function makeProject(string $name = 'Proj'): Project
{
    return Project::create([
        'name' => $name, 'start_date' => '2026-01-01', 'end_date' => '2026-12-31', 'status' => 'Active',
    ]);
}

function loginAs(?Employee $emp = null): User
{
    $emp ??= makeEmployee('Login Emp');
    $user = User::create([
        'name' => 'admin', 'email' => 'a@a.com', 'password' => bcrypt('password123'),
        'employee_id' => $emp->employee_id, 'status' => 'Active',
    ]);
    test()->actingAs($user);
    return $user;
}

it('redirects / to login when guest', function () {
    $this->get('/')->assertRedirect('/login');
});

it('blocks employee delete when a user is registered', function () {
    $emp = makeEmployee();
    User::create(['name' => 'u', 'email' => 'u@u.com', 'password' => bcrypt('x12345678'),
        'employee_id' => $emp->employee_id, 'status' => 'Active']);
    loginAs();

    $this->delete(route('employees.destroy', $emp->employee_id))->assertSessionHas('error');
    expect(Employee::find($emp->employee_id))->not->toBeNull();
});

it('blocks employee delete when an assignment exists', function () {
    loginAs();
    $emp = makeEmployee('Worker');
    $p = makeProject();
    $m = Milestone::create(['project_id' => $p->project_id, 'title' => 'M1']);
    Assignment::create(['project_id' => $p->project_id, 'milestone_id' => $m->milestone_id,
        'employee_id' => $emp->employee_id, 'due_date' => '2026-06-01', 'status' => 'Pending']);

    $this->delete(route('employees.destroy', $emp->employee_id))->assertSessionHas('error');
    expect(Employee::find($emp->employee_id))->not->toBeNull();
});

it('deletes an employee with no users or assignments', function () {
    loginAs();
    $emp = makeEmployee('Free');
    $this->delete(route('employees.destroy', $emp->employee_id))->assertSessionHas('success');
    expect(Employee::find($emp->employee_id))->toBeNull();
});

it('rejects project end date before start date', function () {
    loginAs();
    $this->post(route('projects.store'), [
        'name' => 'X', 'start_date' => '2026-05-01', 'end_date' => '2026-04-01', 'status' => 'Active',
    ])->assertSessionHasErrors('end_date');
});

it('rejects project status other than Active/Inactive', function () {
    loginAs();
    $this->post(route('projects.store'), [
        'name' => 'X', 'start_date' => '2026-05-01', 'end_date' => '2026-06-01', 'status' => 'Pending',
    ])->assertSessionHasErrors('status');
});

it('rejects project name longer than 100 chars', function () {
    loginAs();
    $this->post(route('projects.store'), [
        'name' => str_repeat('a', 101), 'start_date' => '2026-05-01', 'end_date' => '2026-06-01', 'status' => 'Active',
    ])->assertSessionHasErrors('name');
});

it('generates 26 standard milestones on project create', function () {
    loginAs();
    $this->post(route('projects.store'), [
        'name' => 'Tower', 'start_date' => '2026-05-01', 'end_date' => '2026-06-01',
        'status' => 'Active', 'generate_milestones' => '1',
    ])->assertRedirect(route('projects.index'));

    expect(Milestone::count())->toBe(26);
    expect(Milestone::whereNotNull('phase')->count())->toBe(26);
});

it('does not generate milestones when checkbox is off', function () {
    loginAs();
    $this->post(route('projects.store'), [
        'name' => 'Tower', 'start_date' => '2026-05-01', 'end_date' => '2026-06-01', 'status' => 'Active',
    ]);
    expect(Milestone::count())->toBe(0);
});

it('blocks project and milestone delete when assignments exist', function () {
    loginAs();
    $emp = makeEmployee('W');
    $p = makeProject();
    $m = Milestone::create(['project_id' => $p->project_id, 'title' => 'M1']);
    Assignment::create(['project_id' => $p->project_id, 'milestone_id' => $m->milestone_id,
        'employee_id' => $emp->employee_id, 'due_date' => '2026-06-01', 'status' => 'Pending']);

    $this->delete(route('milestones.destroy', $m->milestone_id))->assertSessionHas('error');
    $this->delete(route('projects.destroy', $p->project_id))->assertSessionHas('error');
    expect(Milestone::count())->toBe(1)->and(Project::count())->toBe(1);
});

it('rejects an assignment whose milestone belongs to another project', function () {
    loginAs();
    $emp = makeEmployee('W');
    $p1 = makeProject('P1');
    $p2 = makeProject('P2');
    $m2 = Milestone::create(['project_id' => $p2->project_id, 'title' => 'M of P2']);

    $this->post(route('assignments.store'), [
        'project_id' => $p1->project_id, 'milestone_id' => $m2->milestone_id,
        'employee_id' => $emp->employee_id, 'due_date' => '2026-06-01', 'status' => 'Pending',
    ])->assertSessionHasErrors('milestone_id');
    expect(Assignment::count())->toBe(0);
});

it('rejects assignment status outside Pending/Completed', function () {
    loginAs();
    $emp = makeEmployee('W');
    $p = makeProject();
    $m = Milestone::create(['project_id' => $p->project_id, 'title' => 'M']);

    $this->post(route('assignments.store'), [
        'project_id' => $p->project_id, 'milestone_id' => $m->milestone_id,
        'employee_id' => $emp->employee_id, 'due_date' => '2026-06-01', 'status' => 'In Progress',
    ])->assertSessionHasErrors('status');
});

it('creates a valid assignment', function () {
    loginAs();
    $emp = makeEmployee('W');
    $p = makeProject();
    $m = Milestone::create(['project_id' => $p->project_id, 'title' => 'M']);

    $this->post(route('assignments.store'), [
        'project_id' => $p->project_id, 'milestone_id' => $m->milestone_id,
        'employee_id' => $emp->employee_id, 'due_date' => '2026-06-01', 'status' => 'Completed',
    ])->assertRedirect(route('assignments.index'));
    expect(Assignment::count())->toBe(1);
});

it('prevents a user from deleting their own account', function () {
    $me = loginAs();
    $this->delete(route('users.destroy', $me->id))->assertSessionHas('error');
    expect(User::find($me->id))->not->toBeNull();
});

it('rejects change password when new equals old', function () {
    loginAs();
    $this->put(route('users.update-password'), [
        'old_password' => 'password123', 'new_password' => 'password123',
    ])->assertSessionHasErrors('new_password');
});

it('shows the report with filters and exports csv', function () {
    loginAs();
    $emp = makeEmployee('Reporter');
    $p = makeProject('Report Proj');
    $m1 = Milestone::create(['project_id' => $p->project_id, 'title' => 'Done one', 'phase' => 'A. Pre-Construction Phase (Pre-CP)']);
    $m2 = Milestone::create(['project_id' => $p->project_id, 'title' => 'Late one']);
    Milestone::create(['project_id' => $p->project_id, 'title' => 'Unassigned one']);
    Assignment::create(['project_id' => $p->project_id, 'milestone_id' => $m1->milestone_id,
        'employee_id' => $emp->employee_id, 'due_date' => '2026-01-10', 'status' => 'Completed']);
    Assignment::create(['project_id' => $p->project_id, 'milestone_id' => $m2->milestone_id,
        'employee_id' => $emp->employee_id, 'due_date' => '2020-01-10', 'status' => 'Pending']);

    $this->get(route('reports.project-milestones'))
        ->assertOk()->assertSee('Done one')->assertSee('Unassigned one')->assertSee('Not assigned')->assertSee('Overdue');

    $this->get(route('reports.project-milestones', ['status' => 'Completed']))
        ->assertOk()->assertSee('Done one')->assertDontSee('Late one');

    $this->get(route('reports.project-milestones.export'))
        ->assertOk()->assertHeader('content-type', 'text/csv; charset=UTF-8');
});

it('renders all main pages with the grouped menu', function () {
    loginAs();
    makeProject();
    foreach (['dashboard','employees.index','employees.create','projects.index','projects.create',
              'milestones.index','milestones.create','assignments.index','assignments.create',
              'users.index','users.create','users.change-password'] as $r) {
        $this->get(route($r))->assertOk()->assertSee('Maintenance')->assertSee('Reports');
    }
});

it('renders edit pages', function () {
    loginAs();
    $emp = makeEmployee('E');
    $p = makeProject();
    $m = Milestone::create(['project_id' => $p->project_id, 'title' => 'M']);
    $a = Assignment::create(['project_id' => $p->project_id, 'milestone_id' => $m->milestone_id,
        'employee_id' => $emp->employee_id, 'due_date' => '2026-06-01', 'status' => 'Pending']);

    $this->get(route('employees.edit', $emp->employee_id))->assertOk();
    $this->get(route('projects.edit', $p->project_id))->assertOk();
    $this->get(route('milestones.edit', $m->milestone_id))->assertOk()->assertSee('Milestone Id');
    $this->get(route('assignments.edit', $a->assignment_id))->assertOk()->assertSee('Assignment Id');
});
