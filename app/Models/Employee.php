<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Employee extends Model
{
    use HasFactory;
   protected $table = 'employeed';
   protected $primaryKey = 'emp_id';  
   protected $fillable = [
    'emp_fullname',
    'email_personal',
    'email_company',
    'department',
    'position',
    'defaultPassword',
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
   public function setDefaultPasswordAttribute($value)
    {
        $this->attributes['defaultPassword'] = Hash::make($value);
    }
}
