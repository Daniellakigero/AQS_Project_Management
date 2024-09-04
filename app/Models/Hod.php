<?php

// namespace App\Models;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Hod extends Model
// {
//     use HasFactory;
//     protected $table = 'hod'; 
//     protected $primaryKey = 'hod_id';  
  
// // HASHING

//   public function setPasswordAttribute($value)
//     {
//         $this->attributes['password'] = Hash::make($value);
//     }

// //  RELATIONSHIP TO EMPLOYEE 
//   public function employeed()
//     {
//         return $this->hasMany(Employee::class, 'hod_id');
//     }

// // RELATIONSHIP TO PROJECTS
//    public function projects()
//     {
//         return $this->hasMany(Project::class, 'hod_id');
//     }
// }


namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hod extends Model
{
    use HasFactory;

    protected $table = 'hod'; 
    protected $primaryKey = 'hod_id';  
    public $timestamps = true; // Ensure timestamps are used

    protected $fillable = ['hod_name', 'email', 'password']; // Add fillable fields

    // HASHING
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // RELATIONSHIP TO EMPLOYEE 
    public function employees()
    {
        return $this->hasMany(Employee::class, 'hod_id');
    }

    // RELATIONSHIP TO PROJECTS
    public function projects()
    {
        return $this->hasMany(Project::class, 'hod_id');
    }
}
