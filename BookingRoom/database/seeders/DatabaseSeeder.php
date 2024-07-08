<?php

namespace Database\Seeders;

use App\Models\Admins;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Admins::factory()->create([
        //     'email' => 'admin2',
        //     'password' => bcrypt('12345')
        // ]);

        $data = [
            [
                'admin' => 'admin2',
                'password' => bcrypt('12345')
            ],
            [
                'admin' => 'lxc@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'admin' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
            ],
        ];
        DB::table('admins')->insert($data);
    }
}
