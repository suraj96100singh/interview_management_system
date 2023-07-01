<?php

use App\Category;
use App\Roles;
use App\User;
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
        // $this->call(UsersTableSeeder::class);
        // Roles::create([
        //     'roles_name'=>'manager',
        // ]);
        User::create([
            'name'=>'suraj',
            'email'=>'suraj96100singh@gmail.com',
            'password'=>'8949225592',
            'roles_id'=>'1',
            'department_id'=>'1',
        ]);
        Category::create([
            'department_name'=>'Infotech',
            'head_of_department'=>'1',
            'department_email'=>'main@gmail.com',
            'department_phone_number'=>'8949225592',
            'department_address'=>'rani bazar bikaner',
            'department_working_hours'=>'12',
            'department_image'=>'c/xamp/files',
            'department_status'=>'Active'

        ]);
       
        
    }
}
