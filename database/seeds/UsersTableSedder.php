<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Nelson Guardado",
            'email' => "nguardadov@gmail.com",
            'password' => bcrypt("1234"),
            'role'=>'admin'        
        ]);
        User::create([
            'name' => "Doctor1",
            'email' => "doctor@gmail.com",
            'password' => bcrypt("HolaMundo10!"),
            'role'=>'doctor'        
        ]);
        User::create([
            'name' => "paciente1",
            'email' => "paciente@gmail.com",
            'password' => bcrypt("HolaMundo10!"),
            'role'=>'patient'        
        ]);
        factory(User::class, 50)->create();
    }
}
