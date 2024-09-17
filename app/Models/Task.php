<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    public $timestamps = true;

    protected $fillable = ['title', 'description','assign_to', 'start_date','due_date','project_id', 'emp_id'];

// RELATIONSHIP WITH PROJECT
    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

// RELATIONSHIP WITH EMPLOYEE
    public function employees()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}
