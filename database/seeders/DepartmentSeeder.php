<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          $collections = [
            ['name' => 'ADMINISTRATION' ],
            ['name' => 'FINANCE' ],
            ['name' => 'AUDIT' ],
            ['name' => 'SPECIAL' ],
            ['name' => 'OPERATION' ],
        ];
        foreach ($collections as $item) {
            Department::create($item);
        }
    }
}
