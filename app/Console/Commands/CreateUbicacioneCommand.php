<?php

namespace App\Console\Commands;

use App\Models\Ubicacione;
use Illuminate\Console\Command;
use Throwable;

class CreateUbicacioneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-ubicacione';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creación para un registro de una ubicación';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nombre = $this->ask('Ingrese el nombre para su nueva ubicación');

        try {
            Ubicacione::create([
                'nombre' => $nombre
            ]);

            $this->info('Ubicación creada exitosamente');
        } catch (Throwable $e) {
            $this->error('Ups, algo falló ' . $e->getMessage());
        }
    }
}
