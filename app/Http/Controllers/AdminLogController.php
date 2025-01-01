<?php

namespace App\Http\Controllers;

use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminLogsExport;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class AdminLogController extends Controller
{
    /**
     * Display a listing of admin logs
     */
    public function index(Request $request) : View
    {
        $logs = $this->getFilteredLogs($request);
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
     * Export logs to PDF
     */
    public function export(Request $request) : Response
    {
        $logs = AdminLog::with('admin')
            ->when($request->filled('date_from') || $request->filled('date_to'), function($query) use ($request) {
                $query->dateRange($request->date_from, $request->date_to);
            })
            ->when($request->filled('action'), function($query) use ($request) {
                $query->byAction($request->action);
            })
            ->when($request->filled('admin_id'), function($query) use ($request) {
                $query->where('admin_id', $request->admin_id);
            })
            ->get()
            ->map->getExportData();
        
        AdminLog::log(
            auth()->id(),
            'export_logs',
            'Exported admin logs to PDF'
        );

        $pdf = DomPDF::loadView('admin.logs.pdf', ['logs' => $logs]);
        return $pdf->download('admin-logs.pdf');
    }

    /**
     * Filter logs with additional parameters
     */
    public function filter(Request $request) : View
    {
        $logs = $this->getFilteredLogs($request);
        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Get filtered logs query
     */
    private function getFilteredLogs(Request $request)
    {
        return AdminLog::with('admin')
            ->when($request->filled('date_from') || $request->filled('date_to'), function($query) use ($request) {
                $query->dateRange($request->date_from, $request->date_to);
            })
            ->when($request->filled('action'), function($query) use ($request) {
                $query->byAction($request->action);
            })
            ->when($request->filled('admin_id'), function($query) use ($request) {
                $query->where('admin_id', $request->admin_id);
            })
            ->latest()
            ->paginate(15);
    }
}
