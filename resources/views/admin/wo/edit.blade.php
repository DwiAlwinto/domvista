
    


    <div class="page-wrapper">
        <!-- Page header -->
       <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-4 align-items-center">
                    <!-- Bagian Judul -->
                    <div class="col">
                        <h2 class="page-title fw-bold" style="color: #3fbeb8;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler  icon-tabler-edit me-2" width="28" height="28" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.415v3h3l8.415 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>
                            EDIT WORK ORDER
                        </h2>
                        <div class="text-muted mt-1 fs-5 fw-light">
                            Update and manage work order details efficiently
                        </div>
                    </div>

                    <!-- Tombol Back -->
                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('admin.wo.index') }}" class="btn bg-gradient-primary-success px-4 rounded-pill hover-lift shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left me-1" width="18" height="18" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l14 0" />
                                <path d="M5 12l6 6" />
                                <path d="M5 12l6 -6" />
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
      </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <form action="{{ route('admin.wo.update', $workOrder->id) }}" method="POST" class="card shadow-sm" id="workOrderForm">
                            @csrf
                            @method('PUT')
                            
                            <div class="card-header ">
                                <h4 class="card-title">
                                    <i class="bi bi-info-circle info-icon"></i>
                                    Work Order Information
                                </h4>
                                <div class="status-badge ms-4 status-{{ strtolower(str_replace(' ', '-', $workOrder->status)) }}">
                                    {{ $workOrder->status }}
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label class="form-label required">Work Order Number</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-upc-scan"></i>
                                                        </span>
                                                        <input type="text" class="form-control" 
                                                               name="wo_no" value="{{ old('wo_no', $workOrder->wo_no) }}" 
                                                               placeholder="Example: WR-3468467 / WO-0800" required>
                                                    </div>
                                                    <small class="form-hint">WO number can be edited if not yet processed.</small>
                                                    @error('wo_no')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label class="form-label required">Tower</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-building"></i>
                                                        </span>
                                                        <select name="tower_id" class="form-select" id="towerSelect" required>
                                                            <option value="">Select Tower</option>
                                                            @foreach($towers as $tower)
                                                                <option value="{{ $tower->id }}" {{ old('tower_id', $workOrder->tower_id) == $tower->id ? 'selected' : '' }}>
                                                                    {{ $tower->name }} - {{ $tower->location }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('tower_id')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label class="form-label required">Unit</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-door-closed"></i>
                                                        </span>
                                                        <select name="unit_id" class="form-select" id="unitSelect" required>
                                                            <option value="">Select Unit</option>
                                                            @foreach($units as $unit)
                                                                <option value="{{ $unit->id }}" {{ old('unit_id', $workOrder->unit_id) == $unit->id ? 'selected' : '' }}>
                                                                    {{ $unit->unit_code }} - {{ $unit->unitType->code }} (Floor {{ $unit->floor->floor_number }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('unit_id')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label class="form-label required">Tenant Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-person"></i>
                                                        </span>
                                                        <input type="text" class="form-control" 
                                                               name="tenant_name" value="{{ old('tenant_name', $workOrder->tenant_name) }}" 
                                                               placeholder="Enter the name of the tenant" required>
                                                    </div>
                                                    @error('tenant_name')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label class="form-label required">Request Date</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-calendar-event"></i>
                                                        </span>
                                                        <input type="date" class="form-control" 
                                                               name="date_request_wo" value="{{ old('date_request_wo', $workOrder->date_request_wo->format('Y-m-d')) }}" required>
                                                    </div>
                                                    @error('date_request_wo')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label class="form-label required">Schedule Date</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-calendar-check"></i>
                                                        </span>
                                                        <input type="date" class="form-control" 
                                                               name="schedule_date" value="{{ old('schedule_date', $workOrder->schedule_date->format('Y-m-d')) }}" required>
                                                    </div>
                                                    @error('schedule_date')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label class="form-label">Schedule Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-clock"></i>
                                                        </span>
                                                        <input type="time" class="form-control" 
                                                               name="time_schedule" value="{{ old('time_schedule', $workOrder->time_schedule ? $workOrder->time_schedule->format('H:i') : '') }}">
                                                    </div>
                                                    <small class="form-hint">Optional - leave blank if no specific time is required.</small>
                                                    @error('time_schedule')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label class="form-label">Attendance Status</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-person-check"></i>
                                                        </span>
                                                        <select name="present" class="form-select">
                                                            <option value="0" {{ old('present', $workOrder->present) == 0 ? 'selected' : '' }}>Not Present</option>
                                                            <option value="1" {{ old('present', $workOrder->present) == 1 ? 'selected' : '' }}>Present</option>
                                                        </select>
                                                    </div>
                                                    @error('present')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        <div class="col-12">
                                            <div class="mb-4"> 
                                                <!-- Label dengan ikon Tabler -->
                                                <label class="form-label text-primary fw-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" />
                                                        <path d="M9 3h6a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2H9a2 2 0 0 1 -2 -2V5a2 2 0 0 1 2 -2z" />
                                                        <path d="M9 12l2 0" />
                                                        <path d="M9 16l6 0" />
                                                    </svg>
                                                    Status <span class="text-danger">*</span>
                                                </label>

                                                <!-- Input group dengan gradien biru-hijau -->
                                                <div class="input-group">
                                                    <span class="input-group-text bg-gradient-primary-success text-white border-0 shadow-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-check" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" />
                                                            <path d="M9 3h6a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2H9a2 2 0 0 1 -2 -2V5a2 2 0 0 1 2 -2z" />
                                                            <path d="M15 11l-3 3l-3 -3" />
                                                        </svg>
                                                    </span>
                                                    <select name="status" class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}" id="statusSelect" required>
                                                        <option value="On Progress" {{ old('status', $workOrder->status) == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                                                        <option value="Proses" {{ old('status', $workOrder->status) == 'Proses' ? 'selected' : '' }}>Process</option>
                                                        <option value="Done" {{ old('status', $workOrder->status) == 'Done' ? 'selected' : '' }}>Done</option>
                                                        <option value="Reschedule" {{ old('status', $workOrder->status) == 'Reschedule' ? 'selected' : '' }}>Rescheduled</option>
                                                        <option value="Cancel" {{ old('status', $workOrder->status) == 'Cancel' ? 'selected' : '' }}>Canceled</option>
                                                    </select>
                                                </div>

                                                <!-- Hint dan Error -->
                                                <small class="form-hint text-muted mt-1 d-block">
                                                    Status "Done", "Rescheduled", and "Canceled" can be selected directly.
                                                </small>
                                                @error('status')
                                                    <div class="invalid-feedback d-block mt-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                            <path d="M12 8v4" />
                                                            <path d="M12 16h.01" />
                                                        </svg>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <style>
                                            /* Gradien biru ke hijau muda (biru → aqua/hijau) */
                                                .bg-gradient-primary-success {
                                                    background: linear-gradient(135deg, #467fcf, #4fccbd);
                                                    color: white;
                                                    transition: all 0.2s ease;
                                                }

                                                /* Hover effect */
                                                .input-group .bg-gradient-primary-success:hover {
                                                    background: linear-gradient(135deg, #3d6dbb, #42b8b0);
                                                }

                                                /* Fokus pada select */
                                                .form-select:focus {
                                                    border-color: #467fcf;
                                                    box-shadow: 0 0 0 0.2rem rgba(70, 127, 207, 0.25);
                                                }

                                                /* Responsif: agar tetap rapi di mobile */
                                                @media (max-width: 576px) {
                                                    .input-group .form-select {
                                                        font-size: 0.875rem;
                                                    }
                                                }
                                        </style>

                                        </div>
                                    </div>
                                    
                                    <!-- Full Width Fields -->
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label required">Job Description</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-card-text"></i>
                                                </span>
                                                <textarea class="form-control" 
                                                          name="work_description" rows="3" 
                                                          placeholder="Describe the details of the work that needs to be done..." required>{{ old('work_description', $workOrder->work_description) }}</textarea>
                                            </div>
                                            @error('work_description')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="form-label">Additional Details</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-sticky"></i>
                                                </span>
                                                <textarea class="form-control" 
                                                          name="details" rows="2" 
                                                          placeholder="Additional information or special notes...">{{ old('details', $workOrder->details) }}</textarea>
                                            </div>
                                            @error('details')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden fields for cancellation -->
                                <input type="hidden" name="cancel_reason" id="hiddenCancelReason">
                                <input type="hidden" name="canceled_by" id="hiddenCancelBy" value="{{ Auth::id() }}">
                                
                                <!-- Hidden fields for engineer info -->
                                <input type="hidden" name="engineer_name" id="hiddenEngineerName" value="{{ old('engineer_name', $workOrder->engineer_name) }}">
                                <input type="hidden" name="engineer_notes" id="hiddenEngineerNote" value="{{ old('engineer_notes', $workOrder->engineer_notes) }}">
                                
                                <!-- Hidden fields for "Done" -->
                                <input type="hidden" name="deskripsi_wo_done" id="hiddenDoneDescription">
                                <input type="hidden" name="wo_done_at" id="hiddenDoneAt">
                                <input type="hidden" name="wo_done_by" id="hiddenDoneBy" value="{{ Auth::id() }}">
                            
                            </div>
                            
                            <div class="card-footer bg-light text-end">
                                <a href="{{ route('admin.wo.index') }}" class="btn btn-outline-secondary me-2">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                    <i class="bi bi-check-lg me-1"></i>
                                    Update Work Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Cancel Modal -->
        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel">Cancel Work Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to cancel this work order? Please provide a reason:</p>

                        <div class="mb-3">
                            <label class="form-label required">Cancellation Reason</label>
                            <textarea class="form-control" id="cancelReason" rows="3" placeholder="Enter reason for cancellation..."></textarea>
                            <div class="invalid-feedback" id="cancelReasonFeedback">
                                Reason is required.
                            </div>
                        </div>

                        <div class="alert alert-info small">
                            <i class="bi bi-person me-1"></i>
                            <strong>Canceled by:</strong> {{ Auth::user()->name }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="button" class="btn btn-danger" id="confirmCancelSubmit">Confirm Cancellation</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Engineer Modal -->
        <div class="modal fade" id="engineerModal" tabindex="-1" aria-labelledby="engineerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="engineerModalLabel">Engineer Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please provide engineer information for the "In Process" status:</p>
                        
                        <div class="mb-3">
                            <label class="form-label required">Engineer Name</label>
                            <input type="text" class="form-control" id="engineerName" placeholder="Enter engineer name">
                            <div class="invalid-feedback" style="display: none;">
                                Engineer name is required.
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Engineer Note</label>
                            <textarea class="form-control" id="engineerNote" rows="3" placeholder="Enter any notes from the engineer..."></textarea>
                        </div>

                        <div class="alert alert-info small">
                            <i class="bi bi-clock me-1"></i>
                            <strong>Assigned at:</strong> <span id="currentDateTime"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmEngineerSubmit">Save Information</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Done Modal -->
        <div class="modal fade" id="doneModal" tabindex="-1" aria-labelledby="doneModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="doneModalLabel">Mark Work Order as Done</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please confirm completion of this work order:</p>

                        <div class="mb-3">
                            <label class="form-label required">Work Completion Description</label>
                            <textarea class="form-control" id="doneDescription" rows="4" placeholder="Describe what has been done, parts replaced, notes, etc..."></textarea>
                            <div class="invalid-feedback" id="doneDescriptionFeedback">
                                Description is required.
                            </div>
                        </div>

                        <div class="alert alert-info small">
                            <i class="bi bi-person me-1"></i>
                            <strong>Completed by:</strong> {{ Auth::user()->name }}
                        </div>
                        <div class="alert alert-info small mt-2">
                            <i class="bi bi-clock me-1"></i>
                            <strong>Completed at:</strong> <span id="doneDateTimeDisplay"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="button" class="btn btn-success" id="confirmDoneSubmit">Mark as Done</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Verification Modal -->
        <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verificationModalLabel">Verify Your Identity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>To confirm this action, please verify your email and password:</p>

                        <div class="mb-3">
                            <label class="form-label required">Email</label>
                            <input type="email" class="form-control" id="verifyEmail" value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Password</label>
                            <input type="password" class="form-control" id="verifyPassword" placeholder="Enter your password">
                            <div class="invalid-feedback" id="verifyPasswordFeedback">
                                Password is incorrect.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmVerify">Verify & Submit</button>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Tower & Unit Selection
        const towerSelect = document.getElementById('towerSelect');
        const unitSelect = document.getElementById('unitSelect');

        if (towerSelect) {
            towerSelect.addEventListener('change', function () {
                const towerId = this.value;
                unitSelect.innerHTML = '<option value="">Select Unit</option>';
                unitSelect.disabled = true;

                if (towerId) {
                    fetch(`/admin/wo/api/towers/${towerId}/units`)
                        .then(response => response.json())
                        .then(units => {
                            units.forEach(unit => {
                                const option = document.createElement('option');
                                option.value = unit.id;
                                option.textContent = `${unit.unit_code} - ${unit.unit_type.code} (Floor ${unit.floor.floor_number})`;
                                if (unit.id == {{ $workOrder->unit_id }}) {
                                    option.selected = true;
                                }
                                unitSelect.appendChild(option);
                            });
                            unitSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error fetching units:', error);
                            unitSelect.disabled = false;
                        });
                } else {
                    unitSelect.disabled = false;
                }
            });

            if (towerSelect.value) {
                towerSelect.dispatchEvent(new Event('change'));
            }
        }

        // 2. Form & Status Select
        const statusSelect = document.querySelector('select[name="status"]');
        const form = document.getElementById('workOrderForm');
        const submitBtn = document.getElementById('submitBtn');

        // ========= MODAL ENGINEER (Proses) =========
        const engineerModalEl = document.getElementById('engineerModal');
        const engineerModal = new bootstrap.Modal(engineerModalEl);
        const hiddenEngineerName = document.getElementById('hiddenEngineerName');
        const hiddenEngineerNote = document.getElementById('hiddenEngineerNote');
        const modalEngineerName = document.getElementById('engineerName');
        const modalEngineerNote = document.getElementById('engineerNote');
        const engineerFeedback = modalEngineerName.nextElementSibling;
        const dateTimeDisplay = document.getElementById('currentDateTime');

        let hiddenAssignedAt = document.querySelector('input[name="assigned_at"]');
        if (!hiddenAssignedAt) {
            hiddenAssignedAt = document.createElement('input');
            hiddenAssignedAt.type = 'hidden';
            hiddenAssignedAt.name = 'assigned_at';
            form.appendChild(hiddenAssignedAt);
        }

        let isSubmitting = false;

        // Format WIB
        function formatDateTime(date) {
            const options = {
                timeZone: 'Asia/Jakarta',
                year: 'numeric', month: '2-digit', day: '2-digit',
                hour: '2-digit', minute: '2-digit', second: '2-digit',
                hour12: false
            };
            return new Intl.DateTimeFormat('en-CA', options).format(date).replace(', ', ' ');
        }

        function displayDateTime(date) {
            const options = {
                timeZone: 'Asia/Jakarta',
                day: '2-digit', month: '2-digit', year: 'numeric',
                hour: '2-digit', minute: '2-digit', hour12: false
            };
            return new Intl.DateTimeFormat('id-ID', options).format(date);
        }

        function updateDateTimeDisplay() {
            const now = new Date();
            dateTimeDisplay.textContent = displayDateTime(now);
            hiddenAssignedAt.value = formatDateTime(now);
        }

        // Proses Modal
        submitBtn.addEventListener('click', function (e) {
            if (statusSelect.value === 'Proses' && !isSubmitting) {
                e.preventDefault();
                modalEngineerName.classList.remove('is-invalid');
                engineerFeedback.style.display = 'none';
                modalEngineerName.value = hiddenEngineerName.value || '';
                modalEngineerNote.value = hiddenEngineerNote.value || '';
                updateDateTimeDisplay();
                engineerModal.show();
            }
        });

        document.getElementById('confirmEngineerSubmit').addEventListener('click', function () {
            const nameValue = modalEngineerName.value.trim();
            if (!nameValue) {
                modalEngineerName.classList.add('is-invalid');
                engineerFeedback.style.display = 'block';
                return;
            }
            modalEngineerName.classList.remove('is-invalid');
            engineerFeedback.style.display = 'none';

            hiddenEngineerName.value = nameValue;
            hiddenEngineerNote.value = modalEngineerNote.value.trim();
            engineerModal.hide();
            isSubmitting = true;
            form.submit();
        });

        engineerModalEl.addEventListener('hidden.bs.modal', function () {
            if (!isSubmitting) {
                statusSelect.value = "{{ old('status', $workOrder->status) }}";
            } else {
                isSubmitting = false;
            }
        });

        // ========= MODAL CANCEL =========
        const cancelModalEl = document.getElementById('cancelModal');
        const cancelModal = new bootstrap.Modal(cancelModalEl);
        const cancelReasonInput = document.getElementById('cancelReason');
        const cancelReasonFeedback = document.getElementById('cancelReasonFeedback');
        const hiddenCancelReason = document.getElementById('hiddenCancelReason');
        const hiddenCancelBy = document.getElementById('hiddenCancelBy');

        let isCancelSubmitting = false;

        submitBtn.addEventListener('click', function (e) {
            if (statusSelect.value === 'Cancel' && !isCancelSubmitting) {
                e.preventDefault();
                cancelReasonInput.classList.remove('is-invalid');
                cancelReasonFeedback.style.display = 'none';
                cancelReasonInput.value = hiddenCancelReason.value || '';
                cancelModal.show();
            }
        });

        document.getElementById('confirmCancelSubmit').addEventListener('click', function () {
            const reason = cancelReasonInput.value.trim();
            if (!reason) {
                cancelReasonInput.classList.add('is-invalid');
                cancelReasonFeedback.style.display = 'block';
                return;
            }
            cancelReasonInput.classList.remove('is-invalid');
            cancelReasonFeedback.style.display = 'none';
            hiddenCancelReason.value = reason;
            cancelModal.hide();
            showVerificationModal('Cancel'); // Lanjut ke verifikasi
        });

        // ========= MODAL DONE =========
        const doneModalEl = document.getElementById('doneModal');
        const doneModal = new bootstrap.Modal(doneModalEl);
        const doneDescriptionInput = document.getElementById('doneDescription');
        const doneDescriptionFeedback = document.getElementById('doneDescriptionFeedback');
        const hiddenDoneDescription = document.getElementById('hiddenDoneDescription');
        const hiddenDoneAt = document.getElementById('hiddenDoneAt');
        const hiddenDoneBy = document.getElementById('hiddenDoneBy');
        const doneDateTimeDisplay = document.getElementById('doneDateTimeDisplay');

        let isDoneSubmitting = false;

        function updateDoneDateTime() {
            const now = new Date();
            doneDateTimeDisplay.textContent = displayDateTime(now);
            hiddenDoneAt.value = formatDateTime(now);
        }

        submitBtn.addEventListener('click', function (e) {
            if (statusSelect.value === 'Done' && !isDoneSubmitting) {
                e.preventDefault();
                doneDescriptionInput.classList.remove('is-invalid');
                doneDescriptionFeedback.style.display = 'none';
                doneDescriptionInput.value = hiddenDoneDescription.value || '';
                updateDoneDateTime();
                doneModal.show();
            }
        });

        document.getElementById('confirmDoneSubmit').addEventListener('click', function () {
            const desc = doneDescriptionInput.value.trim();
            if (!desc) {
                doneDescriptionInput.classList.add('is-invalid');
                doneDescriptionFeedback.style.display = 'block';
                return;
            }
            doneDescriptionInput.classList.remove('is-invalid');
            doneDescriptionFeedback.style.display = 'none';
            hiddenDoneDescription.value = desc;
            doneModal.hide();
            showVerificationModal('Done'); // Lanjut ke verifikasi
        });

        // ========= VERIFICATION MODAL LOGIC =========
        const verificationModalEl = document.getElementById('verificationModal');
        const verificationModal = new bootstrap.Modal(verificationModalEl);
        const verifyPassword = document.getElementById('verifyPassword');
        const verifyPasswordFeedback = document.getElementById('verifyPasswordFeedback');
        const confirmVerify = document.getElementById('confirmVerify');

        let pendingAction = null; // 'Cancel' atau 'Done'

        function showVerificationModal(action) {
            pendingAction = action;
            verifyPassword.value = '';
            verifyPassword.classList.remove('is-invalid');
            verifyPasswordFeedback.style.display = 'none';
            verificationModal.show();
        }

        confirmVerify.addEventListener('click', function () {
            const password = verifyPassword.value.trim();

            if (!password) {
                verifyPassword.classList.add('is-invalid');
                verifyPasswordFeedback.style.display = 'block';
                return;
            }

            fetch('{{ route("admin.wo.verify") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: document.getElementById('verifyEmail').value,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    verificationModal.hide();
                    // Lanjutkan ke submit form
                    if (pendingAction === 'Cancel' || pendingAction === 'Done') {
                        form.submit();
                    }
                } else {
                    verifyPassword.classList.add('is-invalid');
                    verifyPasswordFeedback.style.display = 'block';
                }
            })
            .catch(() => {
                alert('Verification failed. Please try again.');
            });
        });

        verificationModalEl.addEventListener('hidden.bs.modal', function () {
            if (pendingAction === 'Cancel') {
                statusSelect.value = "{{ old('status', $workOrder->status) }}";
                pendingAction = null;
            } else if (pendingAction === 'Done') {
                statusSelect.value = "{{ old('status', $workOrder->status) }}";
                pendingAction = null;
            }
        });
    });
</script>

    <style>
        :root {
            --primary-color: #51A49A;
            --primary-dark: #438a80;
            --primary-light: rgba(81, 164, 154, 0.15);
            --secondary-color: #2f3e4e;
            --light-bg: #f8f9fa;
            --border-radius: 12px;
        }
        
        body {
            background-color: #f5f7f9;
            color: #2f3e4e;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-title {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.8rem;
        }
        
        .required:after {
            content: " *";
            color: #e03131;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            transition: all 0.2s ease;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }
        
        .input-group-text {
            background-color: var(--light-bg);
            border: 1px solid #dee2e6;
            border-right: none;
            color: var(--primary-color);
        }
        
        .card {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background-color: rgba(81, 164, 154, 0.1);
            padding: 1.25rem 1.5rem;
        }
        
        .card-title {
            font-weight: 600;
            color: var(--secondary-color);
            font-size: 1.25rem;
            margin: 0;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .form-hint {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.2s ease;
            padding: 0.625rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .btn-outline-secondary {
            border-radius: 8px;
            padding: 0.625rem 1.5rem;
            font-weight: 500;
        }
        
        .btn-outline-secondary:hover {
            background-color: #f1f3f5;
        }
        
        .invalid-feedback {
            font-size: 0.85rem;
        }
        
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
            padding: 1rem 1.5rem;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .status-progress {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }
        
        .status-done {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }
        
        .status-cancel {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
        
        .status-reschedule {
            background-color: rgba(108, 117, 125, 0.2);
            color: #6c757d;
        }
        
        .info-icon {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }
    </style>
