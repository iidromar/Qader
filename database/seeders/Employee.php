<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Employee extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'Employee',
            'email'=> 'Employee@gmail.com',
            'email_verified_at' => now(),
            'password'=>'employee',
            'remember_token'=> Str::random(10),
            'role'=>'0',

        ]);
    }
}
