<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $totalUsers = User::count();

            // Ambil data user dengan pagination (10 user per halaman)
             $users = User::paginate(10);
        $data = [
            'totalUsers' => $totalUsers, // Kirim totalUsers dengan key 'totalUsers'
            'users'   => $users,
            'user'    => User::get(),
            'content' => 'admin.user.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
        $data = [
            'content' => 'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi form
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'role' => 'required|string|in:admin,user,manager', //Validasi role
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', //validasi foto profil
        ]);

        // Hash password
        $data['password'] = Hash::make($data['password']);

        // Handle upload foto profil
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('foto_profil', $fileName, 'public'); // Simpan file di folder 'foto_profil' di storage/public
            $data['foto_profil'] = $filePath;
        }

        // Simpan data ke database
        User::create($data);

        // Redirect ke halaman admin/user
        Alert::success('Add Data Success', 'Success Message');
        return redirect('/admin/user')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // 
        $data = [
            'user'    => User::find($id),
            'content' => 'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi form
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ignore email user yang sedang diupdate
            'password' => 'nullable|string|min:8', // Password tidak wajib diisi
            'password_confirmation' => 'nullable|same:password', // Konfirmasi password tidak wajib diisi
            'role' => 'required|string|in:admin,user,manager', // Validasi role
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi foto profil
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hash password jika diisi
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // Hapus password dari array data jika tidak diisi
        }

        // Handle upload foto profil jika diupload
        if ($request->hasFile('foto_profil')) {
            // Hapus foto profil lama jika ada
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Upload foto profil baru
            $file = $request->file('foto_profil');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('foto_profil', $fileName, 'public'); // Simpan file di folder 'foto_profil' di storage/public
            $data['foto_profil'] = $filePath;
        } else {
            unset($data['foto_profil']);
        }
        $user->update($data);

        Alert::success('Update Data Success', 'Success Message');
        return redirect('/admin/user')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus foto profil jika ada
        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        // Hapus user dari database
        $user->delete();

        // Redirect ke halaman admin/user dengan pesan sukses
        Alert::success('Delete Data Success', 'Success Message');
        return redirect('/admin/user')->with('success', 'Your account has been delete!');
    }
}
