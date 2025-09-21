<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md">
                    <div class="d-flex align-items-center">
                        <div class="me-2 me-md-3">
                            <span class="avatar avatar-lg bg-blue-lt">
                                <i class="ti ti-users fs-3"></i>
                            </span>
                        </div>
                        <div>
                            <h2 class="page-title mb-0">
                                {{ isset($anggota) ? 'Edit Data Anggota' : 'Tambah Anggota Baru' }}
                            </h2>
                            <div class="text-muted mt-1">
                                <span class="badge bg-blue-lt text-blue fw-bold">12</span> anggota terdaftar
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-md-auto d-print-none mt-3 mt-md-0">
                    <div class="btn-list d-flex flex-wrap justify-content-end">
                        <a href="/admin/master/anggota" class="btn btn-primary btn-sm mb-2 mb-md-0 me-2">
                            <i class="ti ti-arrow-back me-1 me-md-2"></i>
                            <span class="d-none d-md-inline">Kembali ke Data Anggota</span>
                        </a>
                        <button class="btn btn-outline-primary btn-sm mb-2 mb-md-0">
                            <i class="ti ti-download me-1 me-md-2"></i>
                            <span class="d-none d-md-inline">Export</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($anggota) ? 'Edit Data Anggota' : 'Formulir Pendaftaran Anggota' }}</h3>
                    <div class="card-actions">
                        <a href="#" class="btn btn-ghost-primary btn-sm">
                            <i class="ti ti-help"></i>
                            <span class="d-none d-md-inline">Bantuan</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @isset($anggota)
                        <form action="/admin/master/anggota/{{ $anggota->id }}" method="POST" enctype="multipart/form-data" >
                            @method('PUT')
                    @endisset
                    <form action="/admin/master/anggota/" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label required">NIS</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-id"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nis') is-invalid @enderror" 
                                           name="nis" placeholder="Masukkan Nomor Induk Siswa" 
                                           value="{{ old('nis', $anggota->nis ?? '') }}">
                                    @error('nis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <small class="text-muted">Nomor Induk Siswa (contoh: 20230001)</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label required">Nomor Hp Siswa</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                           name="no_hp" placeholder="Masukkan Nomor Hp Siswa" 
                                           value="{{ old('no_hp', $anggota->no_hp ?? '') }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <small class="text-muted">Contoh: 081234567890</small>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label required">Nama Lengkap</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                           name="nama_lengkap" placeholder="Masukkan nama lengkap" 
                                           value="{{ old('nama_lengkap', $anggota->nama_lengkap ?? '') }}">
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label required">Jenis Kelamin</label>
                            </div>

                            <div class="col-12 col-md-9">
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="gender" value="Laki-laki" class="form-selectgroup-input" 
                                            {{ old('gender', $anggota->gender ?? '') == 'Laki-laki' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            <i class="ti ti-gender-male me-1"></i> Laki-laki
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="gender" value="Perempuan" class="form-selectgroup-input"
                                            {{ old('gender', $anggota->gender ?? '') == 'Perempuan' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label">
                                            <i class="ti ti-gender-female me-1"></i> Perempuan
                                        </span>
                                    </label>
                                </div>
                                @error('gender')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label required">Tempat Tanggal Lahir</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="row g-2">
                                    <div class="col-12 col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ti ti-map-pin"></i>
                                            </span>
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                                   name="tempat_lahir" placeholder="Tempat Lahir Siswa" 
                                                   value="{{ old('tempat_lahir', $anggota->tempat_lahir ?? '') }}">
                                            @error('tempat_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ti ti-calendar"></i>
                                            </span>
                                            <input type="date" 
                                                   class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                                   name="tanggal_lahir" 
                                                   placeholder="Tanggal Lahir Siswa" 
                                                   value="{{ old('tanggal_lahir', $anggota->tanggal_lahir ?? '') }}">
                                            @error('tanggal_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label">Agama</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-select @error('agama') is-invalid @enderror" name="agama">
                                    <option value="">Pilih Agama</option>
                                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                        <option value="{{ $agama }}" {{ old('agama', $anggota->agama ?? '') == $agama ? 'selected' : '' }}>
                                            {{ $agama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label">Kelas</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-select @error('kelas') is-invalid @enderror" name="kelas">
                                    <option value="">Pilih Kelas</option>
                                    @foreach(range(7, 9) as $kelas)
                                        <option value="{{ $kelas }}" {{ old('kelas', $anggota->kelas ?? '') == $kelas ? 'selected' : '' }}>
                                            Kelas {{ $kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label">Alamat</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          name="alamat" rows="3" 
                                          placeholder="Masukkan alamat lengkap">{{ old('alamat', $anggota->alamat ?? '') }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-form-label text-md-end">
                                <label class="form-label">Foto Profil</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="d-flex flex-column flex-md-row gap-3">
                                    @if(isset($anggota) && $anggota->foto)
                                        <div class="avatar avatar-xl mb-2 mb-md-0" style="background-image: url({{ asset('storage/foto_anggota/' . $anggota->foto) }})"></div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" accept="image/*">
                                        <small class="text-muted d-block mt-1">Format: JPG, PNG (Maksimal 2MB)</small>
                                        @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card-footer text-end">
                            <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                                <button type="reset" class="btn btn-outline-secondary order-1 order-md-0 riset">
                                    <i class="ti ti-x me-1"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary order-0 order-md-1">
                                    <i class="ti ti-device-floppy me-1"></i> {{ isset($anggota) ? 'Update Data' : 'Simpan Data' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 for confirmation -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reset button confirmation
        document.querySelector('.riset').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin mengosongkan form?',
                text: "Semua data yang sudah diisi akan hilang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kosongkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('form').reset();
                }
            });
        });
        
        // Form submission success handling would be here if needed
    });
</script>
@endpush