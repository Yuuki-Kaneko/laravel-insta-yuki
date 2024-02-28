<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;  // Add from RegisterController

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function run(): void
    {
        $users = [
            [
                'name' => 'Fra',
                'email' => 'fra@email.com',
                'password' => Hash::make('password'),
                'role_id' => '2',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        ];

        $this->user->insert($users);
    }
}
