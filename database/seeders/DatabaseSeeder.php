<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users::factory(10)->create();
        $this->call([
            RolesAndPermissionsSeeder::class,
            // You can add other seeders here as well
        ]);

        User::factory()->create([
            'name' => 'Elland Pansensoy',
            'email' => 'elland.pansensoy@me.com',
            'password' => Hash::make('password'),
        ]);
    }
}
