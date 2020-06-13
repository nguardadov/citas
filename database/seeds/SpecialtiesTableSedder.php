<?php

use App\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'Oftalmología',
            'Pediatría',
            'Cardiología',
            'Neourología'
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                "name"=>$specialty
            ]);
        }
    }
}
