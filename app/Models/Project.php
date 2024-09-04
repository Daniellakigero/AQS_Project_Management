<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'description',
        'start_date',
        'end_date',
        'status',
        'created_by',
        'hod_id',
        'emp_id',
    ];

    public function employeed()
    {
        return $this->belongsToMany(Project::class, 'employee_project','emp_id', 'project_id');
    }

    public function hod()
    {
        return $this->belongsTo(Hod::class, 'hod_id');
    }
}

