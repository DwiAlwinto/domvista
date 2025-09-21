<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Kategori::query();
        
        if ($search) {
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('kode_kategori', 'like', "%$search%");
        }
        
        $data = [
            'kategori' => $query->paginate(10),
            'content' => 'admin.kategori.index',
            'search' => $search // Kirim juga parameter search ke view
        ];
        
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // untuk menambhakan kategori
        $data = [
            'content' => 'admin.kategori.add'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //untuk validasi add kategori 
        $data = $request->validate([
            'kode_kategori' => 'required|unique:kategoris',
            'nama' => 'required',
        ]);


        Kategori::create($data);
        Alert::success('Data Success Ditambahkan', 'Success Message');
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail Kategori.
        $kategori = Kategori::find($id);
        $data = [
            'kategori' => $kategori,
            'content' => 'admin.kategori.detail'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // untuk menambhakan kategori
        $kategori = Kategori::find($id);
        $data = [
            'kategori' => $kategori,
            'content' => 'admin.kategori.add'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan kategori yang akan diupdate
        $kategori = Kategori::findOrFail($id);

        // Validasi data input
        $data = $request->validate([
            'kode_kategori' => 'required|unique:kategoris,kode_kategori,' . $kategori->id,
            'nama' => 'required',
        ]);

        // Update data kategori
        $kategori->update($data);

        Alert::success('Data Berhasil Diupdate', 'Sukses');
        return redirect('/admin/master/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        $kategori->delete();
        Alert::success('Data Berhasil Dihapus', 'Sukses');
        return redirect('/admin/master/kategori')->with('success', 'Data Kategori berhasil dihapus');
    }
}
