<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSedder::class);
        $this->call(SpecialtiesTableSedder::class);
        $this->call(WorkDaysTabelSeeder::class);
    }
}
