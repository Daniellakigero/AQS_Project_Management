<?php

namespace Database\Seeders;

use App\Models\Hod;
use Illuminate\Database\Seeder;

class HodSeeder extends Seeder
{
    public function run(): void
    {
        $hod = new Hod();
        $hod->hod_name = 'Hinda';
        $hod->email = 'daniellakigero@gmail.com';
        $hod->password = 'aqs123'; 
        $hod->save();
    }
}
