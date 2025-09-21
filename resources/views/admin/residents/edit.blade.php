<style>
            :root {
                --primary-color: #51A49A;
                --primary-dark: #3d8b80;
                --secondary-color: #2496CB;
                --secondary-dark: #1c7dbf;
                --light-bg: #f9fbfd;
                --border-color: #e0e6ed;
                --text-muted: #6c757d;
                --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            }

            body {
                background-color: var(--light-bg);
                font-family: 'Segoe UI', sans-serif;
            }

            .page-title {
                color: #2c3e50;
                font-weight: 600;
                letter-spacing: -0.5px;
            }

            .text-muted {
                color: var(--text-muted) !important;
            }

            .card {
                border: none;
                border-radius: 12px;
                box-shadow: var(--card-shadow);
                overflow: hidden;
                transition: transform 0.2s, box-shadow 0.2s;
                margin-bottom: 1.5rem;
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            }

            .card-header {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                font-weight: 600;
                border-bottom: none;
                padding: 1rem 1.25rem;
            }

            .card-title {
                color: white;
                font-size: 1.1rem;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .card-title svg {
                width: 20px;
                height: 20px;
                opacity: 0.9;
            }

            .card-body {
                padding: 1.5rem;
            }

            .form-label {
                font-weight: 500;
                color: #2c3e50;
            }

            .required-field::after {
                content: " *";
                color: #e74c3c;
            }

            .form-control,
            .form-select {
                border: 1.5px solid var(--border-color);
                border-radius: 8px;
                padding: 0.65rem 1rem;
                transition: border-color 0.3s, box-shadow 0.3s;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(81, 164, 154, 0.2);
                outline: none;
            }

            .form-control.is-invalid {
                border-color: #e74c3c;
                background-image: none;
            }

            .invalid-feedback {
                font-size: 0.875rem;
                margin-top: 0.35rem;
                color: #e74c3c;
            }

            .form-selectgroup-label {
                padding: 0.6rem 1rem;
                border-radius: 8px;
            }

            .form-selectgroup-input:checked + .form-selectgroup-label {
                background-color: var(--primary-color);
                color: white;
                border: 1px solid var(--primary-dark);
            }

            .profile-image-container {
                position: relative;
                width: 140px;
                height: 140px;
                margin: 0 auto 1.5rem;
                border-radius: 50%;
                overflow: hidden;
                border: 4px solid white;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                background-color: #f8f9fa;
            }

            .profile-image-placeholder {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
                background: #e9ecef;
                color: #6c757d;
                font-size: 2rem;
            }

            .profile-image-preview {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .profile-image-upload {
                position: absolute;
                bottom: 8px;
                right: 8px;
                background: var(--secondary-color);
                color: white;
                border-radius: 50%;
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                transition: background 0.2s;
            }

            .profile-image-upload:hover {
                background: var(--secondary-dark);
            }

            .btn-primary {
                background-color: var(--secondary-color);
                border: none;
                font-weight: 500;
                padding: 0.6rem 1.2rem;
                border-radius: 8px;
                transition: background-color 0.2s, transform 0.1s;
            }

            .btn-primary:hover {
                background-color: var(--secondary-dark);
                transform: translateY(-1px);
            }

            .btn-outline-secondary {
                color: var(--primary-color);
                border-color: var(--primary-color);
                transition: all 0.2s;
            }

            .btn-outline-secondary:hover {
                background-color: var(--primary-color);
                color: white;
            }

            .btn-outline-danger {
                border-color: #e74c3c;
                color: #e74c3c;
                font-weight: 500;
            }

            .btn-outline-danger:hover {
                background-color: #e74c3c;
                color: white;
            }

            .parking-badge {
                font-size: 0.75rem;
                padding: 0.35em 0.65em;
                background-color: var(--primary-color);
                color: white;
                border-radius: 6px;
            }

            .alert-info {
                background-color: #e8f5f3;
                border-left: 4px solid var(--primary-color);
                color: #2c3e50;
            }

            .modal-content {
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            }

            .modal-title {
                font-weight: 600;
                color: #2c3e50;
            }

            .btn-link-secondary {
                color: var(--text-muted);
            }

            .btn-link-secondary:hover {
                color: #2c3e50;
                text-decoration: none;
            }

            /* Tombol aksi tetap di kanan */
            .btn-list {
                display: flex;
                gap: 0.5rem;
            }

            /* Jarak antar card lebih rapi */
            .form-section + .form-section {
                margin-top: 1.5rem;
            }
</style>

<div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16.5 15l-2.5 2.5l-2.5 -2.5" />
                                <path d="M14 7h.01" />
                            </svg>
                            Edit Resident Data
                        </h2>
                        <div class="text-muted mt-1">Update apartment residents' information thoroughly</div>
                    </div>
                   <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <!-- Tombol Kembali -->
                            <a href="{{ route('admin.master.residents.index') }}" class="btn btn-brand-outline d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 12l14 0" />
                                    <path d="M5 12l6 6" />
                                    <path d="M5 12l6 -6" />
                                </svg>
                                Back
                            </a>

                            <!-- Tombol Simpan Perubahan -->
                            <button type="submit" form="editResidentForm" class="btn btn-brand-primary d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <circle cx="12" cy="14" r="2" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                               Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                
                <form action="{{ route('admin.master.residents.update', $resident->id) }}" method="POST" enctype="multipart/form-data" id="editResidentForm">
                    @csrf
                    @method('PUT')

                    <!-- Card: Informasi Pribadi -->
                    <div class="card form-section">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg>
                                Personal Information
                            </h3>
                        </div>
                        <div class="card-body">
                         

                            <div class="mb-3">
                                <label class="form-label required-field">Full Name</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name', $resident->full_name) }}" placeholder="Masukkan nama lengkap">
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $resident->email) }}" placeholder="email@contoh.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Telephone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $resident->phone) }}" placeholder="+62812...">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Identity Number (KTP/Passport)</label>
                                <input type="text" class="form-control @error('identity_number') is-invalid @enderror" name="identity_number" value="{{ old('identity_number', $resident->identity_number) }}" placeholder="3271xxxxxx">
                                @error('identity_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Citizenship</label>
                                        <select class="form-select @error('citizenship') is-invalid @enderror" name="citizenship">
                                            <option value="">Select nationality</option>
                                            <option value="WNI" {{ old('citizenship', $resident->citizenship) == 'WNI' ? 'selected' : '' }}>WNI</option>
                                            <option value="WNA" {{ old('citizenship', $resident->citizenship) == 'WNA' ? 'selected' : '' }}>WNA</option>
                                        </select>
                                        @error('citizenship')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Religion</label>
                                        <select class="form-select @error('religion') is-invalid @enderror" name="religion">
                                            <option value="">Choose a religion</option>
                                            <option value="Islam" {{ old('religion', $resident->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ old('religion', $resident->religion) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Catholic" {{ old('religion', $resident->religion) == 'Catholic' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ old('religion', $resident->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ old('religion', $resident->religion) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Confucian" {{ old('religion', $resident->religion) == 'Confucian' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                        @error('religion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date of birth</label>
                                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth', $resident->date_of_birth) }}">
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <div class="form-selectgroup w-100">
                                    <label class="form-selectgroup-item flex-fill text-center">
                                        <input type="radio" name="gender" value="male" class="form-selectgroup-input" {{ old('gender', $resident->gender) == 'male' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label d-flex flex-column align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-male mb-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="10" cy="14" r="5" />
                                                <line x1="19" y1="5" x2="13.6" y2="10.4" />
                                                <line x1="19" y1="5" x2="14" y2="5" />
                                                <line x1="19" y1="5" x2="19" y2="10" />
                                            </svg>
                                            Male
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill text-center">
                                        <input type="radio" name="gender" value="female" class="form-selectgroup-input" {{ old('gender', $resident->gender) == 'female' ? 'checked' : '' }}>
                                        <span class="form-selectgroup-label d-flex flex-column align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-female mb-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="9" r="5" />
                                                <line x1="12" y1="14" x2="12" y2="21" />
                                                <line x1="9" y1="18" x2="15" y2="18" />
                                            </svg>
                                            Female
                                        </span>
                                    </label>
                                </div>
                                @error('gender')
                                    <div class="invalid-feedback d-block mt-2 text-center">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Card: Informasi Pekerjaan -->
                    <div class="card form-section">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 21h18" />
                                    <path d="M3 10h18v11a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-11" />
                                    <path d="M3 3h7l3 6l3 -6h4" />
                                </svg>
                               Job Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Work</label>
                                <input type="text" class="form-control" name="occupation" value="{{ old('occupation', $resident->occupation) }}" placeholder="Arsitek, Dokter, dll">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Company</label>
                                <input type="text" class="form-control" name="company" value="{{ old('company', $resident->company) }}" placeholder="PT. XYZ">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Agent Name (if represented)</label>
                                <input type="text" class="form-control" name="agent_name" value="{{ old('agent_name', $resident->agent_name) }}" placeholder="John Doe">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Agent Company</label>
                                <input type="text" class="form-control" name="agent_company" value="{{ old('agent_company', $resident->agent_company) }}" placeholder="Agency Corp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Agent's Phone Number</label>
                                <input type="text" name="number_agent" class="form-control @error('number_agent') is-invalid @enderror"
                                    placeholder="+62812..." value="{{ old('number_agent', $resident->number_agent ?? '') }}">
                               
                            </div>

                        </div>
                    </div>

                    <!-- Card: Unit & Status -->
                        <div class="card form-section">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 21v-13a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                                    </svg>
                                    Unit & Status
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required-field">Towers</label>
                                    <select id="tower-select" class="form-select" onchange="filterUnits()">
                                        <option value="">Select Towers</option>
                                        @foreach($towers as $tower)
                                            <option value="{{ $tower->id }}" {{ $currentUnit && $currentUnit->tower->id == $tower->id ? 'selected' : '' }}>
                                                {{ $tower->name }} ({{ $tower->location }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required-field">Units</label>
                                    <select name="unit_id" id="unit-select" class="form-select @error('unit_id') is-invalid @enderror" required>
                                        <option value="">Select units</option>
                                        @foreach($units as $unit)
                                            <option data-tower-id="{{ $unit->tower->id }}" value="{{ $unit->id }}"
                                                {{ old('unit_id', $currentUnit ? $currentUnit->id : '') == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->unit_code }} ({{ $unit->tower->name }}, Floor {{ $unit->floor->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required-field">Occupant Status</label>
                                    <select name="role" id="role-select" class="form-select @error('role') is-invalid @enderror" required>
                                        <option value="">Select Status</option>
                                        <option value="Owner" {{ old('role', $resident->units->first()->pivot->role ?? '') == 'Owner' ? 'selected' : '' }}>Owner</option>
                                        <option value="Leasee" {{ old('role', $resident->units->first()->pivot->role ?? '') == 'Leasee' ? 'selected' : '' }}>Leasee</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Mulai (selalu ada) -->
                                <div class="mb-3">
                                    <label class="form-label required-field">Start Date</label>
                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date', $resident->units->first()->pivot->start_date ?? '') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Selesai (hanya untuk Leasee) -->
                                <div class="mb-3 end-date-container" id="end-date-container">
                                    <label class="form-label">Start End <span class="text-muted small">(If rent)</span></label>
                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date', $resident->units->first()->pivot->end_date ?? '') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Leave blank if still active.</small>
                                </div>

                                <!-- Field Kepemilikan (hanya untuk Owner) -->
                                <div class="owner-ownership-fields d-none mt-4 p-3 border rounded bg-light" id="owner-date-fields">
                                    <h6 class="text-primary fw-semibold mb-3">Property Ownership Details</h6>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Sale Date</label>
                                            <input type="date" name="date_sold" class="form-control @error('date_sold') is-invalid @enderror"
                                                value="{{ old('date_sold', $resident->units->first()->pivot->date_sold ?? '') }}">
                                            @error('date_sold')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Date of purchase of the property by the owner.</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Handover Date</label>
                                            <input type="date" name="date_handover" class="form-control @error('date_handover') is-invalid @enderror"
                                                value="{{ old('date_handover', $resident->units->first()->pivot->date_handover ?? '') }}">
                                            @error('date_handover')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Date of handover of the unit from the developer/previous owner.</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Penjelasan visual -->
                                <div class="mt-3 text-muted small">
                                    <strong>Notes:</strong> 
                                    <span class="text-success">Owner</span> — fill in ownership details.  
                                    <span class="text-info">Leasee</span> — just need start & end date of rental.
                                </div>
                            </div>
                        </div>

                    
               
                   <!-- Card: Parkir -->
                <div class="card form-section">
                    <div class="card-header">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="12" cy="13" r="3" />
                                <path d="M6 21l6 -5l6 5" />
                                <path d="M5 11a7 7 0 1 1 14 0v5h-2v-5a5 5 0 0 0 -10 0v5h-2v-5z" />
                            </svg>
                            Parkir
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Tampilkan parkir yang sedang aktif -->
                        @if($resident->activeParkingAssignment && $resident->activeParkingAssignment->isNotEmpty())
                            <div class="parking-current mb-4">
                                <h6 class="mb-3">Parkir Terpasang:</h6>
                                @foreach($resident->activeParkingAssignment as $assignment)
                                    <div class="alert alert-info mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $assignment->parkingLot->parkingArea->area_code }} - {{ $assignment->parkingLot->lot_number }}</strong> 
                                                ({{ $assignment->parkingLot->lot_type }})
                                                <br>
                                                <small class="text-muted">
                                                    Terpasang: {{ $assignment->assigned_at->format('d M Y') }}
                                                </small>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#releaseParkingModal"
                                                    data-parking-id="{{ $assignment->id }}"
                                                    data-lot-info="{{ $assignment->parkingLot->lot_number }}">
                                                Lepaskan
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Pilih Parking Baru -->
                        <div class="mb-3">
                            <label class="form-label">Assign Parking Lot (Maks 3)</label>
                            <select name="parking_ids[]" id="parking-select" class="form-select" multiple size="5">
                                <option value="" disabled>-- Pilih hingga 3 slot parkir --</option>
                                @foreach($parkingLots as $parking)
                                    <option value="{{ $parking->id }}"
                                        {{ in_array($parking->id, $resident->activeParkingAssignment->pluck('parking_id')->toArray()) ? 'selected' : '' }}>
                                        {{ $parking->parkingArea->area_code }} - {{ $parking->lot_number }} ({{ $parking->lot_type }})
                                        @if(!$parking->is_available && !in_array($parking->id, $resident->activeParkingAssignment->pluck('parking_id')->toArray()))
                                            (Tidak Tersedia)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Tahan Ctrl/Cmd untuk pilih lebih dari satu. Maksimal 3.</small>
                            <div class="text-danger mt-1 d-none" id="parking-error">Maksimal 3 parking lot yang bisa dipilih.</div>
                        </div>
                        
                        <!-- Preview Pilihan -->
                        <div class="mb-3" id="parking-preview" style="display: none;">
                            <label class="form-label">Parking yang Dipilih</label>
                            <div class="d-flex flex-wrap gap-2" id="parking-chips"></div>
                        </div>
                    </div>
                </div>
                    <!-- Card: Anggota Keluarga -->
                    <div class="card form-section">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="5" r="3" />
                                    <path d="M7 20a5 5 0 0 1 10 0" />
                                    <path d="M3 11a9 9 0 0 1 18 0" />
                                </svg>
                               Family members
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">Add or edit family members living together.</p>
                            <div id="family-members-container">
                                @if($resident->familyMembers && $resident->familyMembers->isNotEmpty())
                                    @foreach($resident->familyMembers as $index => $member)
                                        <div class="family-member-item d-flex gap-2 mb-3 p-3 border rounded bg-light" style="background-color: #f8fdfb;">
                                            <input type="hidden" name="family_members[{{ $index }}][id]" value="{{ $member->id }}">
                                            <div class="flex-grow-1 row g-3">
                                                <div class="col-md-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="family_members[{{ $index }}][name]" class="form-control" value="{{ old('family_members.'.$index.'.name', $member->name) }}" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Connection</label>
                                                    <input type="text" name="family_members[{{ $index }}][relationship]" class="form-control" value="{{ old('family_members.'.$index.'.relationship', $member->relationship) }}" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Date of Birth</label>
                                                    <input type="date" name="family_members[{{ $index }}][date_of_birth]" class="form-control" value="{{ old('family_members.'.$index.'.date_of_birth', $member->date_of_birth) }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Gender</label>
                                                    <select name="family_members[{{ $index }}][gender]" class="form-select">
                                                        <option value="">Select</option>
                                                        <option value="male" {{ old('family_members.'.$index.'.gender', $member->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ old('family_members.'.$index.'.gender', $member->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Identity Number</label>
                                                    <input type="text" name="family_members[{{ $index }}][identity_number]" class="form-control" value="{{ old('family_members.'.$index.'.identity_number', $member->identity_number) }}">
                                                </div>
                                                <div class="col-md-1 d-flex align-items-end">
                                                    <button type="button" class="btn btn-outline-danger w-100" onclick="removeFamilyMember(this)">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Default empty field -->
                                    <div class="family-member-item d-flex gap-2 mb-3 p-3 border rounded bg-light" style="background-color: #f8fdfb;">
                                        <div class="flex-grow-1 row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="family_members[0][name]" class="form-control" placeholder="Nama anggota">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Connection</label>
                                                <input type="text" name="family_members[0][relationship]" class="form-control" placeholder="Anak, Istri">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Date of Birth</label>
                                                <input type="date" name="family_members[0][date_of_birth]" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Gender</label>
                                                <select name="family_members[0][gender]" class="form-select">
                                                    <option value="">Select</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Identity Number</label>
                                                <input type="text" name="family_members[0][identity_number]" class="form-control" placeholder="KTP/Paspor">
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" class="btn btn-outline-danger w-100" onclick="removeFamilyMember(this)">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <button type="button" class="btn btn-sm btn-light border" onclick="addFamilyMember()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                               Add Family Members
                            </button>
                        </div>
                    </div>

                    <!-- Card: Staf Pendamping -->
                        <div class="card form-section">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                    <path d="M9 17h6" />
                                    <path d="M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2" />
                                    <path d="M15 5v4" />
                                    <path d="M9 5v4" />
                                </svg>
                                Supporting Staff
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">Add or edit accompanying staff such as drivers, assistants, or personal security guards.</p>
                            <div id="staff-members-container">
                                @if($resident->staffs && $resident->staffs->isNotEmpty())
                                    @foreach($resident->staffs as $index => $staff)
                                        <div class="staff-member-item d-flex gap-2 mb-3 p-3 border rounded bg-light" style="background-color: #f5f9ff;">
                                            <input type="hidden" name="staff_members[{{ $index }}][id]" value="{{ $staff->id }}">
                                            <div class="flex-grow-1 row g-3">
                                                <div class="col-md-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="staff_members[{{ $index }}][name]" class="form-control" value="{{ old('staff_members.'.$index.'.name', $staff->name) }}" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Select</label>
                                                    <select name="staff_members[{{ $index }}][type]" class="form-select">
                                                        <option value="">Choose a type</option>
                                                        <option value="Driver" {{ old('staff_members.'.$index.'.type', $staff->type) == 'Driver' ? 'selected' : '' }}>Driver</option>
                                                        <option value="Assistant" {{ old('staff_members.'.$index.'.type', $staff->type) == 'Assistant' ? 'selected' : '' }}>Assistant</option>
                                                        <option value="Nanny" {{ old('staff_members.'.$index.'.type', $staff->type) == 'Nanny' ? 'selected' : '' }}>Nanny</option>
                                                        <option value="Security" {{ old('staff_members.'.$index.'.type', $staff->type) == 'Security' ? 'selected' : '' }}>Private Security Guard</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Telepon</label>
                                                    <input type="text" name="staff_members[{{ $index }}][phone]" class="form-control" value="{{ old('staff_members.'.$index.'.phone', $staff->phone) }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Identity Number</label>
                                                    <input type="text" name="staff_members[{{ $index }}][license_plate]" class="form-control" value="{{ old('staff_members.'.$index.'.license_plate', $staff->license_plate) }}" placeholder="B 1234 ABC">
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" class="btn btn-outline-danger w-100" onclick="removeStaffMember(this)">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Default empty field -->
                                    <div class="staff-member-item d-flex gap-2 mb-3 p-3 border rounded bg-light" style="background-color: #f5f9ff;">
                                        <div class="flex-grow-1 row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="staff_members[0][name]" class="form-control" placeholder="Nama staf">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Select</label>
                                                <select name="staff_members[0][type]" class="form-select">
                                                    <option value="">Choose a type</option>
                                                    <option value="Driver">Driver</option>
                                                    <option value="Assistant">Assistant</option>
                                                    <option value="Nanny">Nanny</option>
                                                    <option value="Security">Private Security Guard</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Telepon</label>
                                                <input type="text" name="staff_members[0][phone]" class="form-control" placeholder="+62...">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Identity Number</label>
                                                <input type="text" name="staff_members[0][license_plate]" class="form-control" placeholder="B 1234 ABC">
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button" class="btn btn-outline-danger w-100" onclick="removeStaffMember(this)">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <button type="button" class="btn btn-sm btn-light border" onclick="addStaffMember()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Add Support Staff
                            </button>
                        </div>
                        </div>

                        <!-- Card: Dokumen -->
                                <div class="card form-section">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <line x1="9" y1="9" x2="10" y2="9" />
                                                <line x1="9" y1="13" x2="15" y2="13" />
                                                <line x1="9" y1="17" x2="15" y2="17" />
                                            </svg>
                                            Dokumen
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted mb-3">Upload supporting documents such as KTP, Ebilling, or rental contract.</p>
                                        <!-- Tampilkan dokumen yang sudah ada -->
                                        @if($resident->documents && $resident->documents->isNotEmpty())
                                            <div class="mb-4">
                                                <h6 class="mb-3">Dokumen Terupload:</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Jenis Dokumen</th>
                                                                <th>Nama File</th>
                                                                <th>Ukuran</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($resident->documents as $doc)
                                                                <tr>
                                                                    <td>{{ $doc->document_type }}</td>
                                                                    <td>{{ $doc->file_name }}</td>
                                                                    <td>{{ number_format($doc->file_size / 1024, 2) }} KB</td>
                                                                    <td>
                                                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">Lihat</a>
                                                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteDocumentModal" data-doc-id="{{ $doc->id }}" data-doc-name="{{ $doc->file_name }}">
                                                                            Hapus
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Form Upload Baru -->
                                        <div class="mb-3">
                                            <label class="form-label">Select Dokumen</label>
                                            <select name="document_type" class="form-select">
                                                <option value="">Select the document type</option>
                                                <option value="KTP">Passport/KTP</option>
                                                <option value="Ebilling">Ebilling</option>
                                                <option value="Resident">Resident data</option>
                                                <option value="Utility reading">Utility reading</option>
                                                <option value="Spa">Spa</option>
                                                <option value="Ppjb">Ppjb</option>
                                                <option value="Maid and driver form">Maid and driver form</option>
                                                <option value="Form leasee agreement">Form leasee agreement</option>

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Pilih File</label>
                                            <input type="file" name="document_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                            <small class="text-muted">Format yang diterima: PDF, JPG, JPEG, PNG.</small>
                                        </div>

                                        <button type="submit" name="action" value="upload_document" class="btn btn-sm btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                <path d="M7 9l5 -5l5 5" />
                                                <path d="M12 4l0 12" />
                                            </svg>
                                            Upload Dokumen
                                        </button>
                                    </div>
                                </div>

                        </form>
                    </div>
                    </div>
                    </div>

        <!-- Single Dynamic Modal -->
        <div class="modal fade" id="releaseParkingModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="releaseParkingForm" method="POST">
                        @csrf
                        <input type="hidden" name="parking_id" id="parking_id_input">
                        <div class="modal-body text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle text-warning mb-2" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 9v2" />
                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0" />
                                <path d="M12 16h.01" />
                            </svg>
                            <h4>Leave Parking?</h4>
                            <p class="text-muted" id="parking-info-text">Are you sure you want to remove or delete the slot?</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Yes, Release</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Dokumen -->
            <div class="modal fade" id="deleteDocumentModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <form id="deleteDocumentForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="document_id" id="document_id_input">
                            <div class="modal-body text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle text-warning mb-2" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 9v2" />
                                    <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0" />
                                    <path d="M12 16h.01" />
                                </svg>
                                <h4>Hapus Dokumen?</h4>
                                <p class="text-muted" id="document-name-text">Anda yakin ingin menghapus dokumen ini?</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const modal = document.getElementById('deleteDocumentModal');
                    modal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        const docId = button.getAttribute('data-doc-id');
                        const docName = button.getAttribute('data-doc-name');
                        document.getElementById('document_id_input').value = docId;
                        document.getElementById('document-name-text').textContent = `Hapus dokumen "${docName}"?`;
                        document.getElementById('deleteDocumentForm').action = `{{ route('admin.master.residents.destroyDocument', ':id') }}`.replace(':id', docId);
                    });
                });
            </script>

      
        <style>
            .modal.modal-blur .modal-dialog {
                transform: translate(0, 0);
                will-change: transform;
                backface-visibility: hidden;
            }
        </style>
    <!-- Single Dynamic Modal -->


        {{-- to script status unit --}}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Inisialisasi awal
                    toggleOwnershipFields();

                    // Tangkap perubahan role
                    const roleSelect = document.getElementById('role-select');
                    roleSelect.addEventListener('change', toggleOwnershipFields);

                    // Auto-set min date pada date_handover >= start_date
                    const startDateInput = document.querySelector('[name="start_date"]');
                    const handoverInput = document.querySelector('[name="date_handover"]');

                    if (startDateInput && handoverInput) {
                        startDateInput.addEventListener('change', function () {
                            if (this.value) {
                                handoverInput.min = this.value;
                            }
                        });

                        // Set min saat load
                        if (startDateInput.value) {
                            handoverInput.min = startDateInput.value;
                        }
                    }
                });

                function toggleOwnershipFields() {
                    const role = document.getElementById('role-select').value;
                    const endDateContainer = document.getElementById('end-date-container');
                    const ownerFields = document.getElementById('owner-date-fields');

                    // Reset state
                    if (endDateContainer) {
                        endDateContainer.classList.add('d-none');
                        const endInput = endDateContainer.querySelector('input[name="end_date"]');
                        endInput.value = '';
                        endInput.disabled = true;
                    }

                    if (ownerFields) {
                        ownerFields.classList.add('d-none');
                        ownerFields.querySelectorAll('input[type="date"]').forEach(input => {
                            input.value = '';
                            input.disabled = true;
                        });
                    }

                    // Logika berdasarkan role
                    if (role === 'Owner' || role === 'Co-Owner') {
                        // Sembunyikan end_date
                        if (endDateContainer) endDateContainer.classList.add('d-none');

                        // Tampilkan field kepemilikan
                        if (ownerFields) {
                            ownerFields.classList.remove('d-none');
                            ownerFields.querySelectorAll('input[type="date"]').forEach(input => {
                                input.disabled = false;
                            });
                        }
                    } else if (role === 'Leasee' || role === 'Co-Leasee') {
                        // Sembunyikan field kepemilikan
                        if (ownerFields) ownerFields.classList.add('d-none');

                        // Tampilkan end_date
                        if (endDateContainer) {
                            endDateContainer.classList.remove('d-none');
                            const endInput = endDateContainer.querySelector('input[name="end_date"]');
                            endInput.disabled = false;
                        }
                    }
                }
            </script>

            <style>
                /* Animasi halus untuk show/hide */
                .owner-ownership-fields,
                .end-date-container {
                    transition: all 0.3s ease;
                }

                /* Style label penjelasan */
                .text-muted.small {
                    font-size: 0.85rem;
                    color: #6c757d !important;
                }

                /* Highlight box kepemilikan */
                .owner-ownership-fields {
                    border-left: 4px solid #51A49A;
                    margin-top: 1.5rem;
                    padding-left: 1.25rem;
                }
            </style>
        {{-- to script status unit --}}
        


        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('releaseParkingModal');
                modal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const parkingId = button.getAttribute('data-parking-id');
                    const lotInfo = button.getAttribute('data-lot-info');

                    document.getElementById('parking_id_input').value = parkingId;
                    document.getElementById('parking-info-text').textContent = `Yakin lepas slot ${lotInfo}?`;
                    document.getElementById('releaseParkingForm').action = `{{ route('admin.master.residents.release-parking', $resident->id) }}`;
                });
            });
        </script>
        
        <script>
            function filterUnits() {
                const towerId = document.getElementById('tower-select').value;
                const unitSelect = document.getElementById('unit-select');
                const options = unitSelect.querySelectorAll('option');

                options.forEach(opt => {
                    if (opt.value === '' || !opt.hasAttribute('data-tower-id')) {
                        opt.style.display = '';
                    } else {
                        opt.style.display = opt.getAttribute('data-tower-id') == towerId ? '' : 'none';
                    }
                });

                if (towerId !== '{{ $currentUnit ? $currentUnit->tower->id : '' }}') {
                    unitSelect.value = '';
                }
            }

            document.getElementById('profile_image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const placeholder = document.getElementById('image-placeholder');
                        placeholder.innerHTML = `<img src="${e.target.result}" class="profile-image-preview">`;
                    };
                    reader.readAsDataURL(file);
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                filterUnits();
            });
        </script>

        <script>
                let familyIndex = {{ $resident->familyMembers ? $resident->familyMembers->count() : 1 }};
                let staffIndex = {{ $resident->staffs ? $resident->staffs->count() : 1 }};

                function addFamilyMember() {
                    const container = document.getElementById('family-members-container');
                    const div = document.createElement('div');
                    div.className = 'family-member-item d-flex gap-2 mb-3 p-3 border rounded bg-light';
                    div.style.backgroundColor = '#f8fdfb';
                    div.innerHTML = `
                        <div class="flex-grow-1 row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="family_members[${familyIndex}][name]" class="form-control" placeholder="Nama anggota" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Hubungan</label>
                                <input type="text" name="family_members[${familyIndex}][relationship]" class="form-control" placeholder="Anak, Istri" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Tgl Lahir</label>
                                <input type="date" name="family_members[${familyIndex}][date_of_birth]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="family_members[${familyIndex}][gender]" class="form-select">
                                    <option value="">Pilih</option>
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Nomor Identitas</label>
                                <input type="text" name="family_members[${familyIndex}][identity_number]" class="form-control" placeholder="KTP/Paspor">
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-danger w-100" onclick="removeFamilyMember(this)">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    `;
                    container.appendChild(div);
                    familyIndex++;
                }

                function removeFamilyMember(button) {
                    const item = button.closest('.family-member-item');
                    const idInput = item.querySelector('input[name$="[id]"]');
                    if (idInput && idInput.value) {
                        // Jika punya ID, tandai untuk dihapus
                        const deleteInput = document.createElement('input');
                        deleteInput.type = 'hidden';
                        deleteInput.name = 'family_members_delete[]';
                        deleteInput.value = idInput.value;
                        item.appendChild(deleteInput);
                    }
                    item.remove();
                }

                function addStaffMember() {
                    const container = document.getElementById('staff-members-container');
                    const div = document.createElement('div');
                    div.className = 'staff-member-item d-flex gap-2 mb-3 p-3 border rounded bg-light';
                    div.style.backgroundColor = '#f5f9ff';
                    div.innerHTML = `
                        <div class="flex-grow-1 row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="staff_members[${staffIndex}][name]" class="form-control" placeholder="Nama staf" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Jenis</label>
                                <select name="staff_members[${staffIndex}][type]" class="form-select">
                                    <option value="">Pilih jenis</option>
                                    <option value="Driver">Sopir</option>
                                    <option value="Assistant">Asisten</option>
                                    <option value="Nanny">Pengasuh</option>
                                    <option value="Security">Satpam Pribadi</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Telepon</label>
                                <input type="text" name="staff_members[${staffIndex}][phone]" class="form-control" placeholder="+62...">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Plat Nomor</label>
                                <input type="text" name="staff_members[${staffIndex}][license_plate]" class="form-control" placeholder="B 1234 ABC">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-danger w-100" onclick="removeStaffMember(this)">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    `;
                    container.appendChild(div);
                    staffIndex++;
                }

                function removeStaffMember(button) {
                    const item = button.closest('.staff-member-item');
                    const idInput = item.querySelector('input[name$="[id]"]');
                    if (idInput && idInput.value) {
                        const deleteInput = document.createElement('input');
                        deleteInput.type = 'hidden';
                        deleteInput.name = 'staff_members_delete[]';
                        deleteInput.value = idInput.value;
                        item.appendChild(deleteInput);
                    }
                    item.remove();
            }
        </script>

        <script>
                    document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('editResidentForm');
                const select = document.getElementById('parking-select');
                
                // Inisialisasi preview saat halaman dimuat
                updateParkingPreview();
                
                // Pastikan form mengirim data parking yang benar
                form.addEventListener('submit', function (e) {
                    const selectedOptions = Array.from(select.selectedOptions);
                    const selectedValues = selectedOptions.map(opt => opt.value);
                    
                    // Hapus semua input hidden parking lama
                    document.querySelectorAll('input[name="parking_ids[]"]').forEach(el => el.remove());
                    
                    // Tambahkan input hidden untuk setiap parking yang dipilih
                    selectedValues.forEach(value => {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'parking_ids[]';
                        hiddenInput.value = value;
                        form.appendChild(hiddenInput);
                    });
                    
                    // Nonaktifkan select multiple agar tidak ikut dikirim
                    select.disabled = true;
                });
            });

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
                        // Batasi hanya 3 pilihan
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
                            chip.className = 'badge bg-primary-lt px-3 py-2 d-flex align-items-center me-2 mb-2';
                            chip.innerHTML = `
                                ${option.textContent}
                                <button type="button" class="btn-close btn-close-white ms-2" style="font-size: 0.6rem;" 
                                        onclick="removeParkingOption('${option.value}')"></button>
                            `;
                            chipsContainer.appendChild(chip);
                        });
                    } else {
                        previewContainer.style.display = 'none';
                    }
                }

                function removeParkingOption(value) {
                    const option = document.querySelector(`#parking-select option[value="${value}"]`);
                    if (option) {
                        option.selected = false;
                        updateParkingPreview();
                    }
                }

                // Pastikan select multiple memicu update preview
                document.getElementById('parking-select').addEventListener('change', updateParkingPreview);
        </script>