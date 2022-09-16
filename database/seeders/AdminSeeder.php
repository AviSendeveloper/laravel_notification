<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // default admin
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
        ]);

        // admin factory
        Admin::factory(2)->create();
    }
}
