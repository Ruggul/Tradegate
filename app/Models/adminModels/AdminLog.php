<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Scope untuk filter berdasarkan rentang tanggal
     */
    public function scopeDateRange(Builder $query, $from, $to): void
    {
        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }
    }

    /**
     * Scope untuk filter berdasarkan action
     */
    public function scopeByAction(Builder $query, $action): void
    {
        if ($action) {
            $query->where('action', $action);
        }
    }

    /**
     * Get formatted created date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d M Y H:i:s');
    }

    /**
     * Get available log actions
     */
    public static function getAvailableActions(): array
    {
        return [
            'create_admin' => 'Create Admin',
            'update_admin' => 'Update Admin',
            'delete_admin' => 'Delete Admin',
            'toggle_status' => 'Toggle Status',
            'clear_logs' => 'Clear Logs',
            'export_logs' => 'Export Logs'
        ];
    }

    /**
     * Get formatted data for PDF
     */
    public function getExportData(): array
    {
        return [
            'ID' => $this->id,
            'Admin' => $this->admin->name ?? 'N/A',
            'Action' => self::getAvailableActions()[$this->action] ?? $this->action,
            'Description' => $this->description ?? '-',
            'Date' => $this->formatted_date
        ];
    }
}
