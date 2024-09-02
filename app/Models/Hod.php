<?php

namespace App\Models;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hod extends Model
{
    use HasFactory;
    protected $table = 'hod'; 
    
  public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
 public function employeed()
    {
        return $this->hasMany(Employee::class, 'hod_id');
    }
}
