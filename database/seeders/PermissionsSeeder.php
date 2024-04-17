<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Permissions from Books
        Permission::create(['name' => 'books.index'])->syncRoles(RoleEnum::cases());
        Permission::create(['name' => 'books.create'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);
        Permission::create(['name' => 'books.show'])->syncRoles(RoleEnum::cases());
        Permission::create(['name' => 'books.update'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);
        Permission::create(['name' => 'books.delete'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);
        
        //Permissions from Authors
        Permission::create(['name' => 'authors.index'])->syncRoles(RoleEnum::cases());
        Permission::create(['name' => 'authors.create'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);
        Permission::create(['name' => 'authors.show'])->syncRoles(RoleEnum::cases());
        Permission::create(['name' => 'authors.update'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);
        Permission::create(['name' => 'authors.delete'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);

        //Permissions from Copies
        Permission::create(['name' => 'copies.index'])->syncRoles(RoleEnum::cases());
        Permission::create(['name' => 'copies.create'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);
        Permission::create(['name' => 'copies.show'])->syncRoles(RoleEnum::cases());
        Permission::create(['name' => 'copies.delete'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);

        //Permissions from Loans
        Permission::create(['name' => 'loans.index'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);
        Permission::create(['name' => 'loans.create'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);
        Permission::create(['name' => 'loans.show'])->syncRoles(RoleEnum::cases());
        Permission::create(['name' => 'loans.delete'])->syncRoles([RoleEnum::ADMIN,RoleEnum::LIBRARIAN]);

    }
}
