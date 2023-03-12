<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
            'name' => 'Sarah Fortunate',
            'email' => 'missForunate61@riot.com',
            'department_id' => 1,
            'password' => bcrypt('SarahFor61'),
        ]);
    }
}
