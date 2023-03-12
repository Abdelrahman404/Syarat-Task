<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
            'name' => 'Abdelrahman',
            'email' => 'abdelrahamn@gmail.com',
            'department_id' => 1,
            'isManager' => true,
            'password' => bcrypt('123456'),
        ]);
    }
}
