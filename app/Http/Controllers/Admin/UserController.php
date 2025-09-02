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
     * Menampilkan daftar semua user dengan role guru atau admin
     * User yang sedang login ditampilkan di paling atas
     */
    public function index()
    {
        $currentUserId = Auth::id();

        $users = User::whereIn('role', ['guru', 'admin'])
            ->orderByRaw("CASE WHEN id = {$currentUserId} THEN 0 ELSE 1 END")
            ->orderBy('name')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru
     */
    public function create()
    {
        $roles = [
            'guru' => 'Guru',
            'admin' => 'Admin'
        ];

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Menyimpan user baru ke database
     */
    public function store(UserStoreRequest $request)
    {
        // Validasi role hanya boleh guru atau admin
        $validated = $request->validated();

        if (!in_array($validated['role'], ['guru', 'admin'])) {
            return back()->withErrors('Role tidak valid.')->withInput();
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail user
     */
    public function show(User $user)
    {
        // Hanya boleh melihat user dengan role guru atau admin
        if (!in_array($user->role, ['guru', 'admin'])) {
            return back()->withErrors('User tidak ditemukan.');
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Menampilkan form untuk mengedit user
     */
    public function edit(User $user)
    {
        // Hanya boleh mengedit user dengan role guru atau admin
        if (!in_array($user->role, ['guru', 'admin'])) {
            return back()->withErrors('User tidak ditemukan.');
        }

        $roles = [
            'guru' => 'Guru',
            'admin' => 'Admin'
        ];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Memperbarui data user
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        // Hanya boleh mengupdate user dengan role guru atau admin
        if (!in_array($user->role, ['guru', 'admin'])) {
            return back()->withErrors('User tidak ditemukan.');
        }

        // Validasi role hanya boleh guru atau admin
        $validated = $request->validated();

        if (!in_array($validated['role'], ['guru', 'admin'])) {
            return back()->withErrors('Role tidak valid.')->withInput();
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
        // Hanya boleh menghapus user dengan role guru atau admin
        if (!in_array($user->role, ['guru', 'admin'])) {
            return back()->withErrors('User tidak ditemukan.');
        }

        // Prevent self-deletion
        if ($user->id === Auth::id()) {
            return back()->withErrors('Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}