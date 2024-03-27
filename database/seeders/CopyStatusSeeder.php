<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CopyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $statuses = [
            'Disponible',
            'Reservado',
            'En Reparacion',
            'Extraviado'
        ];

        foreach ($statuses as $status) {
            DB::table('copy_statuses')->insert([
                'name' => $status,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
