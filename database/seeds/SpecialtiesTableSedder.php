<?php

use App\Specialty;
use App\User;
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
            $specialty =Specialty::create([
                "name"=>$specialty
            ]);
            
            $specialty->users()->saveMany(
                factory(User::class,3)->state('doctor')->make()
            );
        }

        User::find(2)->specialties()->save($specialty);
    }
}
