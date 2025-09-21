<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.logbook.update', $logbook->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card border-success">

           <div class="card-header bg-teal-50 position-relative" style="border-bottom: 3px solid #51A49A;">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Left side content -->
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-teal text-white rounded p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="ti ti-notebook fs-3"></i>
                        </div>
                        <div>
                            <h3 class="card-title text-teal mb-0">
                                Edit Logbook - {{ $logbook->logbook_number }}
                            </h3>
                            <div class="text-muted small">
                                Last updated: {{ $logbook->updated_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                    </div>

                    <!-- Right-aligned elements -->
                    <div class="d-flex align-items-center ms-2 gap-3">
                        <!-- Status badge -->
                        <span class="badge bg-{{ $logbook->status == 'Completed' ? 'teal' : 'orange' }} px-3 py-2 rounded-pill d-flex align-items-center">
                            @if($logbook->status == 'Completed')
                                <i class="ti ti-check me-2"></i> Completed
                            @else
                                <i class="ti ti-clock me-2"></i> On Progress
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Desktop-only back button (hidden on mobile) -->
            <div class="position-absolute top-0 end-0 mt-2 me-2 d-none d-md-block">
                <a href="{{ route('admin.logbook.index') }}" class="btn btn-teal d-flex align-items-center gap-2">
                    <i class="ti ti-arrow-left"></i>
                    <span>Back to List</span>
                </a>
</div>
            
          </div>

                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required text-green">Logbook Date</label>
                                <div class="input-icon">
                                    <input type="date" readonly name="logbook_date" class="form-control @error('logbook_date') is-invalid @enderror" 
                                        value="{{ old('logbook_date', $logbook->logbook_date->format('Y-m-d')) }}" required>
                                    <span class="input-icon-addon text-success">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                                @error('logbook_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label  class="form-label required text-green">Logbook Number</label>
                                <div class="input-icon">
                                    <input type="text" name="logbook_number" readonly class="form-control @error('logbook_number') is-invalid @enderror" 
                                        value="{{ old('logbook_number', $logbook->logbook_number) }}" required>
                                    <span class="input-icon-addon text-success">
                                        <i class="ti ti-hash"></i>
                                    </span>
                                </div>
                                @error('logbook_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> 


                    <div class="mb-4">
                        <div class="accordion" id="staffAccordion">
                            <!-- HOD Information Accordion -->
                            <div class="accordion-item border border-success">
                                <h2 class="accordion-header" id="headingHOD">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHOD" aria-expanded="false" aria-controls="collapseHOD" style="background-color: #51A49A; color: #fff;">
                                        <i class="ti ti-user-star me-2"></i>HOD Information
                                    </button>
                                </h2>
                                <div id="collapseHOD" class="accordion-collapse collapse" aria-labelledby="headingHOD" data-bs-parent="#staffAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="card shadow-sm border-success mb-3">
                                                    <div class="card-body row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label required"><i class="ti ti-user me-1 text-success"></i>MOD</label>
                                                            <input type="text" name="mod" class="form-control" value="{{ old('mod', $logbook->staff->mod) }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label required"><i class="ti ti-user-crown me-1 text-warning"></i>Chief TR</label>
                                                            <input type="text" name="chief_tr" class="form-control" value="{{ old('chief_tr', $logbook->staff->chief_tr) }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label required"><i class="ti ti-settings me-1 text-info"></i>Chief Engineering</label>
                                                            <input type="text" name="chief_enginer" class="form-control" value="{{ old('chief_enginer', $logbook->staff->chief_enginer) }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label required"><i class="ti ti-shield me-1 text-danger"></i>Chief Security</label>
                                                            <input type="text" name="chief_security" class="form-control" value="{{ old('chief_security', $logbook->staff->chief_security) }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label required"><i class="ti ti-broom me-1 text-primary"></i>Chief Housekeeping</label>
                                                            <input type="text" name="chief_hk" class="form-control" value="{{ old('chief_hk', $logbook->staff->chief_hk) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Staff Information Accordion -->
                            <div class="accordion-item border border-success mt-2">
                                <h2 class="accordion-header" id="headingStaff">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStaff" aria-expanded="false" aria-controls="collapseStaff" style="background-color: #51A49A; color: #fff;">
                                        <i class="ti ti-users me-2"></i>Staff Information
                                    </button>
                                </h2>
                                <div id="collapseStaff" class="accordion-collapse collapse" aria-labelledby="headingStaff" data-bs-parent="#staffAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <!-- Tenant Relation -->
                                            <div class="col-md-4">
                                                <div class="card shadow-sm border-success mb-3">
                                                    <div class="card-header bg-success-lt">
                                                        <i class="ti ti-user me-1 text-success"></i>Tenant Relation
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-user me-1 text-success"></i>Morning</label>
                                                            <input type="text" name="c_morning" class="form-control" value="{{ old('c_morning', $logbook->staff->c_morning) }}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-user me-1 text-warning"></i>Afternoon</label>
                                                            <input type="text" name="c_afternoon" class="form-control" value="{{ old('c_afternoon', $logbook->staff->c_afternoon) }}" required>
                                                        </div>
                                                        <div>
                                                            <label class="form-label required"><i class="ti ti-user me-1 text-info"></i>Evening</label>
                                                            <input type="text" name="c_evening" class="form-control" value="{{ old('c_evening', $logbook->staff->c_evening) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Health Club -->
                                            <div class="col-md-4">
                                                <div class="card shadow-sm border-danger mb-3">
                                                    <div class="card-header bg-danger-lt">
                                                        <i class="ti ti-heart me-1 text-danger"></i>Health Club
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-heart me-1 text-danger"></i>Morning</label>
                                                            <input type="text" name="hc_morning" class="form-control" value="{{ old('hc_morning', $logbook->staff->hc_morning) }}" required>
                                                        </div>
                                                        <div>
                                                            <label class="form-label required"><i class="ti ti-heart me-1 text-warning"></i>Afternoon</label>
                                                            <input type="text" name="hc_afternoon" class="form-control" value="{{ old('hc_afternoon', $logbook->staff->hc_afternoon) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Engineering -->
                                            <div class="col-md-4">
                                                <div class="card shadow-sm border-primary mb-3">
                                                    <div class="card-header bg-primary-lt">
                                                        <i class="ti ti-settings me-1 text-primary"></i>Engineering
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-settings me-1 text-primary"></i>Morning</label>
                                                            <input type="text" name="enginer_morning" class="form-control" value="{{ old('enginer_morning', $logbook->staff->enginer_morning) }}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-settings me-1 text-warning"></i>Afternoon</label>
                                                            <input type="text" name="enginer_afternoon" class="form-control" value="{{ old('enginer_afternoon', $logbook->staff->enginer_afternoon) }}" required>
                                                        </div>
                                                        <div>
                                                            <label class="form-label required"><i class="ti ti-settings me-1 text-info"></i>Evening</label>
                                                            <input type="text" name="enginer_night" class="form-control" value="{{ old('enginer_night', $logbook->staff->enginer_night) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Housekeeping -->
                                            <div class="col-md-4">
                                                <div class="card shadow-sm border-success mb-3">
                                                    <div class="card-header bg-success-lt">
                                                        <i class="ti ti-broom me-1 text-success"></i>Housekeeping
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-broom me-1 text-success"></i>Morning</label>
                                                            <input type="text" name="hk_morning" class="form-control" value="{{ old('hk_morning', $logbook->staff->hk_morning) }}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-broom me-1 text-warning"></i>Afternoon</label>
                                                            <input type="text" name="hk_afternoon" class="form-control" value="{{ old('hk_afternoon', $logbook->staff->hk_afternoon) }}" required>
                                                        </div>
                                                        <div>
                                                            <label class="form-label required"><i class="ti ti-broom me-1 text-info"></i>Evening</label>
                                                            <input type="text" name="hk_night" class="form-control" value="{{ old('hk_night', $logbook->staff->hk_night) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Security -->
                                            <div class="col-md-4">
                                                <div class="card shadow-sm border-success mb-3">
                                                    <div class="card-header bg-success-lt">
                                                        <i class="ti ti-shield me-1 text-success"></i>Security
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-shield me-1 text-success"></i>Morning</label>
                                                            <input type="text" name="sec_morning" class="form-control" value="{{ old('sec_morning', $logbook->staff->sec_morning) }}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-shield me-1 text-warning"></i>Afternoon</label>
                                                            <input type="text" name="sec_afternoon" class="form-control" value="{{ old('sec_afternoon', $logbook->staff->sec_afternoon) }}" required>
                                                        </div>
                                                        <div>
                                                            <label class="form-label required"><i class="ti ti-shield me-1 text-info"></i>Evening</label>
                                                            <input type="text" name="sec_night" class="form-control" value="{{ old('sec_night', $logbook->staff->sec_night) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- HSE -->
                                            <div class="col-md-4">
                                                <div class="card shadow-sm border-success mb-3">
                                                    <div class="card-header bg-success-lt">
                                                        <i class="ti ti-medical-cross me-1 text-success"></i>HSE
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-medical-cross me-1 text-success"></i>Morning</label>
                                                            <input type="text" name="hse_morning" class="form-control" value="{{ old('hse_morning', $logbook->staff->hse_morning) }}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label required"><i class="ti ti-medical-cross me-1 text-warning"></i>Afternoon</label>
                                                            <input type="text" name="hse_afternoon" class="form-control" value="{{ old('hse_afternoon', $logbook->staff->hse_afternoon) }}" required>
                                                        </div>
                                                        <div>
                                                            <label class="form-label required"><i class="ti ti-medical-cross me-1 text-info"></i>Evening</label>
                                                            <input type="text" name="hse_night" class="form-control" value="{{ old('hse_night', $logbook->staff->hse_night) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                

                    <div class="mb-4">
                        <div class="alert bg-green-lt">
                            <h4 class="mb-0 text-green">
                                <i class="ti ti-list-details me-2"></i>Work Entries
                            </h4>
                        </div>
                        <div id="entries-container">
                            @foreach(old('entries', $logbook->entries->toArray()) as $index => $entry)
                            <div class="entry-item card mb-3 border-top-success">
                                <div class="card-header bg-green-lt d-flex justify-content-between align-items-center">
                                    <h5 class="card-title text-green">
                                        <i class="ti ti-file-text me-2"></i>Entry #{{ $loop->iteration }}
                                    </h5>
                                     <a href="#" class="btn btn-danger delete-btn" 
                                        data-url="{{ route('admin.logbook.entries.destroy', $entry['id'] ?? '') }}">
                                        <i class="ti ti-trash me-2"></i>Delete
                                    </a>
                              
                                 
                               
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label required">Tower</label>
                                                <div class="input-icon">
                                                    <input type="text" name="entries[{{ $index }}][tower]" 
                                                        class="form-control" value="{{ $entry['tower'] ?? '' }}" required>
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-building"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label required">Unit</label>
                                                <div class="input-icon">
                                                    <input type="text" name="entries[{{ $index }}][unit]" 
                                                        class="form-control" value="{{ $entry['unit'] ?? '' }}" required>
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-home"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label required">Status</label>
                                                <select name="entries[{{ $index }}][status]" class="form-select" required>
                                                    <option value="On Progress" {{ isset($entry['status']) && $entry['status'] == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                                                    {{-- <option value="Set Schedule" {{ isset($entry['status']) && $entry['status'] == 'Set Schedule' ? 'selected' : '' }}>Set Schedule</option>
                                                    <option value="Reschedule" {{ isset($entry['status']) && $entry['status'] == 'Reschedule' ? 'selected' : '' }}>Reschedule</option> --}}
                                                    <option value="Done" {{ isset($entry['status']) && $entry['status'] == 'Done' ? 'selected' : '' }}>Done</option>
                                                    {{-- <option value="Cancel" {{ isset($entry['status']) && $entry['status'] == 'Cancel' ? 'selected' : '' }}>Cancel</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label required">Description</label>
                                                <textarea name="entries[{{ $index }}][description]" class="form-control" rows="2" required>{{ $entry['description'] ?? '' }}</textarea>
                                                 <!-- Input hidden untuk result -->
                                                   <input type="hidden" name="entries[{{ $index }}][id]" value="{{ $entry['id'] ?? '' }}">
                                                <input type="hidden" name="entries[{{ $index }}][result]" id="entry-result-{{ $index }}" value="{{ $entry['result'] ?? '' }}">
            

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                       <div class="text-center mt-3">
    <button type="button" id="add-entry" class="btn" style="background-color: #51A49A; color: white;">
        <i class="ti ti-plus me-2"></i>Add New Entry
    </button>
</div>
                    </div>

                    </div>
                        <div class="card-footer bg-green-lt text-end">
                            <button type="button" id="triggerSubmit" class="btn btn-teal">
                                <i class="ti ti-device-floppy me-2"></i>Save Changes
                            </button>
                            <!-- Hidden actual submit button -->
                            <button type="submit" id="realSubmit" class="d-none"></button>

                            <a href="{{ route('admin.logbook.index') }}" class="btn btn-secondary">
                                <i class="ti ti-x me-2"></i>Cancel
                            </a>
                        </div>
                    </div>

             <!-- Verification Modal -->
                <div class="modal modal-blur fade" id="verificationModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success">
                        <i class="ti ti-shield-lock me-2"></i>Security Verification
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                        <label class="form-label required">Your Email</label>
                        <input type="email" id="verifyEmail" class="form-control" placeholder="user@example.com" required>
                        </div>
                        <div class="mb-3">
                        <label class="form-label required">Your Password</label>
                        <input type="password" id="verifyPassword" class="form-control" placeholder="········" required>
                        </div>
                        <div id="verificationError" class="alert alert-danger mt-3 d-none">
                        <i class="ti ti-alert-circle me-2"></i>
                        <span id="errorMessage">Invalid credentials. Please try again.</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="confirmVerification" class="btn btn-success">
                        <i class="ti ti-check me-2"></i>Verify & Save
                        </button>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Result Modal -->
                <div class="modal modal-blur fade" id="resultModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success">
                                    <i class="ti ti-checkbox me-2"></i>Work Result
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label required">Work Result Details</label>
                                    <textarea id="resultDetails" class="form-control" rows="5" placeholder="Describe the work result..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" id="saveResult" class="btn btn-success">
                                    <i class="ti ti-check me-2"></i>Save Result
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Result Modal -->
                
        </form>
        
        <!-- Tambahkan modal verifikasi di bagian bawah form -->
            <div class="modal modal-blur fade" id="verificationModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-success">
                                <i class="ti ti-shield-lock me-2"></i>Security Verification
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label required">Your Email</label>
                                <input type="email" id="verifyEmail" class="form-control" placeholder="user@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Your Password</label>
                                <input type="password" id="verifyPassword" class="form-control" placeholder="········" required>
                            </div>
                            <div id="verificationError" class="alert alert-danger mt-3 d-none">
                                <i class="ti ti-alert-circle me-2"></i>
                                <span id="errorMessage">Invalid credentials. Please try again.</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmVerification" class="btn btn-success">
                                <i class="ti ti-check me-2"></i>Verify & Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Form tersembunyi untuk delete -->
        <form id="deleteForm" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Add new entry
        document.getElementById('add-entry').addEventListener('click', function() {
            const container = document.getElementById('entries-container');
            const entryItems = document.querySelectorAll('.entry-item');
            const index = entryItems.length;
            
            const html = `
            <div class="entry-item card mb-3 border-top-success">
                <div class="card-header bg-green-lt d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-green">
                        <i class="ti ti-file-text me-2"></i>Entry #${index + 1}
                    </h5>
                    <button type="button" class="btn btn-icon btn-danger btn-sm remove-entry" data-bs-toggle="tooltip" title="Remove entry">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label required">Tower</label>
                                <div class="input-icon">
                                    <input type="text" name="entries[${index}][tower]" class="form-control" required>
                                    <span class="input-icon-addon">
                                        <i class="ti ti-building"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label required">Unit</label>
                                <div class="input-icon">
                                    <input type="text" name="entries[${index}][unit]" class="form-control" required>
                                    <span class="input-icon-addon">
                                        <i class="ti ti-home"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label required">Status</label>
                                <select name="entries[${index}][status]" class="form-select" required>
                                    <option value="On Progress">On Progress</option>
                                    <option value="Done">Done</option>
                                  
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Description</label>
                                <textarea name="entries[${index}][description]" class="form-control" rows="2" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
            
            container.insertAdjacentHTML('beforeend', html);
            
            // Initialize tooltip for the new remove button
            const newTooltipTrigger = container.lastElementChild.querySelector('[data-bs-toggle="tooltip"]');
            if (newTooltipTrigger) {
                new bootstrap.Tooltip(newTooltipTrigger);
            }
            
            updateEntryNumbers();
        });

        // Remove entry (delegated event)
        document.getElementById('entries-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-entry') || e.target.closest('.remove-entry')) {
                const entryItem = e.target.closest('.entry-item');
                if (document.querySelectorAll('.entry-item').length > 1) {
                    entryItem.remove();
                    updateEntryNumbers();
                } else {
                    alert('You must have at least one entry.');
                }
            }
        });

        // Update entry numbers
        function updateEntryNumbers() {
            document.querySelectorAll('.entry-item').forEach((item, index) => {
                const title = item.querySelector('.card-title');
                if (title) {
                    title.innerHTML = `<i class="ti ti-file-text me-2"></i>Entry #${index + 1}`;
                }
                // Update all input names with correct index
                const inputs = item.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/entries\[\d+\]/, `entries[${index}]`));
                    }
                });
            });
        }
    });

