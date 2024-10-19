<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name', 'email', 'address', 'phone', 'user_picture', 'password'
    ];

    public function presences()
    {
        return $this->hasMany(EmpPresence::class, 'employee_id');
    }

    public function salaries()
    {
        return $this->hasMany(EmpSalary::class, 'employee_id');
    }
}