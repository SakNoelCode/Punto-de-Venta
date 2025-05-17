<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class CreateBackupDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-backup-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creación de un Backup de la base de datos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');

        $backupPath = storage_path('backups');
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = $backupPath . '/' . $filename;

        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $command = "mysqldump --ignore-table={$database}.failed_jobs --ignore-table={$database}.migrations --no-create-info -u{$username} --password={$password} -h{$host} {$database} > {$filePath}";

        $result = Process::run($command);

        if ($result->successful()) {
            $this->info("Backup creado exitosamente: {$backupPath}/{$filename}");
        } else {
            $this->error("Error al crear el backup: " . $result->errorOutput());
        }
    }
}
