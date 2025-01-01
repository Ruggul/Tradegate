<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of admins
     */
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('admin.accounts.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin
     */
    public function create()
    {
        return view('admin.accounts.create');
    }

    /**
     * Store a newly created admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'username' => 'required|string|unique:admins|max:255',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => ['required', Rule::in(['super_admin', 'admin'])],
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('admin-profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = true;

        Admin::create($validated);

        return redirect()->route('admin.accounts.index')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Display the specified admin
     */
    public function show(Admin $admin)
    {
        return view('admin.accounts.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified admin
     */
    public function edit(Admin $admin)
    {
        return view('admin.accounts.edit', compact('admin'));
    }

    /**
     * Update the specified admin
     */
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'username' => ['required', 'string', Rule::unique('admins')->ignore($admin->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => ['required', Rule::in(['super_admin', 'admin'])],
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($admin->profile_picture) {
                Storage::disk('public')->delete($admin->profile_picture);
            }
            $path = $request->file('profile_picture')->store('admin-profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admin.accounts.index')
            ->with('success', 'Data admin berhasil diperbarui');
    }

    /**
     * Remove the specified admin
     */
    public function destroy(Admin $admin)
    {
        if ($admin->isSuperAdmin()) {
            return redirect()->route('admin.accounts.index')
                ->with('error', 'Super Admin tidak dapat dihapus');
        }

        if ($admin->profile_picture) {
            Storage::disk('public')->delete($admin->profile_picture);
        }

        $admin->delete();

        return redirect()->route('admin.accounts.index')
            ->with('success', 'Admin berhasil dihapus');
    }

    /**
     * Toggle admin active status
     */
    public function toggleStatus(Admin $admin)
    {
        if ($admin->isSuperAdmin()) {
            return redirect()->route('admin.accounts.index')
                ->with('error', 'Status Super Admin tidak dapat diubah');
        }

        $admin->update(['is_active' => !$admin->is_active]);

        return redirect()->route('admin.accounts.index')
            ->with('success', 'Status admin berhasil diperbarui');
    }
} 