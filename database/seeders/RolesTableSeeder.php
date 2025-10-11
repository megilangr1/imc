<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'MeGGi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Administrator',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Operator',
                'guard_name' => 'web',
            ],
        ];

        try {
            foreach ($data as $key => $value) {
                Role::firstOrCreate($value);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
