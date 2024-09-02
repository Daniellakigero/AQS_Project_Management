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
        $hod->email = 'aqs1@gmail.com';
        $hod->phone_number = '0788837621';
        $hod->password = 'aqs123'; 
        $hod->save();
    }
}
