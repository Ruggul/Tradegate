<?php

namespace App\Http\Controllers;

use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
}