</script>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
        const verifyEmail = document.getElementById('verifyEmail');
        const verifyPassword = document.getElementById('verifyPassword');
        const confirmVerification = document.getElementById('confirmVerification');
        const verificationError = document.getElementById('verificationError');
        const errorMessage = document.getElementById('errorMessage');
        const deleteForm = document.getElementById('deleteForm');
        
        let currentAction = null;
        let currentUrl = null;

        // Set email pengguna yang login
        verifyEmail.value = "{{ auth()->user()->email }}";

        // Handle save changes
        document.getElementById('triggerSubmit').addEventListener('click', function(e) {
            e.preventDefault();
            currentAction = 'save';
            verificationModal.show();
        });

        // Handle delete button
       document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            currentAction = 'delete';
            currentUrl = this.getAttribute('data-url');
            verificationModal.show();
        });
    });

        // Handle verifikasi
        confirmVerification.addEventListener('click', async function() {
            // Validasi input
            if (!verifyEmail.value || !verifyPassword.value) {
                showError('Please fill in both email and password fields');
                return;
            }

            // Tampilkan loading
            setButtonLoading(true);

            try {
                const response = await fetch('{{ route("verify.credentials") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: verifyEmail.value,
                        password: verifyPassword.value
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Verification failed');
                }

                if (data.success) {
                    // Verifikasi berhasil, lakukan aksi
                    verificationModal.hide();
                    
                    if (currentAction === 'save') {
                        document.getElementById('realSubmit').click();
                    } else if (currentAction === 'delete') {
                        deleteForm.action = currentUrl;
                        deleteForm.submit();
                    }
                } else {
                    showError(data.message || 'Invalid credentials');
                }
            } catch (error) {
                console.error('Verification error:', error);
                showError(error.message || 'An error occurred during verification');
            } finally {
                setButtonLoading(false);
            }
        });

        // Helper functions
        function showError(message) {
            errorMessage.textContent = message;
            verificationError.classList.remove('d-none');
        }

        function setButtonLoading(isLoading) {
            confirmVerification.disabled = isLoading;
            confirmVerification.innerHTML = isLoading 
                ? '<i class="ti ti-loader me-2"></i>Verifying...' 
                : '<i class="ti ti-check me-2"></i>Verify & Continue';
        }

        // Reset modal ketika ditutup
        verificationModal._element.addEventListener('hidden.bs.modal', function() {
            verificationError.classList.add('d-none');
            verifyPassword.value = '';
            currentAction = null;
            currentUrl = null;
        });
    });
