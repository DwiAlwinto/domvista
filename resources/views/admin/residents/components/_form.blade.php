<form action="{{ $action }}" method="POST">
    @csrf
    @if($method) @method($method) @endif

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                       value="{{ old('full_name', $resident->full_name ?? '') }}" required>
                @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $resident->email ?? '') }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $resident->phone ?? '') }}">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Nomor Identitas (KTP)</label>
                <input type="text" name="identity_number" class="form-control @error('identity_number') is-invalid @enderror"
                       value="{{ old('identity_number', $resident->identity_number ?? '') }}">
                @error('identity_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Kewarganegaraan</label>
                <input type="text" name="citizenship" class="form-control"
                       value="{{ old('citizenship', $resident->citizenship ?? 'Indonesia') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Agama</label>
                <input type="text" name="religion" class="form-control"
                       value="{{ old('religion', $resident->religion ?? '') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <input type="date" name="date_of_birth" class="form-control"
       value="{{ old('date_of_birth', $resident->date_of_birth ? \Carbon\Carbon::parse($resident->date_of_birth)->format('Y-m-d') : '') }}">
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-control">
                    <option value="">Pilih</option>
                    <option value="Male" {{ (old('gender', $resident->gender ?? '') == 'Male') ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Female" {{ (old('gender', $resident->gender ?? '') == 'Female') ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="occupation" class="form-control"
                       value="{{ old('occupation', $resident->occupation ?? '') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Perusahaan</label>
                <input type="text" name="company" class="form-control"
                       value="{{ old('company', $resident->company ?? '') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Agen (Jika Sewa)</label>
                <input type="text" name="agent_name" class="form-control"
                       value="{{ old('agent_name', $resident->agent_name ?? '') }}">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-check form-switch">
            <input type="checkbox" name="is_owner" class="form-check-input"
                   {{ (old('is_owner', $resident->is_owner ?? true)) ? 'checked' : '' }}>
            <span class="form-check-label">Apakah pemilik?</span>
        </label>
    </div>

    <hr>

    <h4 class="mt-4">Asosiasi Unit</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Unit</label>
                <select name="unit_id" class="form-control" required>
                    <option value="">Pilih Unit</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ (old('unit_id', $currentUnit?->id ?? '') == $unit->id) ? 'selected' : '' }}>
                            {{ $unit->unit_code }} ({{ $unit->tower->name }}, Lantai {{ $unit->floor->floor_number }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Peran</label>
                <select name="role" class="form-control" required>
                    <option value="Owner" {{ (old('role', 'Owner') == 'Owner') ? 'selected' : '' }}>Pemilik</option>
                    <option value="Leasee" {{ (old('role') == 'Leasee') ? 'selected' : '' }}>Penyewa</option>
                    <option value="Co-Owner" {{ (old('role') == 'Co-Owner') ? 'selected' : '' }}>Ko-Pemilik</option>
                    <option value="Co-Leasee" {{ (old('role') == 'Co-Leasee') ? 'selected' : '' }}>Ko-Penyewa</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" required
                       value="{{ old('start_date', now()->format('Y-m-d')) }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Tanggal Berakhir (Opsional)</label>
                <input type="date" name="end_date" class="form-control"
                       value="{{ old('end_date', $currentUnit?->pivot->end_date?->format('Y-m-d') ?? '') }}">
            </div>
        </div>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>