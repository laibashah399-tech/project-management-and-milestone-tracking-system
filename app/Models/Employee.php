<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'name',
        'role',
    ];

    /**
     * Employee can have registered users
     */
    public function users()
    {
        return $this->hasMany(User::class, 'employee_id', 'employee_id');
    }

    public function assignments()
{
    return $this->hasMany(Assignment::class, 'employee_id', 'employee_id');
}
}