</script>

{{-- Modal Result --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
    const resultDetails = document.getElementById('resultDetails');
    const saveResultBtn = document.getElementById('saveResult');
    
    let currentEntryIndex = null;
    let currentStatusSelect = null;

    // Delegasi event untuk perubahan status
    document.getElementById('entries-container').addEventListener('change', function(e) {
        if (e.target && e.target.name && e.target.name.includes('[status]')) {
            const select = e.target;
            if (select.value === 'Done') {
                currentStatusSelect = select;
                // Dapatkan index entry
                const nameAttr = select.getAttribute('name');
                const matches = nameAttr.match(/entries\[(\d+)\]\[status\]/);
                if (matches && matches[1]) {
                    currentEntryIndex = matches[1];
                    // Ambil nilai result yang sudah ada jika ada
                    const existingResult = document.getElementById(`entry-result-${currentEntryIndex}`).value;
                    resultDetails.value = existingResult || '';
                    resultModal.show();
                }
            }
        }
    });

    // Simpan result
    saveResultBtn.addEventListener('click', function() {
        if (currentEntryIndex !== null) {
            document.getElementById(`entry-result-${currentEntryIndex}`).value = resultDetails.value;
            resultModal.hide();
        }
    });

    // Reset modal ketika ditutup
    resultModal._element.addEventListener('hidden.bs.modal', function() {
        // Jika modal ditutup tanpa menyimpan, kembalikan status ke sebelumnya
        if (resultDetails.value === '' && currentStatusSelect) {
            currentStatusSelect.value = 'On Progress';
        }
        currentEntryIndex = null;
        currentStatusSelect = null;
        resultDetails.value = '';
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Function to update overall status
    function updateOverallStatus() {
        const statusSelects = document.querySelectorAll('select[name^="entries"][name$="[status]"]');
        let allDone = true;
        
        statusSelects.forEach(select => {
            if (select.value !== 'Done') {
                allDone = false;
            }
        });
        
        const statusBadge = document.querySelector('.card-header .badge');
        if (statusBadge) {
            if (allDone && statusSelects.length > 0) {
                statusBadge.className = 'badge bg-green';
                statusBadge.innerHTML = '<i class="ti ti-check me-1"></i> Completed';
            } else if (statusSelects.length > 0) {
                statusBadge.className = 'badge bg-orange';
                statusBadge.innerHTML = '<i class="ti ti-clock me-1"></i> On Progress';
            } else {
                statusBadge.className = 'badge bg-secondary';
                statusBadge.innerHTML = '<i class="ti ti-file-text me-1"></i> Draft';
            }
        }
    }
    
    // Initial update
    updateOverallStatus();
    
    // Update when status changes
    document.getElementById('entries-container').addEventListener('change', function(e) {
        if (e.target && e.target.name && e.target.name.includes('[status]')) {
            updateOverallStatus();
        }
    });
    
    // Also update when adding/removing entries
    document.getElementById('add-entry').addEventListener('click', function() {
        setTimeout(updateOverallStatus, 100);
    });
    
    document.getElementById('entries-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-entry') || e.target.closest('.remove-entry')) {
            setTimeout(updateOverallStatus, 100);
        }
    });
});
</script>

@endpush
