<div class="page-wrapper">
    <!-- Page header with gradient background -->
    <div class="page-header d-print-none w-100" style="background: linear-gradient(180deg, #51A49A 0%, #2496cb 100%); box-shadow: 0 4px 24px rgba(81,164,154,0.15); border-radius: 0 0 24px 24px; min-width: 100vw; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; position: relative;">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md">
                    <div class="d-flex align-items-center">
                        <div class="me-2 me-md-3">
                            <span class="avatar avatar-lg bg-white text-green" style="box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                    <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                    <path d="M3 6l0 13"></path>
                                    <path d="M12 6l0 13"></path>
                                    <path d="M21 6l0 13"></path>
                                </svg>
                            </span>
                        </div>
                        <div>
                            <h2 class="page-title text-white mb-0">
                                {{ isset($logbook) ? 'Edit Logbook' : 'Add New Logbook Entry' }}
                            </h2>
                            <div class="text-white text-opacity-75">
                                <i class="ti ti-calendar me-1"></i>
                                {{ date('l, F j, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Page title actions -->
               
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card card-borderless shadow-sm">
                <div class="card-header d-flex align-items-center" style="background: linear-gradient(90deg, #51A49A 0%, #2496cb 100%); box-shadow: 0 2px 8px rgba(81,164,154,0.10); border-radius: 12px 12px 0 0;">
                    <h3 class="card-title text-white mb-0">
                        <i class="ti ti-{{ isset($logbook) ? 'edit' : 'plus' }} me-2"></i>
                        {{ isset($logbook) ? 'Edit Digital Logbook' : 'Create New Logbook' }}
                    </h3>
                   
                </div>

                <!-- Unfinished entries alert -->
                @if($unfinishedEntries->count() > 0)
                <div class="alert alert-danger mx-3 mt-3 d-flex align-items-center">
                    <span class="me-2">
                        <i class="ti ti-alert-circle fs-3"></i>
                    </span>
                    <div>
                        <h5 class="alert-title mb-1">Pending Entries</h5>
                        <div class="text-muted">
                            You have <strong>{{ $unfinishedEntries->count() }} unfinished entries</strong> from previous days that will be automatically carried over.
                        </div>
                    </div>
                </div>
                @endif

                <div class="card-body">
                    <form action="{{ isset($logbook) ? route('admin.logbook.update', $logbook->id) : route('admin.logbook.store') }}" method="POST">
                        @csrf
                        @isset($logbook)
                            @method('PUT')
                        @endisset

                       <!-- Basic Information Section -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="card h-100 border-top-3 border-top-green">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">
                                            <i class="ti ti-info-circle text-green me-2"></i>
                                            Basic Information
                                        </h4>
                                        
                                        <div class="mb-3">
                                            <label class="form-label required">Logbook Date</label>
                                            <div class="input-icon">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-calendar"></i>
                                                </span>
                                                @php
                                                    // Set timezone ke Asia/Jakarta
                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $currentDate = date('Y-m-d');
                                                @endphp
                                                <input type="date" readonly class="form-control @error('logbook_date') is-invalid @enderror" 
                                                    name="logbook_date" value="{{ old('logbook_date', $logbook->logbook_date ?? $currentDate) }}" required>
                                            </div>
                                            @error('logbook_date')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-0">
                                            <label class="form-label required">Logbook Number</label>
                                            <div class="input-icon">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-hash"></i>
                                                </span>
                                                @php
                                                    // Format nomor logbook dengan waktu Jakarta
                                                    $logbookNumber = 'LB-' . date('d-m-Y');
                                                    if (isset($logbook->logbook_number)) {
                                                        $logbookNumber = $logbook->logbook_number;
                                                    } elseif (old('logbook_number')) {
                                                        $logbookNumber = old('logbook_number');
                                                    }
                                                @endphp
                                                <input type="text" readonly class="form-control @error('logbook_number') is-invalid @enderror" 
                                                    name="logbook_number" 
                                                    value="{{ $logbookNumber }}" required>
                                            </div>
                                            <small class="text-muted d-block mt-1">Auto-generated based on current date (Jakarta timezone)</small>
                                            @error('logbook_number')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card h-100 border-top-3 border-top-blue">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">
                                            <i class="ti ti-user text-blue me-2"></i>
                                            HOD Information
                                        </h4>
                                        
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <label class="form-label required">MOD</label>
                                                <input type="text" class="form-control @error('mod') is-invalid @enderror" 
                                                    name="mod" value="{{ old('mod', $logbook->staff->mod ?? '') }}" required>
                                                @error('mod')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-12">
                                                <label class="form-label required">Chief Tenant Relation</label>
                                                <input type="text" class="form-control @error('chief_tr') is-invalid @enderror" 
                                                    name="chief_tr" value="{{ old('chief_tr', $logbook->staff->chief_tr ?? '') }}" required>
                                                @error('chief_tr')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                             <div class="col-12">
                                                <label class="form-label required">Chief Engineering</label>
                                                <input type="text" class="form-control @error('chief_enginer') is-invalid @enderror" 
                                                    name="chief_enginer" value="{{ old('chief_enginer', $logbook->staff->chief_enginer ?? '') }}" required>
                                                @error('chief_enginer')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label required">Chief Security</label>
                                                <input type="text" class="form-control @error('chief_security') is-invalid @enderror" 
                                                    name="chief_security" value="{{ old('chief_security', $logbook->staff->chief_security ?? '') }}" required>
                                                @error('chief_security')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label required">Chief Housekeeping</label>
                                                <input type="text" class="form-control @error('chief_hk') is-invalid @enderror" 
                                                    name="chief_hk" value="{{ old('chief_hk', $logbook->staff->chief_hk ?? '') }}" required>
                                                @error('chief_hk')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                           

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Staff Details Section -->
                        <div class="card mb-4 border-top-3 border-top-purple shadow-sm">
                            <div class="card-header bg-purple-lt d-flex align-items-center" style="background: linear-gradient(90deg, #a18fff 0%, #e5dbff 100%); border-radius: 12px 12px 0 0;">
                                <h3 class="card-title text-purple mb-0">
                                    <i class="ti ti-users me-2"></i>
                                    Staff Details
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Tenant Relations -->
                                    <div class="col-md-4">
                                        <label class="form-label required">Tenant Relations (Morning)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-purple-lt">
                                                <i class="ti ti-sun text-purple"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('c_morning') is-invalid @enderror" 
                                                name="c_morning" value="{{ old('c_morning', $logbook->staff->c_morning ?? '') }}" required>
                                        </div>
                                        @error('c_morning')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Tenant Relations (Afternoon)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-orange-lt">
                                                <i class="ti ti-sunset text-orange"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('c_afternoon') is-invalid @enderror" 
                                                name="c_afternoon" value="{{ old('c_afternoon', $logbook->staff->c_afternoon ?? '') }}" required>
                                        </div>
                                        @error('c_afternoon')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Tenant Relations (Night)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark-lt">
                                                <i class="ti ti-moon text-dark"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('c_evening') is-invalid @enderror" 
                                                name="c_evening" value="{{ old('c_evening', $logbook->staff->c_evening ?? '') }}" required>
                                        </div>
                                        @error('c_evening')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Health Club -->
                                    <div class="col-md-6">
                                        <label class="form-label required">Health Club (Morning)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-red-lt">
                                                <i class="ti ti-heartbeat text-red"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('hc_morning') is-invalid @enderror" 
                                                name="hc_morning" value="{{ old('hc_morning', $logbook->staff->hc_morning ?? '') }}" required>
                                        </div>
                                        @error('hc_morning')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Health Club (Afternoon)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-red-lt">
                                                <i class="ti ti-heartbeat text-red"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('hc_afternoon') is-invalid @enderror" 
                                                name="hc_afternoon" value="{{ old('hc_afternoon', $logbook->staff->hc_afternoon ?? '') }}" required>
                                        </div>
                                        @error('hc_afternoon')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   
                                    <!-- Security -->
                                    <div class="col-md-4">
                                        <label class="form-label required">Security (Morning)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-blue-lt">
                                                <i class="ti ti-shield text-blue"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('sec_morning') is-invalid @enderror" 
                                                name="sec_morning" value="{{ old('sec_morning', $logbook->staff->sec_morning ?? '') }}" required>
                                        </div>
                                        @error('sec_morning')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Security (Afternoon)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-blue-lt">
                                                <i class="ti ti-shield text-blue"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('sec_afternoon') is-invalid @enderror" 
                                                name="sec_afternoon" value="{{ old('sec_afternoon', $logbook->staff->sec_afternoon ?? '') }}" required>
                                        </div>
                                        @error('sec_afternoon')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Security (Night)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-blue-lt">
                                                <i class="ti ti-shield text-blue"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('sec_night') is-invalid @enderror" 
                                                name="sec_night" value="{{ old('sec_night', $logbook->staff->sec_night ?? '') }}" required>
                                        </div>
                                        @error('sec_night')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Housekeeping -->
                                    <div class="col-md-4">
                                        <label class="form-label required">Housekeeping (Morning)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-pink-lt">
                                                <i class="ti ti-broom text-pink"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('hk_morning') is-invalid @enderror" 
                                                name="hk_morning" value="{{ old('hk_morning', $logbook->staff->hk_morning ?? '') }}" required>
                                        </div>
                                        @error('hk_morning')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Housekeeping (Afternoon)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-pink-lt">
                                                <i class="ti ti-broom text-pink"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('hk_afternoon') is-invalid @enderror" 
                                                name="hk_afternoon" value="{{ old('hk_afternoon', $logbook->staff->hk_afternoon ?? '') }}" required>
                                        </div>
                                        @error('hk_afternoon')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Housekeeping (Night)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-pink-lt">
                                                <i class="ti ti-broom text-pink"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('hk_night') is-invalid @enderror" 
                                                name="hk_night" value="{{ old('hk_night', $logbook->staff->hk_night ?? '') }}" required>
                                        </div>
                                        @error('hk_night')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Engineering -->
                                    <div class="col-md-4">
                                        <label class="form-label required">Engineering (Morning)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-cyan-lt">
                                                <i class="ti ti-settings text-cyan"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('enginer_morning') is-invalid @enderror" 
                                                name="enginer_morning" value="{{ old('enginer_morning', $logbook->staff->enginer_morning ?? '') }}" required>
                                        </div>
                                        @error('enginer_morning')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Engineering (Afternoon)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-cyan-lt">
                                                <i class="ti ti-settings text-cyan"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('enginer_afternoon') is-invalid @enderror" 
                                                name="enginer_afternoon" value="{{ old('enginer_afternoon', $logbook->staff->enginer_afternoon ?? '') }}" required>
                                        </div>
                                        @error('enginer_afternoon')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Engineering (Night)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-cyan-lt">
                                                <i class="ti ti-settings text-cyan"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('enginer_night') is-invalid @enderror" 
                                                name="enginer_night" value="{{ old('enginer_night', $logbook->staff->enginer_night ?? '') }}" required>
                                        </div>
                                        @error('enginer_night')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- HSE -->
                                    <div class="col-md-4">
                                        <label class="form-label required">HSE (Morning)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-green-lt">
                                                <i class="ti ti-medical-cross text-green"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('hse_morning') is-invalid @enderror" 
                                                name="hse_morning" value="{{ old('hse_morning', $logbook->staff->hse_morning ?? '') }}" required>
                                        </div>
                                        @error('hse_morning')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">HSE (Afternoon)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-green-lt">
                                                <i class="ti ti-medical-cross text-green"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('hse_afternoon') is-invalid @enderror" 
                                                name="hse_afternoon" value="{{ old('hse_afternoon', $logbook->staff->hse_afternoon ?? '') }}" required>
                                        </div>
                                        @error('hse_afternoon')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">HSE (Night)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-green-lt">
                                                <i class="ti ti-medical-cross text-green"></i>
                                            </span>
                                            <input type="text" class="form-control rounded-end @error('hse_night') is-invalid @enderror" 
                                                name="hse_night" value="{{ old('hse_night', $logbook->staff->hse_night ?? '') }}" required>
                                        </div>
                                        @error('hse_night')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Staff Details Section -->

                        <!-- Logbook Entries Section -->
                        <div class="card mb-4 border-red">
                            <div class="card-header bg-red-lt">
                                <h3 class="card-title">Logbook Entries</h3>
                                <button type="button" class="btn btn-sm btn-green ms-auto" id="addEntry">
                                    <i class="ti ti-plus me-1"></i>
                                    Add Entry
                                </button>
                            </div>
                            <div class="card-body" id="entriesContainer">
                                @if(isset($logbook) && $logbook->entries->count() > 0)
                                    @foreach($logbook->entries as $index => $entry)
                                        <div class="entry-item mb-3 border-bottom pb-3">
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label required">Tower</label>
                                                        <input type="text" class="form-control @error('entries.'.$index.'.tower') is-invalid @enderror" 
                                                               name="entries[{{ $index }}][tower]" 
                                                               value="{{ old('entries.'.$index.'.tower', $entry->tower) }}" required>
                                                        @error('entries.'.$index.'.tower')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label required">Unit</label>
                                                        <input type="text" class="form-control @error('entries.'.$index.'.unit') is-invalid @enderror" 
                                                               name="entries[{{ $index }}][unit]" 
                                                               value="{{ old('entries.'.$index.'.unit', $entry->unit) }}" required>
                                                        @error('entries.'.$index.'.unit')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label required">Status</label>
                                                        <select class="form-select @error('entries.'.$index.'.status') is-invalid @enderror" 
                                                                name="entries[{{ $index }}][status]" required>
                                                            @foreach(['On Progress', 'Set Schedule', 'Reschedule', 'Done', 'Cancel'] as $status)
                                                                <option value="{{ $status }}" {{ old('entries.'.$index.'.status', $entry->status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('entries.'.$index.'.status')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 col-md-3">
                                                    <button type="button" class="btn btn-sm btn-red mt-4 float-end remove-entry">
                                                        <i class="ti ti-trash me-1"></i>
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label required">Description</label>
                                                        <textarea class="form-control @error('entries.'.$index.'.description') is-invalid @enderror" 
                                                                  rows="2" name="entries[{{ $index }}][description]" required>{{ old('entries.'.$index.'.description', $entry->description) }}</textarea>
                                                        @error('entries.'.$index.'.description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Di bagian entries, tambahkan field result -->
                                                <div class="row mt-2">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label required">Description</label>
                                                            <textarea class="form-control @error('entries.'.$index.'.description') is-invalid @enderror" 
                                                                    rows="2" name="entries[{{ $index }}][description]" required>{{ old('entries.'.$index.'.description', $entry->description ?? '') }}</textarea>
                                                            @error('entries.'.$index.'.description')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="form-group">
                                                            <label class="form-label {{ $entry->status == 'Done' ? 'required' : '' }}">Result</label>
                                                            <textarea class="form-control @error('entries.'.$index.'.result') is-invalid @enderror" 
                                                                    rows="2" name="entries[{{ $index }}][result]">{{ old('entries.'.$index.'.result', $entry->result ?? '') }}</textarea>
                                                            @error('entries.'.$index.'.result')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Default empty entry -->
                                    <div class="entry-item mb-3 border-bottom pb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label required">Tower</label>
                                                    <input type="text" class="form-control @error('entries.0.tower') is-invalid @enderror" 
                                                           name="entries[0][tower]" value="{{ old('entries.0.tower') }}" required>
                                                    @error('entries.0.tower')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label required">Unit</label>
                                                    <input type="text" class="form-control @error('entries.0.unit') is-invalid @enderror" 
                                                           name="entries[0][unit]" value="{{ old('entries.0.unit') }}" required>
                                                    @error('entries.0.unit')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label required">Status</label>
                                                    <select class="form-select  @error('entries.0.status') is-invalid @enderror" 
                                                            name="entries[0][status]" required>
                                                        @foreach(['On Progress'] as $status)
                                                            <option value="{{ $status }}" {{ old('entries.0.status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('entries.0.status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label required">Description</label>
                                                    <textarea class="form-control @error('entries.0.description') is-invalid @enderror" 
                                                              rows="2" name="entries[0][description]" required>{{ old('entries.0.description') }}</textarea>
                                                    @error('entries.0.description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                                <button type="reset" class="btn btn-outline-danger order-1 order-md-0 riset">
                                    <i class="ti ti-x me-1 text-danger"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-success order-0 order-md-1">
                                    <i class="ti ti-device-floppy me-1"></i> {{ isset($logbook) ? 'Update Data' : 'Save Data' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reset button confirmation
        document.querySelector('.riset').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Reset Form?',
                text: "All entered data will be lost",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('form').reset();
                }
            });
        });
        
        // Add new entry
        document.getElementById('addEntry').addEventListener('click', function() {
            const container = document.getElementById('entriesContainer');
            const entryCount = container.querySelectorAll('.entry-item').length;
            const template = container.querySelector('.entry-item').cloneNode(true);
            
            // Update the index in the name attributes
            const inputs = template.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const name = input.getAttribute('name').replace(/\[\d+\]/g, `[${entryCount}]`);
                input.setAttribute('name', name);
                input.value = '';
                input.classList.remove('is-invalid');
            });
            
            // Remove any existing error messages
            template.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            
            // Add remove functionality
            const removeBtn = template.querySelector('.remove-entry') || template.querySelector('.btn-red');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (container.querySelectorAll('.entry-item').length > 1) {
                        template.remove();
                    } else {
                        Swal.fire('Warning', 'You need at least one entry!', 'warning');
                    }
                });
            } else {
                // Create remove button if it doesn't exist
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-sm btn-red mt-4 float-end remove-entry';
                removeBtn.innerHTML = '<i class="ti ti-trash me-1"></i> Remove';
                removeBtn.addEventListener('click', function() {
                    if (container.querySelectorAll('.entry-item').length > 1) {
                        template.remove();
                    } else {
                        Swal.fire('Warning', 'You need at least one entry!', 'warning');
                    }
                });
                
                const col = document.createElement('div');
                col.className = 'col-12 col-md-3';
                col.appendChild(removeBtn);
                
                const row = template.querySelector('.row:first-child');
                row.appendChild(col);
            }
            
            container.appendChild(template);
        });

         // Handle status change to show/hide result field
    document.addEventListener('change', function(e) {
        if (e.target && e.target.name && e.target.name.includes('[status]')) {
            const entryItem = e.target.closest('.entry-item');
            const resultField = entryItem.querySelector('textarea[name*="[result]"]');
            const resultLabel = entryItem.querySelector('label[for*="[result]"]');
            
            if (e.target.value === 'Done') {
                resultField.setAttribute('required', 'required');
                resultLabel.classList.add('required');
            } else {
                resultField.removeAttribute('required');
                resultLabel.classList.remove('required');
            }
        }
    });
        
        // Initial remove functionality for existing entries
        document.querySelectorAll('.remove-entry').forEach(btn => {
            btn.addEventListener('click', function() {
                if (document.querySelectorAll('.entry-item').length > 1) {
                    this.closest('.entry-item').remove();
                } else {
                    Swal.fire('Warning', 'You need at least one entry!', 'warning');
                }
            });
        });
    });
</script>
@endpush