<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            ['name' => 'BYAMUNGU Lewis', 'regnumber' => 'VFC001', 'username' => 'lewis', 'phone' => '0785436135', 'department_id' => 1,'savings' => 2000, 'password' => bcrypt('lewis'), 'role' => '0'],
            ['name' => 'Ntwari Lebon', 'regnumber' => 'VFC002', 'username' => 'lebon', 'phone' => '0787765434', 'department_id' => 2,'savings' => 2000, 'password' => bcrypt('lebon'), 'role' => '1'],
            ['name' => 'UWIZEWE Jean', 'regnumber' => 'VFC003', 'username' => 'uwizewe', 'phone' => '078776500', 'department_id' => 3,'savings' => 2000, 'password' => bcrypt('uwizewe'), 'role' => '2'],
        ];
        foreach ($collections as $item) {
            User::create($item);
        }
    }
}
