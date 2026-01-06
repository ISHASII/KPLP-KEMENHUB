<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('user_management', compact('users'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,user',
        ], [
            'name.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus admin atau user',
        ]);

        // Create new account with selected role
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Akun berhasil ditambahkan!');
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Normalize inputs to avoid false-positive uniqueness errors (trim whitespace)
        $request->merge([
            'username' => is_string($request->username) ? trim($request->username) : $request->username,
            'email' => is_string($request->email) ? trim($request->email) : $request->email,
        ]);

        // If password not filled, remove both password fields so validation won't run for them
        if (!$request->filled('password')) {
            $request->request->remove('password');
            $request->request->remove('password_confirmation');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,user',
        ], [
            'name.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus admin atau user',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil diperbarui!');
    }

    /**
     * Toggle user active status (activate/deactivate).
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Prevent deactivating own account
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri!');
        }

        // Prevent deactivating other admin accounts
        if ($user->isAdmin() && auth()->user()->id !== $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menonaktifkan akun admin lain!');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun berhasil {$status}!");
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        // Prevent deleting admin accounts
        if ($user->isAdmin()) {
            return redirect()->back()->with('error', 'Akun admin tidak dapat dihapus!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus!');
    }
}
