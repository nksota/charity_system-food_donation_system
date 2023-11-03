<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            [
    
               'name'=>'Admin',
    
               'email'=>'wawundii.25@gmail.com',
    
               'type'=>1,

               'status' => 'yes',
    
               'password'=> bcrypt('123456'),
    
            ],
    
            [
    
               'name'=>'donor',
    
               'email'=>'donor@charity.com',
    
               'type'=> 2,

               'status' => 'yes',
    
               'password'=> bcrypt('123456'),
    
            ],
    
            [
    
                'name'=>'Orphanage',
     
                'email'=>'orphanage@charity.com',
     
                'type'=> 3,

                'status' => 'yes',
     
                'password'=> bcrypt('123456'),
     
             ],
    
            [
    
               'name'=>'Volunteer',
    
               'email'=>'volunteer@charity.com',
    
               'type'=>0,

               'status' => 'yes',
    
               'password'=> bcrypt('123456'),
    
            ],
    
        ];
    
    
    
        foreach ($users as $key => $user) {
    
            User::create($user);
    
        
    }
}
}