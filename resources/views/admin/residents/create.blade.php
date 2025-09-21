<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-3 align-items-center">
                <div class="col">
                    <h2 class="page-title fw-bold text-primary-emphasis">Add New Resident</h2>
                    <p class="text-muted mb-0">Fill in the new resident's information completely and accurately.</p>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.master.residents.index') }}" class="btn btn-outline-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5M12 19l-7-7 7-7" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl py-4">
            <form action="{{ route('admin.master.residents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">

                    <!-- Personal Information -->
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-white border-0 pb-0">
                                <h3 class="card-title h5 text-primary-emphasis">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#51A49A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    Personal Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Enter full name" value="{{ old('full_name') }}" required>
                                            @error('full_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Phone</label>
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="+62812..." value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">ID Number (KTP/Passport/KITAS)</label>
                                            <input type="text" name="identity_number" class="form-control @error('identity_number') is-invalid @enderror" placeholder="3271xxxxxx" value="{{ old('identity_number') }}">
                                            @error('identity_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nationality</label>
                                            <select name="citizenship" class="form-select @error('citizenship') is-invalid @enderror">
                                                <option value="">Select nationality</option>
                                                <option value="WNI" {{ old('citizenship') == 'WNI' ? 'selected' : '' }}>Indonesian (WNI)</option>
                                                <option value="WNA" {{ old('citizenship') == 'WNA' ? 'selected' : '' }}>Foreigner (WNA)</option>
                                            </select>
                                            @error('citizenship')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Religion</label>
                                            <select name="religion" class="form-select @error('religion') is-invalid @enderror">
                                                <option value="">Select religion</option>
                                                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Protestant</option>
                                                <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Catholic</option>
                                                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddhist</option>
                                                <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Confucian</option>
                                            </select>
                                            @error('religion')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">Date of Birth</label>
                                                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
                                                @error('date_of_birth')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Gender</label>
                                            <div class="d-flex gap-4">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                    <span class="form-check-label">Male</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                    <span class="form-check-label">Female</span>
                                                </label>
                                            </div>
                                            @error('gender')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-white border-0 pb-0">
                                <h3 class="card-title h5 text-primary-emphasis">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#51A49A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                                    </svg>
                                    Employment Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Occupation</label>
                                            <input type="text" name="occupation" class="form-control" placeholder="Architect, Doctor, etc." value="{{ old('occupation') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Company</label>
                                            <input type="text" name="company" class="form-control" placeholder="PT. XYZ" value="{{ old('company') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Agent Name (if represented)</label>
                                            <input type="text" name="agent_name" class="form-control" placeholder="John Doe" value="{{ old('agent_name') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Agent Company</label>
                                            <input type="text" name="agent_company" class="form-control" placeholder="Agency Corp" value="{{ old('agent_company') }}">
                                        </div>
                                        <div class="mb-3">
                                        <label class="form-label fw-semibold">Agent's Phone Number</label>
                                        <input type="text" name="number_agent" class="form-control @error('number_agent') is-invalid @enderror"
                                            placeholder="+62812..." value="{{ old('number_agent', $resident->number_agent ?? '') }}">
                                        @error('number_agent')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Unit, Parking & Status -->
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-white border-0 pb-0">
                                <h3 class="card-title h5 text-primary-emphasis">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#51A49A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="3" y1="9" x2="21" y2="9"></line>
                                        <line x1="9" y1="21" x2="9" y2="9"></line>
                                    </svg>
                                    Unit, Parking & Status
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Tower <span class="text-danger">*</span></label>
                                            <select id="tower-select" class="form-select" onchange="filterUnitsAndParking()">
                                                <option value="">Select Tower</option>
                                                @foreach($towers as $tower)
                                                    <option value="{{ $tower->id }}">{{ $tower->name }} ({{ $tower->location }})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Unit <span class="text-danger">*</span></label>
                                            <select name="unit_id" id="unit-select" class="form-select @error('unit_id') is-invalid @enderror" required onchange="filterParking()">
                                                <option value="">Select unit</option>
                                                @foreach($units as $unit)
                                                    <option data-tower-id="{{ $unit->tower->id }}" value="{{ $unit->id }}">
                                                        {{ $unit->unit_code }} ({{ $unit->tower->name }}, Floor {{ $unit->floor->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('unit_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Resident Status <span class="text-danger">*</span></label>
                                            <select name="role" id="role-select" class="form-select @error('role') is-invalid @enderror" required onchange="toggleRequiredDocuments()">
                                                <option value="">Select Status</option>
                                                <option value="Owner" {{ old('role') == 'Owner' ? 'selected' : '' }}>Owner</option>
                                                <option value="Leasee" {{ old('role') == 'Leasee' ? 'selected' : '' }}>Leasee</option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="mb-3">
                                            <label class="form-label fw-semibold">Move-in Date <span class="text-danger">*</span></label>
                                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required>
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- ✅ Tambahkan ID untuk kontrol JavaScript -->
                                        <div class="mb-3 end-date-container" id="end-date-container">
                                            <label class="form-label fw-semibold">End Date (if rental)</label>
                                            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Leave blank if still active.</small>
                                        </div>

                                        <!-- ✅ DATE SOLD & HANDOVER UNTUK OWNER -->
                                            <div class="mb-3 owner-date-fields d-none" id="owner-date-fields">
                                                <h6 class="text-primary fw-semibold mb-2">Property Ownership Details</h6>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Date of Sale</label>
                                                    <input type="date" name="date_sold" class="form-control @error('date_sold') is-invalid @enderror"
                                                        value="{{ old('date_sold') }}">
                                                    @error('date_sold')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <small class="text-muted">Tanggal pembelian properti oleh pemilik.</small>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Date of Handover</label>
                                                    <input type="date" name="date_handover" class="form-control @error('date_handover') is-invalid @enderror"
                                                        value="{{ old('date_handover') }}">
                                                    @error('date_handover')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <small class="text-muted">Tanggal serah terima unit dari developer atau pemilik sebelumnya.</small>
                                                </div>
                                            </div>

                                        

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Assign Parking Lot (Max 3)</label>
                                            <select name="parking_ids[]" id="parking-select" class="form-select" multiple size="5">
                                                <option value="" disabled>-- Select up to 3 parking slots --</option>
                                                @foreach($parkingLots as $parking)
                                                    <option value="{{ $parking->id }}" data-info="{{ $parking->parkingArea->area_code }} - {{ $parking->lot_number }} ({{ $parking->lot_type }})">
                                                        {{ $parking->parkingArea->area_code }} - {{ $parking->lot_number }} ({{ $parking->lot_type }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Hold Ctrl/Cmd to select multiple. Max 3.</small>
                                            <div class="text-danger mt-1 d-none" id="parking-error">Maximum 3 parking lots can be selected.</div>
                                        </div>

                                        <div class="mb-3" id="parking-preview" style="display: none;">
                                            <label class="form-label fw-semibold">Selected Parking</label>
                                            <div class="d-flex flex-wrap gap-2" id="parking-chips"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Documents -->
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-white border-0 pb-0">
                                <h3 class="card-title h5 text-primary-emphasis">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#51A49A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <line x1="10" y1="9" x2="8" y2="9"></line>
                                    </svg>
                                    Upload Documents
                                </h3>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">Upload required documents based on resident status. Max 5MB (PDF, JPG, PNG).</p>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Identity Card (KTP) <span class="text-danger">*</span></label>
                                    <input type="file" name="ktp_file" class="form-control @error('ktp_file') is-invalid @enderror" accept=".pdf,image/*" required>
                                    @error('ktp_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Scan of the resident's ID card.</small>
                                </div>

                                <div id="dynamic-documents">
                                    <!-- Dynamically filled by JavaScript -->
                                </div>

                                <div class="mt-4">
                                    <label class="form-label fw-semibold">Additional Documents</label>
                                    <div id="additional-docs">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-5">
                                                <input type="text" name="doc_type[]" class="form-control" placeholder="Document type">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="doc_file[]" class="form-control" accept=".pdf,image/*">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeDoc(this)">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addDocField()">
                                        + Add Document
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-2" style="background-color: #51A49A; border-color: #51A49A;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M10 12v.01" />
                                <path d="M14 12v.01" />
                                <path d="M12 10v4" />
                            </svg>
                            Save Resident
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- JavaScript -->
<script>
    function filterUnitsAndParking() {
        const towerId = document.getElementById('tower-select').value;
        const unitSelect = document.getElementById('unit-select');
        const parkingSelect = document.getElementById('parking-select');
        const unitOptions = unitSelect.querySelectorAll('option');
        const parkingOptions = parkingSelect.querySelectorAll('option');

        unitOptions.forEach(option => {
            if (option.value === '' || !option.hasAttribute('data-tower-id')) {
                option.style.display = '';
            } else {
                option.style.display = option.getAttribute('data-tower-id') == towerId ? '' : 'none';
            }
        });
        unitSelect.value = '';

        parkingOptions.forEach(option => {
            if (option.value === '' || !option.hasAttribute('data-tower-id')) {
                option.style.display = '';
            } else {
                option.style.display = option.getAttribute('data-tower-id') == towerId ? '' : 'none';
            }
        });
        parkingSelect.value = '';
    }

    function filterParking() {
        const unitId = document.getElementById('unit-select').value;
        // Optional: Extend logic here
    }

 function toggleRequiredDocuments() {
    const role = document.getElementById('role-select').value;
    const container = document.getElementById('dynamic-documents');
    const endDateContainer = document.getElementById('end-date-container');
    const ownerDateFields = document.getElementById('owner-date-fields');

    // Reset semua konten dinamis
    container.innerHTML = '';

    // Reset dan sembunyikan semua field terkait role
    if (endDateContainer) {
        endDateContainer.classList.add('d-none');
        const end_date_input = endDateContainer.querySelector('input[name="end_date"]');
        end_date_input.value = '';
        end_date_input.disabled = true;
    }

    if (ownerDateFields) {
        ownerDateFields.classList.add('d-none');
        ownerDateFields.querySelectorAll('input[type="date"]').forEach(input => {
            input.value = '';
            input.disabled = true;
        });
    }

    // === LOGIKA BERDASARKAN ROLE ===
    if (role === 'Owner' || role === 'Co-Owner') {
        // Tampilkan dokumen kepemilikan
        container.innerHTML += `
            <div class="mb-3">
                <label class="form-label fw-semibold">Property Ownership Certificate (SHM) / Deed <span class="text-danger">*</span></label>
                <input type="file" name="ownership_file" class="form-control" accept=".pdf,image/*">
                <small class="text-muted">Proof of property ownership.</small>
            </div>
        `;

        // Sembunyikan end_date — Owner tidak punya kontrak berakhir
        if (endDateContainer) {
            endDateContainer.classList.add('d-none');
        }

        // Tampilkan field kepemilikan (date_sold, date_handover)
        if (ownerDateFields) {
            ownerDateFields.classList.remove('d-none');
            ownerDateFields.querySelectorAll('input[type="date"]').forEach(input => {
                input.disabled = false; // Aktifkan
            });
        }

    } else if (role === 'Leasee' || role === 'Co-Leasee') {
        // Tampilkan dokumen sewa
        container.innerHTML += `
            <div class="mb-3">
                <label class="form-label fw-semibold">Lease Agreement <span class="text-danger">*</span></label>
                <input type="file" name="lease_file" class="form-control" accept=".pdf,image/*">
                <small class="text-muted">Valid lease contract.</small>
            </div>
        `;

        // Tampilkan end_date — Leasee harus punya durasi sewa
        if (endDateContainer) {
            endDateContainer.classList.remove('d-none');
            const end_date_input = endDateContainer.querySelector('input[name="end_date"]');
            end_date_input.disabled = false; // Aktifkan input
        }

        // Sembunyikan field kepemilikan (tidak relevan untuk penyewa)
        if (ownerDateFields) {
            ownerDateFields.classList.add('d-none');
            ownerDateFields.querySelectorAll('input[type="date"]').forEach(input => {
                input.disabled = true;
                input.value = '';
            });
        }
    } else {
        // Jika belum pilih role, sembunyikan semua
        if (endDateContainer) {
            endDateContainer.classList.add('d-none');
        }
        if (ownerDateFields) {
            ownerDateFields.classList.add('d-none');
            ownerDateFields.querySelectorAll('input[type="date"]').forEach(input => {
                input.disabled = true;
                input.value = '';
            });
        }
    }
}

    function addDocField() {
        const container = document.getElementById('additional-docs');
        const row = document.createElement('div');
        row.className = 'row g-2 mb-2';
        row.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="doc_type[]" class="form-control" placeholder="Document type">
            </div>
            <div class="col-md-6">
                <input type="file" name="doc_file[]" class="form-control" accept=".pdf,image/*">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeDoc(this)">X</button>
            </div>
        `;
        container.appendChild(row);
    }

    function removeDoc(button) {
        button.closest('.row').remove();
    }

    function updateParkingPreview() {
        const select = document.getElementById('parking-select');
        const selectedOptions = Array.from(select.selectedOptions);
        const previewContainer = document.getElementById('parking-preview');
        const chipsContainer = document.getElementById('parking-chips');
        const errorDiv = document.getElementById('parking-error');

        chipsContainer.innerHTML = '';
        errorDiv.classList.add('d-none');

        if (selectedOptions.length > 3) {
            errorDiv.classList.remove('d-none');
            while (selectedOptions.length > 3) {
                const last = selectedOptions.pop();
                last.selected = false;
            }
            return;
        }

        if (selectedOptions.length > 0) {
            previewContainer.style.display = 'block';
            selectedOptions.forEach(option => {
                const chip = document.createElement('div');
                chip.className = 'badge bg-primary-lt px-3 py-2 d-flex align-items-center';
                chip.style.fontSize = '0.875rem';
                chip.innerHTML = `
                    ${option.dataset.info}
                    <button type="button" class="btn-close btn-close-white ms-2" style="font-size: 0.6rem;" onclick="removeParking('${option.value}')"></button>
                `;
                chipsContainer.appendChild(chip);
            });
        } else {
            previewContainer.style.display = 'none';
        }
    }

    function removeParking(value) {
        const option = document.querySelector(`#parking-select option[value="${value}"]`);
        if (option) option.selected = false;
        updateParkingPreview();
    }

    document.getElementById('parking-select').addEventListener('change', updateParkingPreview);

    document.addEventListener('DOMContentLoaded', function () {
        toggleRequiredDocuments();
        updateParkingPreview();
        const startDateInput = document.querySelector('[name="start_date"]');
    const endDateInput = document.querySelector('[name="end_date"]');

    if (startDateInput && endDateInput) {
        startDateInput.addEventListener('change', function () {
            endDateInput.min = this.value; // Batasi end_date tidak boleh sebelum start_date
        });

        // Set min saat load jika sudah ada nilai
        if (startDateInput.value) {
            endDateInput.min = startDateInput.value;
        }
    }
    });
</script>

<style>
        #owner-date-fields {
        border-left: 4px solid #51A49A;
        padding-left: 1rem;
        margin-top: 1rem;
        background-color: #f8f9fa;
        border-radius: 0 8px 8px 0;
    }
    .card-title {
        font-weight: 600;
        font-size: 1.1rem;
    }
    .form-label, .form-check-label {
        font-weight: 500;
    }
    .btn-primary {
        background-color: #51A49A !important;
        border-color: #51A49A !important;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #448a80 !important;
        border-color: #448a80 !important;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: 1px solid #eee;
    }
    .form-control:focus, .form-select:focus {
        border-color: #51A49A;
        box-shadow: 0 0 0 0.2rem rgba(81, 164, 154, 0.25);
    }
    .badge.bg-primary-lt {
        background-color: #e6f7f5;
        color: #51A49A;
    }
</style>