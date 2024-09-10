<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected  $table = 'projects';
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'project_name',
        'project_description',
        'project_file',
        'project_category', 
        'client', 
        'hod_id', 
    ];
//    RELATIONSHIP WITH HOD
   public function hod()
    {
        return $this->belongsTo(Hod::class,'hod_id');
    }
}
