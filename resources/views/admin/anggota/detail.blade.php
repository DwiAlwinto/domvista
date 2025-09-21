<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">
                        Detail Anggota
                    </h1>
                </div>
                
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l14 0"></path>
                                <path d="M5 12l6 6"></path>
                                <path d="M5 12l6 -6"></path>
                            </svg>
                            Kembali
                        </a>
                        <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                            Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <!-- Left Column - Profile Card -->
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-body text-center">
                            <div class="mb-4 position-relative">
                                <span class="avatar avatar-xxl" style="background-image: url({{ asset('storage/foto_anggota/' . $anggota->foto) }})">
                                    @if(!$anggota->foto)
                                        <span class="avatar-initials">{{ substr($anggota->nama_lengkap, 0, 1) }}</span>
                                    @endif
                                </span>
                                <span class="badge bg-indigo avatar-badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                </span>
                            </div>
                            <h2 class="mb-1">{{ $anggota->nama_lengkap }}</h2>
                            <div class="text-muted mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z"></path>
                                    <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M15 8l2 0"></path>
                                    <path d="M15 12l2 0"></path>
                                    <path d="M7 16l10 0"></path>
                                </svg>
                                NIS: {{ $anggota->nis }}
                            </div>
                            
                            <div class="mt-3 mb-4">
                                <span class="badge {{ $anggota->status_pinjam == 'Pinjam' ? 'bg-orange-lt' : 'bg-teal-lt' }} badge-lg">
                                    {{ $anggota->status_pinjam == 'Pinjam' ? 'Sedang Meminjam' : 'Bebas Pinjam' }}
                                </span>
                                
                                <span class="badge mt-2 {{ $anggota->is_active == '1' ? 'bg-green-lt' : 'bg-red-lt' }} badge-lg ms-2">
                                    {{ $anggota->is_active == '1' ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </div>
                            
                            <div class="hr-text hr-text-center my-3">Kontak</div>
                            
                            <div class="row g-2">
                                <div class="col-12">
                                    <a href="tel:{{ $anggota->no_hp }}" class="btn btn-outline-primary btn-sm w-100 d-flex align-items-center justify-content-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                        </svg>
                                        <small>Telepon</small>
                                    </a>
                                </div>
                               
                            </div>
                            

                        </div>
                    </div>
                    
                    <!-- Statistics Card -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-bar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M4 20l14 0"></path>
                                </svg>
                                Statistik Peminjaman
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Total Pinjam</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-blue-lt">{{ $anggota->peminjaman_count ?? 0 }} Buku</span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Sedang Dipinjam</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-orange-lt">{{ $anggota->peminjaman_aktif_count ?? 0 }} Buku</span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Terlambat</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-red-lt">{{ $anggota->peminjaman_terlambat_count ?? 0 }} Kali</span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Bergabung</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-cyan-lt">{{ $anggota->created_at->translatedFormat('j F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <!-- Right Column - Personal Information -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                </svg>
                                Informasi Pribadi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <div class="form-control-plaintext border-bottom pb-2">{{ $anggota->nama_lengkap }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">NIS</label>
                                        <div class="form-control-plaintext border-bottom pb-2">{{ $anggota->nis }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <div class="form-control-plaintext border-bottom pb-2">{{ $anggota->tempat_lahir }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="form-control-plaintext border-bottom pb-2">{{ $anggota->tanggal_lahir }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="form-control-plaintext border-bottom pb-2">
                                            @if($anggota->jenis_kelamin == 'L')
                                                <span class="badge bg-blue-lt">Laki-laki</span>
                                            @else
                                                <span class="badge bg-pink-lt">Perempuan</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">No. Telepon</label>
                                        <div class="form-control-plaintext border-bottom pb-2">
                                            <a href="tel:{{ $anggota->no_hp }}" class="text-reset">{{ $anggota->no_hp }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <div class="form-control-plaintext border-bottom pb-2">{{ $anggota->alamat }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Active Loans Card -->
                    @if($anggota->peminjaman_aktif_count > 0)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                    <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                    <path d="M3 6l0 13"></path>
                                    <path d="M12 6l0 13"></path>
                                    <path d="M21 6l0 13"></path>
                                </svg>
                                Peminjaman Aktif
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Judul Buku</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($anggota->peminjaman_aktif as $pinjam)
                                        <tr>
                                            <td>{{ $pinjam->buku->judul }}</td>
                                            <td>{{ $pinjam->tanggal_pinjam->format('d/m/Y') }}</td>
                                            <td>{{ $pinjam->tanggal_kembali->format('d/m/Y') }}</td>
                                            <td>
                                                @if($pinjam->is_late)
                                                    <span class="badge bg-danger-lt">Terlambat</span>
                                                @else
                                                    <span class="badge bg-success-lt">Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    
</div>

<!-- Modal QR Code -->
<div class="modal modal-blur fade" id="modal-qrcode" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ID Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div id="qrcode" class="mb-3"></div>
                <h3>{{ $anggota->nis }}</h3>
                <div class="text-muted">{{ $anggota->nama_lengkap }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .card-profile {
        position: relative;
        overflow: hidden;
    }
    
    .card-profile:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 120px;
        background: linear-gradient(135deg, #206bc4 0%, #25d6a2 100%);
        z-index: 0;
    }
    
    .card-profile .card-body {
        position: relative;
        z-index: 1;
    }
    
    .avatar-xxl {
        width: 8rem;
        height: 8rem;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .avatar-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
    }
    
    .form-control-plaintext {
        min-height: 38px;
        padding: 0.375rem 0;
    }
</style>