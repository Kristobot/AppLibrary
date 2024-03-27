<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $districts = [
            'Lima',
            'Miraflores',
            'San Isidro',
            'San Borja',
            'San Miguel',
            'Surco',
            'Barranco',
            'Chorrillos',
            'Lince',
            'Magdalena del Mar',
            'Pueblo Libre',
            'Jesus María',
            'Breña',
            'La Victoria',
            'Rímac',
            'San Juan de Lurigancho',
            'San Juan de Miraflores',
            'San Martín de Porres',
            'San Juan de Lurigancho',
            'La Molina',
            'Santa Anita',
            'Los Olivos',
            'Comas',
            'Independencia',
            'Carabayllo',
            'Cercado de Lima',
            'Pucusana',
            'Pachacámac',
            'Villa el Salvador',
            'Villa María del Triunfo',
            'Cieneguilla'
        ];

        foreach ($districts as $district) {
            DB::table('districts')->insert([
                'name' => $district,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
