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
        $this->call([
            CopyStatusSeeder::class,
            CountrySeeder::class,
            DistrictSeeder::class,
            GenreSeeder::class,
            RoleSeeder::class,
            PermissionsSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,
            BookGenreSeeder::class,
            CopySeeder::class,
            UserSeeder::class
        ]);
    }
}
