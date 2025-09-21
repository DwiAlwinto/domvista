<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Manajemen Buku</div>
                    <h1 class="page-title">
                        Detail Buku
                    </h1>
                </div>
                
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 6l-6 6l6 6"></path>
                            </svg>
                            Kembali ke Daftar
                        </a>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">
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
                <!-- Header Card -->
                <div class="col-12">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    @if($buku->cover)
                                        <img src="{{ asset('storage/cover_buku/' . $buku->cover) }}" class="avatar avatar-lg" style="object-fit: cover">
                                    @else
                                        <span class="avatar avatar-lg bg-blue-lt">
                                            <i class="ti ti-book fs-3"></i>
                                        </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium text-h2 mb-1">
                                        {{ $buku->judul_buku }}
                                    </div>
                                    <div class="text-muted">
                                        <span class="badge bg-blue-lt text-blue fw-bold me-2">ISBN: {{ $buku->isbn }}</span>
                                        <span class="me-2">Oleh: {{ $buku->penulis }}</span>
                                        <span>Tahun: {{ $buku->tahun_terbit }}</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-{{ $buku->jumlah > 0 ? 'success' : 'danger' }}">
                                        {{ $buku->jumlah > 0 ? 'Tersedia (' . $buku->jumlah . ')' : 'Habis' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Main Information Card -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Buku</h3>
                            <div class="card-actions">
                                <span class="text-muted">ID: {{ $buku->id }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kode Buku</label>
                                        <div class="form-control-plaintext">{{ $buku->kode_buku }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Judul Buku</label>
                                        <div class="form-control-plaintext">{{ $buku->judul_buku }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penulis</label>
                                        <div class="form-control-plaintext">{{ $buku->penulis }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penerbit</label>
                                        <div class="form-control-plaintext">{{ $buku->penerbit->nama ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Terbit</label>
                                        <div class="form-control-plaintext">{{ $buku->tahun_terbit }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Buku</label>
                                        <div class="form-control-plaintext">{{ $buku->jenis->nama ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <div class="form-control-plaintext">{{ $buku->kategori->nama ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Bahasa</label>
                                        <div class="form-control-plaintext">{{ $buku->bahasa }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Halaman</label>
                                        <div class="form-control-plaintext">{{ $buku->jumlah_halaman }} halaman</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Stok Tersedia</label>
                                        <div class="form-control-plaintext">{{ $buku->jumlah }} eksemplar</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-0">
                                <label class="form-label">Sinopsis</label>
                                <div class="card card-body">
                                    {!! nl2br(e($buku->sinopsis)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information Card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Metadata</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-4 text-center">
                                @if($buku->cover)
                                    <img src="{{ asset('storage/cover_buku/' . $buku->cover) }}" class="img-fluid rounded border" style="max-height: 200px" alt="Cover Buku">
                                @else
                                    <div class="empty">
                                        <div class="empty-img">
                                            <img src="{{ asset('static/illustrations/undraw_reading_time_re_phf7.svg') }}" height="128" alt="">
                                        </div>
                                        <p class="empty-title">Tidak ada cover</p>
                                        <p class="empty-subtitle text-muted">
                                            Buku ini belum memiliki gambar cover
                                        </p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="hr-text hr-text-left">Informasi Sistem</div>
                            
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-{{ $buku->status ? 'success' : 'warning' }}">
                                            {{ $buku->status ? 'Aktif' : 'Non-Aktif' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Dibuat Pada</div>
                                    <div class="datagrid-content">
                                        {{ $buku->created_at->format('d M Y H:i') }}
                                        <small class="text-muted">({{ $buku->created_at->diffForHumans() }})</small>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Diperbarui Pada</div>
                                    <div class="datagrid-content">
                                        {{ $buku->updated_at->format('d M Y H:i') }}
                                        <small class="text-muted">({{ $buku->updated_at->diffForHumans() }})</small>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Ditambahkan Oleh</div>
                                    <div class="datagrid-content">
                                        {{ $buku->createdBy->name ?? 'System' }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Diperbarui Oleh</div>
                                    <div class="datagrid-content">
                                        {{ $buku->updatedBy->name ?? 'System' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- QR Code Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kode Buku</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                {{-- {!! QrCode::size(150)->generate($buku->kode_buku) !!} --}}
                                {{ $buku->kode_buku }}
                            </div>
                            <div class="text-muted">
                                Scan QR code untuk melihat detail buku
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Activity Log -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Peminjaman Terakhir</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Peminjam</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @forelse($buku->peminjaman()->latest()->take(5)->get() as $pinjam)
                                    <tr>
                                        <td>TRX-{{ str_pad($pinjam->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $pinjam->user->name }}</td>
                                        <td>{{ $pinjam->tanggal_pinjam->format('d M Y') }}</td>
                                        <td>
                                            @if($pinjam->tanggal_kembali)
                                                {{ $pinjam->tanggal_kembali->format('d M Y') }}
                                            @else
                                                <span class="text-muted">Belum dikembalikan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($pinjam->status == 'dipinjam')
                                                <span class="badge bg-warning">Dipinjam</span>
                                            @elseif($pinjam->status == 'dikembalikan')
                                                <span class="badge bg-success">Dikembalikan</span>
                                            @else
                                                <span class="badge bg-danger">Terlambat</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('peminjaman.show', $pinjam->id) }}" class="btn btn-icon" aria-label="Lihat detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="empty">
                                                <div class="empty-img">
                                                    <img src="{{ asset('static/illustrations/undraw_books_re_8gea.svg') }}" height="128" alt="">
                                                </div>
                                                <p class="empty-title">Belum ada riwayat peminjaman</p>
                                                <p class="empty-subtitle text-muted">
                                                    Buku ini belum pernah dipinjam
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-plaintext {
        padding: 0.375rem 0;
        margin-bottom: 0;
        line-height: 1.5;
        background-color: transparent;
        border: solid transparent;
        border-width: 1px 0;
        font-weight: 500;
    }
    
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
        background-color: #f8f9fa;
    }
    
    .card-title {
        font-weight: 600;
        color: #495057;
    }
    
    .datagrid {
        border-radius: 6px;
        overflow: hidden;
    }
    
    .datagrid-item {
        padding: 12px 16px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
    }
    
    .datagrid-item:last-child {
        border-bottom: none;
    }
    
    .datagrid-title {
        width: 40%;
        color: #6c757d;
        font-weight: 500;
    }
    
    .datagrid-content {
        flex: 1;
        font-weight: 500;
    }
    
    .hr-text {
        font-size: 12px;
        font-weight: 600;
        color: #6c757d;
        margin: 16px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .hr-text:after {
        content: "";
        display: inline-block;
        width: 100%;
        height: 1px;
        background: rgba(0,0,0,0.1);
        position: relative;
        top: -4px;
        margin-left: 10px;
    }
    
    .hr-text-left:after {
        margin-left: 10px;
    }
    
    .text-h2 {
        font-size: 1.5rem;
        font-weight: 600;
        line-height: 1.2;
    }
    
    .empty {
        padding: 1rem;
    }
    
    .empty-img {
        height: 128px;
        margin-bottom: 1rem;
    }
    
    .empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .empty-subtitle {
        font-size: 0.875rem;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Print functionality
        document.querySelector('.btn-print').addEventListener('click', function() {
            window.print();
        });
        
        // Copy QR code URL
        document.querySelector('.btn-copy-qr').addEventListener('click', function() {
            const url = "{{ route('buku.show', $buku->id) }}";
            navigator.clipboard.writeText(url).then(() => {
                toastr.success('URL buku berhasil disalin');
            });
        });
    });
</script>
@endpush