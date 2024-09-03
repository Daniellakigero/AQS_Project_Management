<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
   protected $table = 'employeed';
   protected $primaryKey = 'emp_id';  
   protected $fillable = [
        'emp_name',
        'email_personal',
        'email_company',
        'phone_number',
        'verification_code',
        'hod_id'
    ];
    public function hod()
    {
        return $this->belongsTo(Hod::class, 'hod_id');
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project','emp_id', 'project_id');
    }
}
