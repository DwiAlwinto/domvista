<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminPeminjamanController extends Controller
{
    //
    function index(){
        $data = [
            'title' => 'Manajemen Peminjaman',
            'anggota' => Anggota::get(),
            'peminjaman' => Peminjaman::paginate(10),
            'content' => 'admin.peminjaman.index'
        ];

        return view('admin.layouts.wrapper', $data);
    }

    function add( Redirect $redirect){
        $data = [
            'title' => 'Manajemen Peminjaman',
            'buku'  => Buku::get(),
            'anggota'  => Anggota::get(),
            'peminjaman' => Peminjaman::paginate(10),
            'content' => 'admin.peminjaman.add'
        ];

        return view('admin.layouts.wrapper', $data);
    }
}
