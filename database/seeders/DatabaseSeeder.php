<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        if (empty(User::where('email', 'admin@admin.com')->first())) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('qwerty123'),
                'is_admin' => true,
            ]);
        }
        $this->call([
            CurrencySeeder::class,
        ]);
    }
}
