<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title">Staf Pendukung</h4>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
            Tambah
        </button>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Telepon</th>
                    <th>Plat Nomor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($resident->staffs->isEmpty())
                    <tr><td colspan="5" class="text-center text-muted">Belum ada staf terdaftar</td></tr>
                @else
                    @foreach($resident->staffs as $staff)
                        <tr>
                            <td>{{ $staff->name }}</td>
                            <td><span class="badge bg-orange-lt">{{ $staff->type }}</span></td>
                            <td>{{ $staff->phone }}</td>
                            <td>{{ $staff->license_plate }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDeleteStaff({{ $staff->id }})">
                                    Hapus
                                </button>
                                <form id="delete-staff-{{ $staff->id }}" action="{{ route('admin.master.residents.staff.destroy', $staff) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Staf -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.master.residents.staff.store', $resident) }}" method="POST">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStaffModalLabel">Tambah Staf</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select name="type" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="Driver">Sopir</option>
                            <option value="Maid">Pembantu</option>
                            <option value="Security">Satpam Pribadi</option>
                            <option value="Gardener">Tukang Kebun</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Plat Nomor Kendaraan</label>
                        <input type="text" name="license_plate" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDeleteStaff(id) {
    if (confirm('Yakin ingin menghapus staf ini?')) {
        document.getElementById('delete-staff-' + id).submit();
    }
}
</script>
@endpush