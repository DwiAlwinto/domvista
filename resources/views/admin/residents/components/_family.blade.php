<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title">Anggota Keluarga</h4>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addFamilyModal">
            Tambah
        </button>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Hubungan</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($resident->familyMembers->isEmpty())
                    <tr><td colspan="5" class="text-center text-muted">Belum ada anggota keluarga</td></tr>
                @else
                    @foreach($resident->familyMembers as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->relationship }}</td>
                            <td>{{ $member->date_of_birth?->format('d M Y') }}</td>
                            <td><span class="badge bg-{{ $member->gender == 'Male' ? 'blue' : 'pink' }}-lt">{{ $member->gender }}</span></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDeleteFamily({{ $member->id }})">
                                    Hapus
                                </button>
                                <form id="delete-family-{{ $member->id }}" action="{{ route('admin.master.residents.family.destroy', $member) }}" method="POST" style="display: none;">
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

<!-- Modal Tambah Keluarga -->
<div class="modal fade" id="addFamilyModal" tabindex="-1" aria-labelledby="addFamilyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.master.residents.family.store', $resident) }}" method="POST">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFamilyModalLabel">Tambah Anggota Keluarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hubungan</label>
                        <input type="text" name="relationship" class="form-control" placeholder="Contoh: Anak, Istri, Ayah" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="gender" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="Male">Laki-laki</option>
                                    <option value="Female">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Identitas</label>
                        <input type="text" name="identity_number" class="form-control">
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
function confirmDeleteFamily(id) {
    if (confirm('Yakin ingin menghapus anggota keluarga ini?')) {
        document.getElementById('delete-family-' + id).submit();
    }
}
</script>
@endpush