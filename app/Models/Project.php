<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'project_id';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'status',
    ];

    public function milestones()
    {
        return $this->hasMany(\App\Models\Milestone::class, 'project_id', 'project_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'project_id', 'project_id');
    }
}