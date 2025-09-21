<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Penerbit::query();
        
        if ($search) {
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('kode_penerbit', 'like', "%$search%");
        }
        
        $data = [
            'penerbit' => $query->paginate(10),
            'content' => 'admin.penerbit.index',
            'search' => $search // Kirim juga parameter search ke view
        ];
        
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // untuk menambhakan penerbit
        $data = [
            'content' => 'admin.penerbit.add'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //untuk validasi add penerbit 
        $data = $request->validate([
            'kode_penerbit' => 'required|unique:penerbits',
            'nama' => 'required',
        ]);


        Penerbit::create($data);
        Alert::success('Data Success Ditambahkan', 'Success Message');
        return redirect()->back()->with('success', 'Penerbit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail Penerbit.
        $penerbit = Penerbit::find($id);
        $data = [
            'penerbit' => $penerbit,
            'content' => 'admin.penerbit.detail'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // untuk menambhakan penerbit
        $penerbit = Penerbit::find($id);
        $data = [
            'penerbit' => $penerbit,
            'content' => 'admin.penerbit.add'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan penerbit yang akan diupdate
        $penerbit = Penerbit::findOrFail($id);

        // Validasi data input
        $data = $request->validate([
            'kode_penerbit' => 'required|unique:penerbits,kode_penerbit,' . $penerbit->id,
            'nama' => 'required',
        ]);

        // Update data penerbit
        $penerbit->update($data);

        Alert::success('Data Berhasil Diupdate', 'Sukses');
        return redirect('/admin/master/penerbit')->with('success', 'Penerbit berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penerbit = Penerbit::find($id);

        $penerbit->delete();
        Alert::success('Data Berhasil Dihapus', 'Sukses');
        return redirect('/admin/master/penerbit')->with('success', 'Data Penerbit berhasil dihapus');
    }
}
