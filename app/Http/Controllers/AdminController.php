<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('admin.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => ['required', Rule::in(['super_admin', 'admin'])],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('admin-images', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);
        $admin = Admin::create($validated);

        AdminLog::log(auth()->id(), 'create_admin', "Created admin: {$admin->name}");

        return redirect()->route('admin.index')->with('success', 'Admin created successfully');
    }

    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'password' => 'nullable|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => ['required', Rule::in(['super_admin', 'admin'])],
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($admin->image) {
                Storage::disk('public')->delete($admin->image);
            }
            $validated['image'] = $request->file('image')->store('admin-images', 'public');
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);
        
        AdminLog::log(auth()->id(), 'update_admin', "Updated admin: {$admin->name}");

        return redirect()->route('admin.index')->with('success', 'Admin updated successfully');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->isSuperAdmin()) {
            return back()->with('error', 'Cannot delete super admin');
        }

        if ($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }

        $adminName = $admin->name;
        $admin->delete();

        AdminLog::log(auth()->id(), 'delete_admin', "Deleted admin: {$adminName}");

        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully');
    }

    public function toggleStatus(Admin $admin)
    {
        if ($admin->isSuperAdmin()) {
            return back()->with('error', 'Cannot change super admin status');
        }

        $admin->update(['is_active' => !$admin->is_active]);
        $status = $admin->is_active ? 'activated' : 'deactivated';

        AdminLog::log(auth()->id(), 'toggle_admin_status', "Admin {$admin->name} {$status}");

        return back()->with('success', 'Admin status updated successfully');
    }
} 