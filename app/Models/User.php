<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'employee_id',
        'status',
    ];

    /**
     * Fields hidden from arrays
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
   protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
    ];
}

    /**
     * User belongs to an Employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}