<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Anggota
                    </h2>
                    <div class="text-muted mt-1">
                        Total 12 anggota terdaftar
                    </div>
                </div>
                
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Cari anggota..." id="search-member">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <a href="/admin/master/anggota/create" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah Anggota
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIS</th>
                                    <th>No HP</th>
                                    <th>Status Pinjam</th>
                                    <th>Status</th>
                                    <th class="w-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($anggota as $item)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-reset">
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar  me-2" style="background-image: url({{ asset('storage/foto_anggota/' . $item->foto) }})"></span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $item->nama_lengkap }}</div>
                                                <div class="text-muted">
                                                    <small>
                                                        {{ $item->tempat_lahir }},
                                                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->locale('id')->translatedFormat('j F Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>
                                       @if ($item->status_pinjam == 'Pinjam')
                                       <span class="badge badge-pill bg-yellow-lt"> Pinjam</span>
                                       @else
                                       <span class="badge badge-pill bg-green-lt"> Bebas</span>
                                       @endif
                                    </td>
                                    <td>
                                        @if ($item->is_active == '1')
                                        <span class="badge badge-pill bg-green-lt"> 1</span>
                                        @else
                                        <span class="badge badge-pill bg-red-lt"> 2</span>
                                        @endif 
                                    </td>

                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <!-- Tombol Detail -->
                                            <a href="/admin/master/anggota/{{ $item->id }}" class="btn btn-icon btn-info" aria-label="Detail" title="detail">
                                                <i class="ti ti-eye fs-2"></i>
                                            </a>
                                            
                                            <!-- Tombol Edit -->
                                            <a href="/admin/master/anggota/{{ $item->id }}/edit" class="btn btn-icon btn-success" aria-label="Edit" title="edit">
                                                <i class="ti ti-edit fs-2"></i>
                                            </a>
                                    
                                            <!-- Tombol Delete -->
                                            <form action="/admin/master/anggota/{{ $item->id }}" method="POST" id="delete-form-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-icon btn-danger delete-button" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal" data-form-id="delete-form-{{ $item->id }}" title="delete">
                                                    <i class="ti ti-trash fs-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">Menampilkan <span>1</span> sampai <span>2</span> dari <span>12</span> entri</p>
                        <ul class="pagination m-0 ms-auto">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M15 6l-6 6l6 6" />
                                    </svg>
                                    prev
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
    
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 6l6 6l-6 6" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-blur fade" id="delete-confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Icon Danger -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 8l0 4" />
                    <path d="M12 16l.01 0" />
                </svg>
                <h3>Are you sure?</h3>
                <div class="text-secondary">Do you really want to delete this user? This action cannot be undone.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" id="confirm-delete-button" class="btn btn-danger w-100">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variabel untuk menyimpan ID form yang akan di-submit
        let deleteFormId;
    
        // Ketika tombol "Delete" di modal diklik
        document.getElementById('confirm-delete-button').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit(); // Submit form
            }
        });
    
        // Ketika tombol "Delete" di card user diklik
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                deleteFormId = this.getAttribute('data-form-id'); // Simpan ID form
            });
        });
    });
</script>