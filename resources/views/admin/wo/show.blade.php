<div class="page-wrapper">
    <!-- Page Header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-3 align-items-center mb-3">
                <div class="col">
                    <div class="d-flex align-items-center">
                        <!-- Icon -->
                        <div class="rounded-circle btn-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M10 12l2 2l4 -4" />
                            </svg>
                        </div>
                        <!-- Title -->
                        <div>
                            <h2 class="page-title mb-0" style="font-weight: 700; font-size: 1.6rem;" style="color: #3fbeb8;">WORK ORDER DETAILS</h2>
                            <small class="text-muted">Work Order #{{ $workOrder->wo_no }} • Created: {{ $workOrder->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>
                <!-- Back Button -->
                <div class="col-auto">
                    <a href="{{ route('admin.wo.index') }}" class="btn btn-primary px-3 rounded-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
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

    <!-- Page Body -->
    <div class="page-body">
        <div class="container-xl py-4">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <!-- Status Badge -->
                    <div class="text-center mb-4">
                        <span class="badge rounded-pill px-4 py-2 fs-5 text-white shadow-sm" 
                              style="background: {{ $workOrder->status === 'Done' ? '#28a745' : ($workOrder->status === 'Proses' ? '#007bff' : ($workOrder->status === 'Cancel' ? '#dc3545' : '#ffc107')) }};">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check me-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M9 12l2 2l4 -4" />
                            </svg>
                            {{ $workOrder->status }}
                        </span>
                    </div>

                    <!-- Main Card -->
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title text-dark mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle text-primary me-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 9h.01" />
                                    <path d="M11 12h1v4h1" />
                                </svg>
                                Work Order Information
                            </h5>
                        </div>

                        <div class="card-body p-4">

                            <!-- Basic Info Grid -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded h-100">
                                        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                                            <i class="fas fa-calendar-alt text-warning me-2"></i> Request Work Order Info
                                        </h6>
                                        <div class="row g-2 small">
                                            <div class="col-6"><span class="text-muted">WO Number</span><div class="fw-medium">{{ $workOrder->wo_no }}</div></div>
                                            <div class="col-6"><span class="text-muted">Request Date</span><div class="fw-medium">{{ $workOrder->date_request_wo->format('d M Y') }}</div></div>
                                            <div class="col-12"><span class="text-muted">Tenant Name</span><div class="fw-medium">{{ $workOrder->tenant_name }}</div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded h-100">
                                        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                                            <i class="fas fa-building text-info me-2"></i> Unit Info
                                        </h6>
                                        <div class="row g-2 small">
                                            <div class="col-12"><div class="fw-medium">{{ $workOrder->tower->name }}</div><div class="text-muted">{{ $workOrder->tower->location }}</div></div>
                                            <div class="col-12"><div class="fw-medium">{{ $workOrder->unit->unit_code }} - {{ $workOrder->unit->unitType->code }}</div><div class="text-muted">Floor {{ $workOrder->unit->floor->floor_number }}</div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule & Attendance -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded">
                                        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                                            <i class="fas fa-clock text-success me-2"></i> Schedule Work Order
                                        </h6>
                                        <div class="row g-2 small">
                                            <div class="col-6"><span class="text-muted">Date</span><div class="fw-medium">{{ $workOrder->schedule_date->format('d M Y') }}</div></div>
                                            <div class="col-6"><span class="text-muted">Time</span><div class="fw-medium">{{ $workOrder->time_schedule?->format('H:i') ?? 'Not specified' }}</div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded">
                                        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                                            <i class="fas fa-user-check text-success me-2"></i> Attendance
                                        </h6>
                                        <div class="mt-1">
                                            @if($workOrder->present)
                                                <span class="badge bg-success text-white px-3 py-2 rounded-pill">
                                                    <i class="fas fa-check-circle me-1"></i> Present
                                                </span>
                                            @else
                                                <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">
                                                    <i class="fas fa-times-circle me-1"></i> Not Present
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Job & Additional Description -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded h-100">
                                        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                                            <i class="fas fa-tasks text-primary me-2"></i> Description Work Order 
                                        </h6>
                                        <p class="small mb-0">{{ $workOrder->work_description }}</p>
                                    </div>
                                </div>

                                @if($workOrder->details)
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded h-100">
                                            <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                                                <i class="fas fa-sticky-note text-muted me-2"></i> Additional Notes
                                            </h6>
                                            <p class="small mb-0">{{ $workOrder->details }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Cancel Reason -->
                            @if($workOrder->status === 'Cancel' && $workOrder->cancel_reason)
                                <div class="alert  alert-danger border-0 rounded-3 p-4 mb-4">
                                    <h6 class="fw-semibold mb-3">
                                        <i class="fas fa-ban me-2"></i> Cancellation Reason
                                    </h6>
                                    <p class="small mb-1"><strong>Reason:</strong> {{ $workOrder->cancel_reason }}</p>
                                    <p class="small mb-1"><strong>By:</strong> {{ $workOrder->canceledBy?->name ?? 'Unknown' }}</p>
                                    <p class="small mb-0"><strong>At:</strong> {{ $workOrder->updated_at->timezone('Asia/Jakarta')->format('d M Y, H:i \W\I\B') }}</p>
                                </div>
                            @endif

                            <!-- Engineering Process -->
                            @if($workOrder->status === 'Proses')
                                <div class="card border-primary shadow-none mb-4 rounded-3 bg-gradient-to-r from-blue-50 to-indigo-50">
                                    <div class="card-header bg-primary text-white py-2 px-3 rounded-top-3">
                                        <h6 class="mb-0">
                                            <i class="fas fa-cogs me-2"></i> Engineering Process
                                        </h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row g-3 small">
                                            <div class="col-md-6"><span class="text-muted">Engineer</span><div class="fw-medium">{{ $workOrder->engineer_name }}</div></div>
                                            <div class="col-md-6"><span class="text-muted">Assigned At</span><div class="fw-medium">{{ $workOrder->assigned_at?->format('d M Y H:i') ?? 'Not specified' }}</div></div>
                                            <div class="col-12">
                                                <span class="text-muted">Notes</span>
                                                <div class="bg-white border rounded p-2 mt-1">
                                                    <p class="mb-0 small">{{ $workOrder->engineer_notes ?? 'No notes provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                               <!-- Proses Work Order -->
                            @if($workOrder->status === 'Done')
                                <div class="card border-primary shadow-none mb-4 rounded-3 bg-gradient-to-r from-green-50 to-emerald-50">
                                    <div class="card-header bg-primary text-white py-2 px-3 rounded-top-3">
                                        <h6 class="mb-0">
                                            <i class="fas fa-check-circle me-2"></i> Work Order Process Engineering
                                        </h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row g-3 small">
                                            <div class="col-md-6"><span class="text-muted">Engineer Name</span><div class="fw-medium">{{ $workOrder->engineer_name ?? 'Not specified' }}</div></div>
                                            <div class="col-md-6"><span class="text-muted">Engineering At</span><div class="fw-medium">{{ $workOrder->assigned_at?->format('d M Y H:i') ?? 'Not specified' }}</div></div>
                    
                                            <div class="col-12">
                                                <span class="text-muted">Engineer Notes</span>
                                                <div class="bg-white border rounded p-2 mt-1">
                                                    <p class="mb-0 ">{{ $workOrder->engineer_notes ?? 'No notes provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Work Order Done -->
                            @if($workOrder->status === 'Done')
                                <div class="card border-success shadow-none mb-4 rounded-3 bg-gradient-to-r from-green-50 to-emerald-50">
                                    <div class="card-header bg-success text-white py-2 px-3 rounded-top-3">
                                        <h6 class="mb-0">
                                            <i class="fas fa-check-circle me-2"></i> Work Order Completed
                                        </h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row g-3 small">

                                            <div class="col-md-6"><span class="text-muted">Completed By</span><div class="fw-medium">{{ $workOrder->doneBy?->name ?? 'Not specified' }}</div></div>
                                            <div class="col-md-6"><span class="text-muted">Completed At</span><div class="fw-medium">{{ $workOrder->wo_done_at?->format('d M Y H:i') ?? 'Not specified' }}</div></div>
                                            <div class="col-12">
                                                <span class="text-muted">Work Description (Done)</span>
                                                <div class="bg-white border rounded p-2 mt-1">
                                                    <p class="mb-0 small">{{ $workOrder->deskripsi_wo_done ?? 'Not specified' }}</p>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Footer -->
                            <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 border-top">
                                <small class="text-muted">Last updated: {{ $workOrder->updated_at->format('d M Y, H:i') }}</small>
                                <div class="btn-group-action d-flex gap-2 mt-2 mt-md-0">
                                    <a href="{{ route('admin.wo.edit', $workOrder->id) }}" class="btn btn-primary px-4 rounded-pill hover-lift">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.415v3h3l8.415 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-danger px-4 rounded-pill hover-lift" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!-- Delete Modal yang sudah dimodifikasi menjadi Verification Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                            <div class="modal-header bg-danger text-white py-3">
                                <h6 class="modal-title">
                                    <i class="fas fa-exclamation-triangle me-2"></i> Confirm Deletion
                                </h6>
                            </div>
                            <div class="modal-body text-center py-4">
                                <p class="mb-3 small">You will delete the Work Order #{{ $workOrder->wo_no }}?</p>
                                <div class="bg-light p-2 rounded mb-3">
                                    <strong>{{ $workOrder->tenant_name }}</strong><br>
                                    <span class="badge text-white {{ $workOrder->status === 'Done' ? 'bg-success' : ($workOrder->status === 'Proses' ? 'bg-primary' : ($workOrder->status === 'Cancel' ? 'bg-danger' : 'bg-warning')) }} mt-1">
                                        {{ $workOrder->status }}
                                    </span>
                                </div>
                                
                                <!-- Form Verifikasi -->
                                <div class="verification-form mt-3">
                                    <div class="mb-3 text-start">
                                        <label for="verifyEmail" class="form-label small">Email</label>
                                        <input type="email" class="form-control form-control-sm" id="verifyEmail" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="verifyPassword" class="form-label small">Password</label>
                                        <input type="password" class="form-control form-control-sm" id="verifyPassword" placeholder="Enter your password">
                                        <div class="invalid-feedback small" id="verifyPasswordFeedback">
                                            Wrong password. Please try again.
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="text-danger mb-0 small mt-2">This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer bg-light d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.wo.destroy', $workOrder->id) }}" method="POST" class="d-inline" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger rounded-pill px-4" id="verifyAndDelete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



</div>

<!-- CSS -->
<style>
    :root {
        --bs-primary: #467fcf;
        --bs-success: #28a745;
        --bs-danger: #dc3545;
        --bs-warning: #ffc107;
    }

    .hover-lift {
        transition: all 0.2s ease;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .card {
        border: 1px solid #e0e0e0;
    }

    .card-header {
        border-bottom: 1px solid #f0f0f0;
    }

    .bg-gradient-to-r {
        background: linear-gradient(90deg, #f8fafc, #f1f5f9);
    }

    .text-muted small {
        font-size: 0.875rem;
    }

    .btn-primary {
        background: linear-gradient(135deg,  #4fccbd, #467fcf);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #42b8b0 , #3d6dbb);
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .page-title {
        color: #55c7db;
    }

    /* Font Awesome */
    .fas {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }
</style>

<!-- Font Awesome -->
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<!-- JavaScript untuk Verifikasi --> --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const verifyButton = document.getElementById('verifyAndDelete');
    const passwordInput = document.getElementById('verifyPassword');
    const passwordFeedback = document.getElementById('verifyPasswordFeedback');
    
    // Sembunyikan pesan error saat pertama kali modal dimuat
    passwordFeedback.style.display = 'none';
    
    verifyButton.addEventListener('click', function() {
        const email = document.getElementById('verifyEmail').value;
        const password = passwordInput.value;
        
        // Validasi input
        if (!password) {
            passwordFeedback.textContent = 'Password must be entered';
            passwordFeedback.style.display = 'block';
            return;
        }
        
        // Kirim permintaan verifikasi ke server
        fetch('{{ route("verify.credentials") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Jika verifikasi berhasil, submit form penghapusan
                document.getElementById('deleteForm').submit();
            } else {
                // Jika verifikasi gagal, tampilkan pesan error
                passwordFeedback.textContent = 'Wrong password. Please try again.';
                passwordFeedback.style.display = 'block';
                passwordInput.value = '';
                passwordInput.focus();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            passwordFeedback.textContent = 'An error occurred. Please try again.';
            passwordFeedback.style.display = 'block';
        });
    });
    
    // Reset feedback saat modal ditutup atau input diubah
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function () {
        passwordInput.value = '';
        passwordFeedback.style.display = 'none';
    });
    
    deleteModal.addEventListener('hidden.bs.modal', function () {
        passwordInput.value = '';
        passwordFeedback.style.display = 'none';
    });
    
    passwordInput.addEventListener('input', function() {
        if (passwordFeedback.style.display === 'block') {
            passwordFeedback.style.display = 'none';
        }
    });
    
    // Tekan Enter untuk submit
    passwordInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            verifyButton.click();
        }
    });
});
</script>

<style>
/* Styling untuk modal verifikasi */
#verifyPasswordFeedback {
    color: #dc3545;
    margin-top: 0.25rem;
    font-size: 0.875rem;
}

.verification-form .form-control:focus {
    border-color: #467fcf;
    box-shadow: 0 0 0 0.2rem rgba(70, 127, 207, 0.25);
}

/* Animasi untuk modal */
.modal.fade .modal-dialog {
    transform: translate(0, -50px);
    transition: transform 0.3s ease-out;
}

.modal.show .modal-dialog {
    transform: translate(0, 0);
}

/* Styling untuk tombol */
.btn-danger {
    background: linear-gradient(135deg, #dc3545, #c82333);
    border: none;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #c82333, #a71e2a);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>
