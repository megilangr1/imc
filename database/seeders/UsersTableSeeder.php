<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'MeGGi',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin123'),
                'roles' => ['MeGGi'],
                'nama_creator' => 'Generated'
            ],
            [
                'name' => 'Test',
                'email' => 'test@mail.com',
                'password' => Hash::make('test1234'),
                'roles' => ['Administrator'],
                'nama_creator' => 'Generated'
            ],
        ];

        try {
            foreach ($data as $key => $value) {
                $roles = $value['roles'];
                unset($value['roles']);

                $data = User::where('email', '=', $value['email'])->first();
                if (!$data) {
                    $data = User::firstOrCreate($value);
                }

                $data->syncRoles($roles);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
