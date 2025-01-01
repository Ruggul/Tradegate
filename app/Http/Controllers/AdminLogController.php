<?php

namespace App\Http\Controllers;

use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminLogsExport;

class AdminLogController extends Controller
{
    /**
     * Display a listing of admin logs
     */
    public function index(Request $request) : View
    {
        $query = AdminLog::with('admin')->latest();

        // Filter by action if provided
        if ($request->has('action')) {
            $query->where('action', $request->action);
        }

        // Filter by admin if provided
        if ($request->has('admin_id')) {
            $query->where('admin_id', $request->admin_id);
        }

        $logs = $query->paginate(15);
        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Show specific log details
     */
    public function show(AdminLog $log) : View
    {
        return view('admin.logs.show', compact('log'));
    }

    /**
     * Clear logs older than specified days
     */
    public function clear(Request $request) : RedirectResponse
    {
        $days = $request->input('days', 30);
        
        AdminLog::where('created_at', '<', now()->subDays($days))->delete();
        
        AdminLog::log(
            auth()->id(),
            'clear_logs',
            "Cleared logs older than {$days} days"
        );

        return back()->with('success', 'Old logs cleared successfully');
    }

    /**
     * Export logs to Excel/CSV
     */
    public function export() : Response
    {
        $logs = AdminLog::with('admin')->get();
        
        AdminLog::log(
            auth()->id(),
            'export_logs',
            'Exported admin logs'
        );

        return Excel::download(new AdminLogsExport($logs), 'admin-logs.xlsx');
    }

    /**
     * Filter logs with additional parameters
     */
    public function filter(Request $request) : View
    {
        $query = AdminLog::with('admin');

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Existing filters
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        if ($request->filled('admin_id')) {
            $query->where('admin_id', $request->admin_id);
        }

        $logs = $query->latest()->paginate(15);
        
        return view('admin.logs.index', compact('logs'));
    }
}
