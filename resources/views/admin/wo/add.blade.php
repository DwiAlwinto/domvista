<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-3 align-items-center">
                <div class="col">
                <h2 class="page-title" style="color: #3fbeb8;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus me-2" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M9 11h6" />
                        <path d="M12 8v6" />
                    </svg>
                    ADD NEW WORK ORDER
                </h2>
                    <div class="text-muted mt-1">
                        <small>Fill out the form below to create a new Work Order.</small>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <a href="{{ route('admin.wo.index') }}" class="btn" style="background-color: #51A49A; color: white; border: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <form action="{{ route('admin.wo.store') }}" method="POST" class="card shadow-sm border-0">
                        @csrf
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <h4 class="card-title text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle me-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 9h.01" />
                                    <path d="M11 12h1v4h1" />
                                </svg>
                               Work Order Information
                            </h4>
                        </div>

                        <div class="card-body">
                            <div class="row g-4">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <!-- WO Number -->
                                    <div class="mb-3">
                                        <label class="form-label required">Number Work Order / Work Request</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                                                    <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                                                    <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M5 11h1v2h-1z" />
                                                    <path d="M10 11v2" />
                                                    <path d="M14 11h2v2h-2z" />
                                                    <path d="M19 11v2" />
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control @error('wo_no') is-invalid @enderror" 
                                                   name="wo_no" value="{{ old('wo_no') }}" 
                                                   placeholder=" Example WR-3468467 / WO-0800">
                                        </div>
                                        @error('wo_no')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="form-hint">Work Order Number is created manually</small>
                                    </div>

                                    <!-- Tower Selection -->
                                    <div class="mb-3">
                                        <label class="form-label required">Tower</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M3 21l18 0" />
                                                    <path d="M5 21v-14l8 -4v14" />
                                                    <path d="M19 21v-10l-6 -4" />
                                                    <path d="M9 9l0 .01" />
                                                    <path d="M9 12l0 .01" />
                                                    <path d="M9 15l0 .01" />
                                                    <path d="M9 18l0 .01" />
                                                </svg>
                                            </span>
                                            <select name="tower_id" class="form-select @error('tower_id') is-invalid @enderror" id="towerSelect" required>
                                                <option value="">Select Towers</option>
                                                @foreach($towers as $tower)
                                                    <option value="{{ $tower->id }}" {{ old('tower_id') == $tower->id ? 'selected' : '' }}>
                                                        {{ $tower->name }} - {{ $tower->location }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('tower_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Unit Selection -->
                                    <div class="mb-3">
                                        <label class="form-label required">Unit</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M14 6v12h-4v-12" />
                                                    <path d="M6 18h14" />
                                                    <path d="M6 6v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12" />
                                                    <path d="M11 13a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                                </svg>
                                            </span>
                                            <select name="unit_id" class="form-select @error('unit_id') is-invalid @enderror" id="unitSelect" required>
                                                <option value="">Select Unit</option>
                                                @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                                        {{ $unit->unit_code }} - {{ $unit->unitType->code }} (Lantai {{ $unit->floor->floor_number }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('unit_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tenant Name -->
                                    <div class="mb-3">
                                        <label class="form-label required">Name Tenant</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control @error('tenant_name') is-invalid @enderror" 
                                                   name="tenant_name" value="{{ old('tenant_name') }}" 
                                                   placeholder="Enter the name of the tenant" required>
                                        </div>
                                        @error('tenant_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <!-- Date Request WO -->
                                    <div class="mb-3">
                                        <label class="form-label required">Date Request</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M8 15h2v2h-2z" />
                                                </svg>
                                            </span>
                                            <input type="date" class="form-control @error('date_request_wo') is-invalid @enderror" 
                                                   name="date_request_wo" value="{{ old('date_request_wo', date('Y-m-d')) }}" required>
                                        </div>
                                        @error('date_request_wo')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Schedule Date -->
                                    <div class="mb-3">
                                        <label class="form-label required">Schedule Time</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-time" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M11.8 20.82l-5.8 -5.82" />
                                                    <path d="M16 21l4 -4" />
                                                    <path d="M4 11v-5a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-8" />
                                                    <path d="M4 16h10" />
                                                    <path d="M10 4v4h4" />
                                                </svg>
                                            </span>
                                            <input type="date" class="form-control @error('schedule_date') is-invalid @enderror" 
                                                   name="schedule_date" value="{{ old('schedule_date') }}" 
                                                   min="{{ date('Y-m-d') }}" required>
                                        </div>
                                        @error('schedule_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Time Schedule -->
                                    <div class="mb-3">
                                        <label class="form-label">Schedule Time</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M12 12l4 4" />
                                                </svg>
                                            </span>
                                            <input type="time" class="form-control @error('time_schedule') is-invalid @enderror" 
                                                   name="time_schedule" value="{{ old('time_schedule') }}">
                                        </div>
                                        @error('time_schedule')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="form-hint">Optional - leave blank if no specific time is required.</small>
                                    </div>

                                    <!-- Present Status -->
                                    <div class="mb-3">
                                        <label class="form-label">Attendance Status</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </span>
                                            <select name="present" class="form-select @error('present') is-invalid @enderror">
                                                <option value="0" {{ old('present', 0) == 0 ? 'selected' : '' }}>Not present</option>
                                                <option value="1" {{ old('present') == 1 ? 'selected' : '' }}>Present</option>
                                            </select>
                                        </div>
                                        @error('present')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi Pekerjaan -->
                            <div class="mb-3">
                                <label class="form-label required">Job description</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path d="M9 3h6v4h-6z" />
                                            <path d="M9 12l2 0" />
                                            <path d="M9 16l4 0" />
                                        </svg>
                                    </span>
                                    <textarea class="form-control @error('work_description') is-invalid @enderror" 
                                              name="work_description" rows="3" 
                                              placeholder="Describe the details of the work that needs to be done..." required>{{ old('work_description') }}</textarea>
                                </div>
                                @error('work_description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Detail Tambahan -->
                            <div class="mb-3">
                                <label class="form-label">Additional Details</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 7h6" />
                                            <path d="M9 11h6" />
                                            <path d="M9 15h4" />
                                        </svg>
                                    </span>
                                    <textarea class="form-control @error('details') is-invalid @enderror" 
                                              name="details" rows="2" 
                                              placeholder="Additional information or special notes...">{{ old('details') }}</textarea>
                                </div>
                                @error('details')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Awal -->
                            <div class="mb-3">
                                <label class="form-label required">Initial Status</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 16.5a4.5 4.5 0 0 1 -4.5 -4.5h4.5" />
                                            <path d="M10 12a2 2 0 1 0 4 0" />
                                            <path d="M16.5 10a4.5 4.5 0 0 1 -4.5 4.5v-4.5" />
                                            <path d="M12 6a6 6 0 0 0 -6 6" />
                                        </svg>
                                    </span>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="On Progress" {{ old('status', 'On Progress') == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-hint text-muted">The status "Done", "Reschedule" and "Cancel" can only be selected after the WO is created.</small>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-light text-end">
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 4v-4h4" />
                                </svg>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                                Save Work Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .page-title {
        font-weight: 600;
        color: #2f3e4e;
    }
    .required:after {
        content: " *";
        color: #e03131;
    }
    .form-label {
        font-weight: 500;
        color: #2f3e4e;
    }
    .form-control, .form-select {
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #51A49A;
        box-shadow: 0 0 0 3px rgba(81, 164, 154, 0.15);
    }
    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-right: none;
        color: #51A49A;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .form-hint {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    .btn-primary {
        background-color: #51A49A;
        border-color: #51A49A;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background-color: #438a80;
        border-color: #438a80;
        transform: translateY(-1px);
    }
    .btn-outline-secondary:hover {
        background-color: #f1f3f5;
    }
    .invalid-feedback {
        font-size: 0.85rem;
    }
</style>


@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const woNoInput = document.querySelector('input[name="wo_no"]');
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        if (!woNoInput.value) {
            woNoInput.value = `WO-${year}${month}${day}-${hours}${minutes}`;
        }

        const scheduleDateInput = document.querySelector('input[name="schedule_date"]');
        scheduleDateInput.min = new Date().toISOString().split('T')[0];

        const towerSelect = document.getElementById('towerSelect');
        const unitSelect = document.getElementById('unitSelect');

        towerSelect.addEventListener('change', function () {
            const towerId = this.value;
            unitSelect.innerHTML = '<option value="">Pilih Unit</option>';
            unitSelect.disabled = true;

            if (towerId) {
                fetch(`/api/towers/${towerId}/units`)
                    .then(res => res.json())
                    .then(units => {
                        units.forEach(unit => {
                            const option = document.createElement('option');
                            option.value = unit.id;
                            option.textContent = `${unit.unit_code} - ${unit.unit_type.code} (Lantai ${unit.floor.floor_number})`;
                            unitSelect.appendChild(option);
                        });
                        unitSelect.disabled = false;
                    })
                    .catch(err => {
                        console.error('Gagal memuat unit:', err);
                        unitSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                        unitSelect.disabled = false;
                    });
            } else {
                unitSelect.disabled = false;
            }
        });
    });
</script>
@endsection