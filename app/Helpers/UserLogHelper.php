<?php

use Illuminate\Support\Facades\Request;
use App\Models\UserLog;

if (!function_exists('logUserActivity')) {
    function logUserActivity($user_id, $action, $module, $reference_id = null, $description = null)
    {
        UserLog::create([
            'user_id' => $user_id,
            'action' => strtoupper($action),
            'module' => $module,
            'reference_id' => $reference_id,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'created_at' => now(),
        ]);
    }
}
