<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'employeed';
    protected $primaryKey = 'emp_id';
    public $timestamps = true;

    protected $fillable = [
        'emp_fullname',
        'email_personal',
        'email_company',
        'department',
        'position',
        'defaultPassword',
        'processed',
        'verified',
        'hod_id',
    ];

    // RELATIONSHIP TO HOD
    public function hod()
    {
        return $this->belongsTo(Hod::class, 'hod_id');
    }

    // RELATIONSHIP WITH TASK
    public function tasks()
    {
        return $this->hasMany(Task::class, 'emp_id');
    }

    // HASHING PASSWORD
    public function setDefaultPasswordAttribute($value)
    {
        $this->attributes['defaultPassword'] = Hash::make($value);
    }

    // JWTSubject methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'emp_id' => $this->emp_id,
            'hod_id' => $this->hod_id,
        ];
    }
}
