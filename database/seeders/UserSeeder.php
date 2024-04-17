<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userAdmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin45'),
            'district_id' => 12
        ]);

        $userAdmin->assignRole(RoleEnum::ADMIN);

        $userLibrarian = User::create([
            'name' => 'Librarian',
            'email' => 'librarian@librarian.com',
            'password' => Hash::make('librarian45'),
            'district_id' => 12
        ]);

        $userLibrarian->assignRole(RoleEnum::LIBRARIAN);
    }
}
