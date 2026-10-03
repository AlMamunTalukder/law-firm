<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait AuditLogger
{
    public static function logAudit(string $action, ?string $entityType, $entityId, $oldValues = null, $newValues = null, ?string $description = null): AuditLog
    {
        return AuditLog::create([
            'user_id'     => Auth::id(),
            'action'      => $action,
            'entity_type' => $entityType,
            'entity_id'   => $entityId,
            'old_values'  => $oldValues ? (is_string($oldValues) ? json_decode($oldValues, true) : $oldValues) : null,
            'new_values'  => $newValues ? (is_string($newValues) ? json_decode($newValues, true) : $newValues) : null,
            'ip'          => Request::ip(),
            'description' => $description,
        ]);
    }
}
