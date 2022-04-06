<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>'IsaKV',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('123456'),
            'admin' => true
        ]);
        User::create([
            'name' =>'Joel',
            'email' => 'Joel@gmail.com',
            'telefono' => '86899564',
            'direccion' => 'Av. Murillo',
            'password' => bcrypt('joel'),
            'admin' => false
        ]);
        User::create([
            'name' =>'noelia',
            'email' => 'noelia@gmail.com',
            'telefono' => '07868535',
            'direccion' => 'Calle junin',
            'password' => bcrypt('noelia'),
            'admin' => false
        ]);
        User::create([
            'name' =>'juan',
            'email' => 'juan@gmail.com',
            'telefono' => '58739875',
            'direccion' => 'Calle bolivar',
            'password' => bcrypt('juan'),
            'admin' => false
        ]);
    }
}
