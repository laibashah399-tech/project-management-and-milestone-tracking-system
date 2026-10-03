<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $primaryKey = 'milestone_id';

    protected $fillable = [
        'project_id',
        'title',
        'phase',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function assignments()
    {
        return $this->hasMany(\App\Models\Assignment::class, 'milestone_id', 'milestone_id');
    }
}