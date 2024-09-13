<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Hod extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'hod';
    protected $primaryKey = 'hod_id';
    public $timestamps = true;

    protected $fillable = ['hod_name', 'email', 'password']; 

    // HASHING
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }

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

    // JWTSubject methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'hod_id' => $this->hod_id,
        ];
    }
   
}
