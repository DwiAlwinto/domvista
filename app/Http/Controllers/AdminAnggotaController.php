<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'anggota' =>  Anggota::get(),
            'content' => 'admin.anggota.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // untuk menambhakan anggota
        $data = [
            'content' => 'admin.anggota.add'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //untuk validasi add anggota 
        $data = $request->validate([
            'nis' => 'required|unique:anggotas,nis',
            'no_hp' => 'required',
            'nama_lengkap' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        // Handle photo upload

        if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->store('public/foto_anggota/');
            $data['foto'] = basename($photoPath); // Hanya simpan nama file
        } else {
            $data['foto'] = Null;
        }

        Anggota::create($data);
        Alert::success('Data Success Ditambahkan', 'Success Message');
        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail Anggota.
        $anggota = Anggota::find($id);
        $data = [
            'anggota' => $anggota,
            'content' => 'admin.anggota.detail'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // untuk menambhakan anggota
        $anggota = Anggota::find($id);
        $data = [
            'anggota' => $anggota,
            'content' => 'admin.anggota.add'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan anggota yang akan diupdate
        $anggota = Anggota::findOrFail($id);

        // Validasi data input
        $data = $request->validate([
            'nis' => 'required|unique:anggotas,nis,' . $anggota->id,
            'no_hp' => 'required',
            'nama_lengkap' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        // Handle photo upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($anggota->foto && Storage::exists('public/foto_anggota/' . $anggota->foto)) {
                Storage::delete('public/foto_anggota/' . $anggota->foto);
            }

            // Simpan foto baru
            $photoPath = $request->file('foto')->store('public/foto_anggota');
            $data['foto'] = basename($photoPath);
        } else {
            // Pertahankan foto lama jika tidak ada upload baru
            $data['foto'] = $anggota->foto;
        }

        // Update data anggota
        $anggota->update($data);

        Alert::success('Data Berhasil Diupdate', 'Sukses');
        return redirect('/admin/master/anggota')->with('success', 'Anggota berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::find($id);

        // Hapus foto profil jika ada
        if ($anggota->foto) {
            Storage::disk('public')->delete('foto_anggota/' . $anggota->foto);
        }

        $anggota->delete();
        Alert::success('Data Berhasil Dihapus', 'Sukses');
        return redirect('/admin/master/anggota')->with('success', 'Data Anggota berhasil dihapus');
    }
}
