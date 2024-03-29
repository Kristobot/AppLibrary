<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $countries = [
            'Argentina',
            'Bolivia',
            'Brasil',
            'Chile',
            'Colombia',
            'Costa Rica',
            'Cuba',
            'Ecuador',
            'El Salvador',
            'Guatemala',
            'Honduras',
            'México',
            'Nicaragua',
            'Panamá',
            'Paraguay',
            'Perú',
            'República Dominicana',
            'Uruguay',
            'Venezuela'
        ];

        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name' => $country,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
