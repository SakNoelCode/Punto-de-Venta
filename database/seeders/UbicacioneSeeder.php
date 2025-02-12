<?php

namespace Database\Seeders;

use App\Models\Ubicacione;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UbicacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ubicacione::insert([
            [
                'nombre' => 'Estante 1',
            ],
            [
                'nombre' => 'Estante 2',
            ],
            [
                'nombre' => 'Estante 3',
            ],
            [
                'nombre' => 'Estante 4',
            ],
            [
                'nombre' => 'Estante 5',
            ],
            [
                'nombre' => 'Estante 6',
            ],
            [
                'nombre' => 'Estante 7',
            ],
            [
                'nombre' => 'Estante 8',
            ],
            [
                'nombre' => 'Estante 9',
            ],
        ]);
    }
}
