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
            'address' => '',
            'phone' => '',
            'dni' => '12345678',
            'role'=>'admin'        
        ]);
        factory(User::class, 50)->create();
    }
}
