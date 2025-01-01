<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminLog extends Model
{
    protected $fillable = [
        'admin_id',
        'action',
        'description'
    ];

    /**
     * Get the admin that owns the log
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /**
     * Create a new log entry
     */
    public static function log($adminId, $action, $description = null)
    {
        return self::create([
            'admin_id' => $adminId,
            'action' => $action,
            'description' => $description
        ]);
    }
}
