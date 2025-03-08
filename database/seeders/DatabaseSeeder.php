<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DocumentoSeeder::class);
        $this->call(ComprobanteSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UbicacioneSeeder::class);
        $this->call(MonedaSeeder::class);
        $this->call(EmpresaSeeder::class);
    }
}
