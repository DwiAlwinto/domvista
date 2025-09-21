<div class="page-wrapper">
    <!-- Page Header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-lg me-3 bg-green-lt">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"/>
                                <path d="M13 8l2 0"/>
                                <path d="M13 12l2 0"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="page-title" style="color: #51A49A;">Digital Logbooks</h2>
                            <div class="text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"/>
                                    <path d="M12 7v5l3 3"/>
                                </svg>
                                <span id="current-time"></span>
                            </div>
                        </div>
                    </div>
                </div>

               <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <!-- Date Picker -->
                        <div class="input-icon">
                            <input type="date" name="date" class="form-control" id="search-date" 
                                value="{{ request('date', \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d')) }}">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                                    <path d="M16 3v4"/>
                                    <path d="M8 3v4"/>
                                    <path d="M4 11h16"/>
                                    <path d="M11 15h1"/>
                                    <path d="M12 15v3"/>
                                </svg>
                            </span>
                           
                        </div>

                        <!-- Status Filter -->
                        <select name="status" class="form-select" id="status-filter" style="width: 150px;">
                            <option value="">All Status</option>
                            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="On Progress" {{ request('status') == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                        </select>

                      {{-- Alwin1996: --}}
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">
    <div class="container-xl">
        <div class="card card-borderless shadow-none">
            <div class="card-header bg-transparent">
                <div class="card-title">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="avatar avatar-sm rounded bg-green-lt">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"/>
                                </svg>
                            </span>
                        </div>
                        <div>
                            <h3 class="m-0" style="color: #51A49A;">
                                @if(request()->hasAny(['search', 'date', 'status']))
                                    Filtered Logbooks
                                @else
                                    Today's Logbooks
                                @endif
                            </h3>
                            <div class="text-muted small" style="color: #51A49A;">
                                @if(request()->hasAny(['search', 'date', 'status']))
                                    Showing filtered results
                                @else
                                    {{ \Carbon\Carbon::today('Asia/Jakarta')->format('l, F j, Y') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-actions">
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 6h16"/>
                                <path d="M4 12h16"/>
                                <path d="M4 18h16"/>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item">Refresh Data</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive rounded-3 border-0">
                    <table class="table table-hover table-nowrap table-mobile-md card-table">
                        <thead>
                            <tr class="bg-light">
                                <th class="w-1 ps-4">No</th>
                                <th>Logbook Details</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logbooks as $item)
                                <tr class="border-bottom">
                                    <td class="ps-4 text-muted">
                                        {{ ($logbooks->currentPage() - 1) * $logbooks->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <span class="avatar avatar-sm rounded bg-blue-lt">
                                                    #{{ $loop->iteration }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-bold">#{{ $item->logbook_number }}</div>
                                                <div class="text-muted small">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock me-1" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"/>
                                                        <path d="M12 7v5l3 3"/>
                                                    </svg>
                                                    <!-- Menampilkan waktu dalam WIB -->
                                                    Created on 
                                                    <strong>
                                                        {{ $item->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                                    </strong>
                                                    ({{ $item->created_at->timezone('Asia/Jakarta')->diffForHumans() }})
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'Completed')
                                            <span class="badge bg-green-lt text-green d-inline-flex align-items-center py-1 px-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                                                    <path d="M9 12l2 2l4 -4"/>
                                                </svg>
                                                Completed
                                            </span>
                                        @else
                                            <span class="badge bg-orange-lt text-orange d-inline-flex align-items-center py-1 px-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-progress me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969"/>
                                                    <path d="M14 3.223a9.003 9.003 0 0 1 0 17.554"/>
                                                    <path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592"/>
                                                    <path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305"/>
                                                    <path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356"/>
                                                </svg>
                                                On Progress
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4">
                                        <div class="btn-list justify-content-end">
                                            <a href="{{ route('admin.logbook.show', $item->id) }}" class="btn btn-sm btn-ghost-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.logbook.edit', $item->id) }}" class="btn btn-sm btn-ghost-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                                    <path d="M16 5l3 3"/>
                                                </svg>
                                            </a>
                                            {{-- Hapus atau aktifkan tombol delete nanti --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="empty">
                                            <div class="empty-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notebook-off" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#adb5bd" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M8 4h9a2 2 0 0 1 2 2v9m-.179 3.828a2 2 0 0 1 -1.821 1.172h-11a1 1 0 0 1 -1 -1v-14m4 -1v1m0 4v13"/>
                                                    <path d="M13 8h2"/>
                                                    <path d="M3 3l18 18"/>
                                                </svg>
                                            </div>
                                            <p class="empty-title">
                                                @if(request()->hasAny(['search', 'date', 'status']))
                                                    No logbooks match your filters
                                                @else
                                                    No logbooks created today
                                                @endif
                                            </p>
                                            <p class="empty-subtitle text-muted">
                                                Try adjusting your search or create a new logbook
                                            </p>
                                            <div class="empty-action">
                                                <a href="{{ route('admin.logbook.create') }}" class="btn" style="background-color: #51A49A; color: #fff;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 5l0 14"/>
                                                        <path d="M5 12l14 0"/>
                                                    </svg>
                                                    Create new logbook
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        <!-- Form delete tersembunyi -->
                        <form id="deleteForm" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </table>
                </div>

                <!-- Pagination -->
                @if($logbooks->hasPages())
                    <div class="card-footer d-flex align-items-center bg-transparent">
                        <div class="d-flex align-items-center">
                            <span class="text-muted me-3">
                                Showing {{ $logbooks->firstItem() }} - {{ $logbooks->lastItem() }} of {{ $logbooks->total() }}
                            </span>
                            <div class="btn-group">
                                <a href="{{ $logbooks->previousPageUrl() }}" class="btn btn-sm btn-ghost-secondary {{ $logbooks->onFirstPage() ? 'disabled' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M15 6l-6 6l6 6"/>
                                    </svg>
                                    Prev
                                </a>
                                <a href="{{ $logbooks->nextPageUrl() }}" class="btn btn-sm btn-ghost-secondary {{ !$logbooks->hasMorePages() ? 'disabled' : '' }}">
                                    Next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 6l6 6l-6 6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="ms-auto">
                            <select class="form-select form-select-sm" style="width: 80px;">
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk update jam WIB
function updateClock() {
    const timeElement = document.getElementById('current-time');
    if (!timeElement) return; // Hentikan jika elemen tidak ada

    const now = new Date();
    const options = {
        timeZone: 'Asia/Jakarta',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false // Format 24 jam
    };

    timeElement.textContent = now.toLocaleTimeString('id-ID', options);
}

// Jalankan saat DOM selesai dimuat
document.addEventListener('DOMContentLoaded', () => {
    updateClock(); // Update sekali saat load
    setInterval(updateClock, 1000); // Update tiap detik
});
</script>
    <!-- Pindahkan ini ke bagian bawah sebelum penutup page-wrapper -->
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
                    <i class="ti ti-check me-2"></i>Verify & Delete
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Pindahkan ini ke bagian bawah sebelum penutup page-wrapper -->
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
                    <i class="ti ti-check me-2"></i>Verify & Delete
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

@push('styles')
<style>
    .card-borderless {
        border: none;
        box-shadow: 0 0.125rem 0.375rem rgba(0, 0, 0, 0.05);
    }
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(46, 204, 113, 0.05) !important;
    }
    .clear-search, .clear-date {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #adb5bd;
        z-index: 10;
    }
    .clear-search:hover, .clear-date:hover {
        color: #495057;
    }
    .input-icon .clear-search {
        right: 35px;
    }
    .badge {
        padding: 0.35rem 0.65rem;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .btn-ghost-primary {
        color: #2e86de;
        background-color: transparent;
    }
    .btn-ghost-primary:hover {
        background-color: rgba(46, 134, 222, 0.1);
    }
    .btn-ghost-success {
        color: #26de81;
        background-color: transparent;
    }
    .btn-ghost-success:hover {
        background-color: rgba(38, 222, 129, 0.1);
    }
    .btn-ghost-danger {
        color: #fc5c65;
        background-color: transparent;
    }
    .btn-ghost-danger:hover {
        background-color: rgba(252, 92, 101, 0.1);
    }
    .btn-ghost-secondary {
        color: #778ca3;
        background-color: transparent;
    }
    .btn-ghost-secondary:hover {
        background-color: rgba(119, 140, 163, 0.1);
    }
    .empty {
        padding: 2rem 0;
    }
    .empty-icon {
        opacity: 0.5;
    }
    @media (max-width: 767.98px) {
        .page-header .col-auto {
            width: 100%;
            margin-top: 1rem;
        }
        .page-header .input-group {
            width: 100%;
        }
        .page-header .form-select {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Update current time
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = now.toLocaleTimeString();
    }
    updateTime();
    setInterval(updateTime, 1000);

    // Filter elements
    const searchText = document.getElementById('search-text');
    const searchDate = document.getElementById('search-date');
    const statusFilter = document.getElementById('status-filter');
    
    // Submit form function
    function submitFilters() {
        const params = new URLSearchParams();
        
        if (searchText && searchText.value) {
            params.append('search', searchText.value);
        }
        
        if (searchDate && searchDate.value) {
            params.append('date', searchDate.value);
        }
        
        if (statusFilter && statusFilter.value) {
            params.append('status', statusFilter.value);
        }
        
        window.location.href = `${window.location.pathname}?${params.toString()}`;
    }

    // Event listeners
    if (searchDate) {
        searchDate.addEventListener('change', submitFilters);
    }
    
    if (statusFilter) {
        statusFilter.addEventListener('change', submitFilters);
    }
    
    if (searchText) {
        searchText.addEventListener('input', function() {
            clearTimeout(this.searchTimer);
            this.searchTimer = setTimeout(submitFilters, 500);
        });
    }

    // Clear functions
    window.clearSearch = function() {
        if (searchText) {
            searchText.value = '';
            submitFilters();
        }
    }

    window.clearDate = function() {
        if (searchDate) {
            searchDate.value = '';
            submitFilters();
        }
    }

    // Items per page selector
    const perPageSelect = document.querySelector('.form-select-sm');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            const params = new URLSearchParams(window.location.search);
            params.set('per_page', this.value);
            window.location.href = `${window.location.pathname}?${params.toString()}`;
        });
    }
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
    const verifyEmail = document.getElementById('verifyEmail');
    const verifyPassword = document.getElementById('verifyPassword');
    const confirmVerification = document.getElementById('confirmVerification');
    const verificationError = document.getElementById('verificationError');
    const errorMessage = document.getElementById('errorMessage');
    const deleteForm = document.getElementById('deleteForm');
    
    let currentUrl = null;

    // Set email pengguna yang login
    verifyEmail.value = "{{ auth()->user()->email }}";

    // Handle delete button
    document.querySelectorAll('.delete-button').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
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
                // Verifikasi berhasil, lakukan delete
                verificationModal.hide();
                deleteForm.action = currentUrl;
                deleteForm.submit();
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
            : '<i class="ti ti-check me-2"></i>Verify & Delete';
    }

    // Reset modal ketika ditutup
    verificationModal._element.addEventListener('hidden.bs.modal', function() {
        verificationError.classList.add('d-none');
        verifyPassword.value = '';
        currentUrl = null;
    });
});
</script>

@endpush