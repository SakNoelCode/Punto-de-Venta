<?php

namespace App\Jobs;

use App\Exports\VentasExport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class DownloadExcelVentasAllJob implements ShouldQueue
{
    use Queueable;

    protected string $filename;

    /**
     * Create a new job instance.
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Excel::store(new VentasExport, 'reportesExcelVentas/' . $this->filename, 'public');
        } catch (\Throwable $e) {
            Log::error("Error al exportar ventas a Excel: " . $e->getMessage());
        }
    }
}
