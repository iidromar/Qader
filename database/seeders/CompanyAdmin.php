<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanyAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
           'name'=> 'CompanyAdmin',
           'email'=> 'CompanyAdmin@gmail.com',
           'email_verified_at' => now(),
           'password'=>'admin',
           'remember_token'=> Str::random(10),
           'role'=>'1',

       ]);
    }
}
