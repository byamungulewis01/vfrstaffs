<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'BYAMUNGU Lewis',
            'email' => 'lewis@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Ntwari Lebon',
            'email' => 'lebon@example.com',
            'role' => '1',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'UWIZEWE Jean',
            'email' => 'uwizewe@example.com',
            'role' => '2',
        ]);
    }
}