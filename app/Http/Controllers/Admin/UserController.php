<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Middleware untuk memastikan hanya admin yang bisa mengakses
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Menampilkan daftar semua user (kecuali admin yang sedang login)
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id()) // Exclude current admin
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan user baru ke database
     */
    public function store(UserStoreRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail user
     */
    public function show(User $user)
    {
        // Prevent viewing other admins
        if ($user->role === 'admin' && $user->id !== Auth::id()) {
            return back()->withErrors('Tidak bisa melihat detail admin lain.');
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Menampilkan form untuk mengedit user
     */
    public function edit(User $user)
    {
        // Prevent editing other admins
        if ($user->role === 'admin' && $user->id !== Auth::id()) {
            return back()->withErrors('Tidak bisa mengedit admin lain.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data user
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        // Prevent updating other admins
        if ($user->role === 'admin' && $user->id !== Auth::id()) {
            return back()->withErrors('Tidak bisa mengupdate admin lain.');
        }

        $data = $request->only('name', 'email', 'role');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user
     */
    public function destroy(User $user)
    {
        // Prevent deleting other admins
        if ($user->role === 'admin' && $user->id !== Auth::id()) {
            return back()->withErrors('Tidak bisa menghapus admin lain.');
        }

        // Prevent self-deletion
        if ($user->id === Auth::id()) {
            return back()->withErrors('Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
