<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    /**
     * Registrar una actividad en mi base de datos
     */
    public static function log(string $action, ?string $module = null, ?array $data = null, ?string $ipAddress = null, ?int $user_id = null,): void
    {
        ActivityLog::create([
            'user_id' => $user_id ?? Auth::user()->id,
            'action' => $action,
            'module' => $module,
            'data' => $data ? self::sanitizeData($data) : null,
            'ip_address' => $ipAddress ?? request()->ip(),
        ]);
    }

    /**
     * Enmascarar datos sensibles antes de registrar
     */
    private static function sanitizeData(array $data): array
    {
        $sensitiveKeys = ['password', 'token', 'credit_card']; //Datos a enmascarar

        foreach ($sensitiveKeys as $key) {
            if (array_key_exists($key, $data)) {
                $data[$key] = '**********';
            }
        }
        return $data;
    }
}
