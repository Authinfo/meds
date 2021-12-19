<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('Jancok123!'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2021-10-18 13:05:28',
                'verification_token' => '',
                'noid'               => '',
                'two_factor_code'    => '',
                'number'             => '',
            ],
        ];

        User::insert($users);
    }
}
