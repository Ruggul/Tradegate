<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use Illuminate\Http\Request;

class AdminLogController extends Controller
{
    public function index()
    {
        $logs = AdminLog::with('admin')->latest()->paginate(10);
        return view('admin.logs.index', compact('logs'));
    }

    public static function log($action, $module, $description = null)
    {
        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }
}
