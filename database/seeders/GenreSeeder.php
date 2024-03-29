<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $genres = [
            'Ficción',
            'Novela',
            'Misterio',
            'Suspense',
            'Terror',
            'Ciencia ficción',
            'Fantasía',
            'Romance',
            'Drama',
            'Aventura',
            'Policíaca',
            'Histórica',
            'Biografía',
            'Autobiografía',
            'Ensayo',
            'Poesía',
            'Humor',
            'Viajes',
            'Ciencia y tecnología',
            'Filosofía'
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
