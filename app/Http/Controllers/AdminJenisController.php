<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminJenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Jenis::query();
        
        if ($search) {
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('kode_jenis', 'like', "%$search%");
        }
        
        $data = [
            'jenis' => $query->paginate(10),
            'content' => 'admin.jenis.index',
            'search' => $search // Kirim juga parameter search ke view
        ];
        
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // untuk menambhakan jenis
        $data = [
            'content' => 'admin.jenis.add'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //untuk validasi add jenis 
        $data = $request->validate([
            'kode_jenis' => 'required|unique:jenis',
            'nama' => 'required',
        ]);


        Jenis::create($data);
        Alert::success('Data Success Ditambahkan', 'Success Message');
        return redirect()->back()->with('success', 'Jenis berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail Jenis.
        $jenis = Jenis::find($id);
        $data = [
            'jenis' => $jenis,
            'content' => 'admin.jenis.detail'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // untuk menambhakan jenis
        $jenis = Jenis::find($id);
        $data = [
            'jenis' => $jenis,
            'content' => 'admin.jenis.add'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan jenis yang akan diupdate
        $jenis = Jenis::findOrFail($id);

        // Validasi data input
        $data = $request->validate([
            'kode_jenis' => 'required|unique:jenis,kode_jenis,' . $jenis->id,
            'nama' => 'required',
        ]);

        // Update data jenis
        $jenis->update($data);

        Alert::success('Data Berhasil Diupdate', 'Sukses');
        return redirect('/admin/master/jenis')->with('success', 'Jenis berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis = Jenis::find($id);

        $jenis->delete();
        Alert::success('Data Berhasil Dihapus', 'Sukses');
        return redirect('/admin/master/jenis')->with('success', 'Data Jenis berhasil dihapus');
    }
}
