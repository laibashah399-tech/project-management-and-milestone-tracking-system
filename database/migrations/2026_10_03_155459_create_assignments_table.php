<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id('assignment_id');

            $table->foreignId('project_id')
                ->constrained('projects', 'project_id')
                ->restrictOnDelete();

            $table->foreignId('milestone_id')
                ->constrained('milestones', 'milestone_id')
                ->restrictOnDelete();

            $table->foreignId('employee_id')
                ->constrained('employees', 'employee_id')
                ->restrictOnDelete();

            $table->date('due_date');

            $table->string('status', 20);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};