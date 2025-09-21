<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Resident Management</h2>
                    <p class="text-muted">Manage occupant data per unit with tower filters.</p>
                </div>

                <div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <!-- Tombol Add Occupants -->
        <a href="{{ route('admin.master.residents.create') }}" class="btn btn-brand-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Add Occupants
        </a>

        <button type="button" class="btn btn-brand-outline" data-bs-toggle="modal" data-bs-target="#exportModal">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                <path d="M14 13v.01" />
                <path d="M14 16v.01" />
                <path d="M11 14.5l3 -3" />
                <path d="M11 14.5l3 3" />
            </svg>
            Export Data
        </button>
    </div>
</div>

            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <!-- Filter Tower -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-teal-lt text-white" style="background-color: #51A49A;">
                            <h3 class="card-title">Select Towers</h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @foreach($towers as $tower)
                                    <a href="javascript:void(0)" 
                                       class="list-group-item list-group-item-action tower-item" 
                                       data-tower-id="{{ $tower->id }}"
                                       style="border-color: #e6e6e6;">
                                        <strong>{{ $tower->name }}</strong>
                                        <small class="d-block text-muted">{{ $tower->units->count() }} units</small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Unit -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"  style="background-color: #51A49A;">
                            <h3 class="card-title text-white">Select Units</h3>
                        </div>
                        <!-- Di dalam card "Pilih Unit" -->
                            <input type="text" class="form-control mb-2" id="search-unit" placeholder="Cari unit..." style="display: none;">

                            <script>
                                // Di dalam fungsi .tower-item click:
                                $('#search-unit').show().on('input', function () {
                                    const q = $(this).val().toLowerCase();
                                    $('#unit-list .unit-item').each(function () {
                                        const text = $(this).text().toLowerCase();
                                        $(this).toggle(text.includes(q));
                                    });
                                });
                            </script>
                            <div id="unit-list" class="list-group list-group-flush" style="max-height: 60vh; overflow-y: auto; display: none;">
                                <!-- Unit akan diisi oleh JS -->
                            </div>
                        <div class="card-body p-0">
                            <p class="text-muted m-3" id="unit-placeholder">Select the tower first</p>
                            
                        </div>
                    </div>
                </div>

          
               <!-- Daftar Riwayat Sewa & Penghuni -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="background-color: #51A49A; padding: 0;">
                                <ul class="nav nav-tabs card-header-tabs" 
                                    data-bs-toggle="tabs" 
                                    style="margin: 0; background-color: #51A49A; border-bottom: none;">
                                    
                                    <!-- Tab Current Occupants -->
                                    <li class="nav-item" style="flex: 1; text-align: center;">
                                        <a href="#tab-residents"
                                        class="nav-link active text-white py-3 mb-0 fs-5 fw-semibold"
                                        data-bs-toggle="tab"
                                        style="border: none; border-bottom: 3px solid white !important; border-radius: 0 !important; background-color: transparent;">
                                            Current Occupants
                                        </a>
                                    </li>

                                    <!-- Tab Lease History -->
                                    <li class="nav-item" style="flex: 1; text-align: center;">
                                        <a href="#tab-history"
                                        class="nav-link text-white py-3 mb-0 fs-5"
                                        data-bs-toggle="tab"
                                        style="border: none; border-bottom: 3px solid  transparent !important; border-radius: 0 !important; background-color: transparent; opacity: 1;">
                                            Lease History
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        <div class="card-body tab-content"  >
                            <!-- Tab: Current Occupants -->
                            <div class="tab-pane active show" id="tab-residents">
                                <p class="text-muted" id="resident-placeholder">Select a unit to view current occupants</p>
                                <div id="resident-list">
                                    <!-- Penghuni aktif muncul di sini -->
                                </div>
                            </div>

                            <!-- Tab: Lease History -->
                            <div class="tab-pane" id="tab-history">
                                <p class="text-muted" id="history-placeholder">Select a unit to view lease history</p>
                                <div id="lease-history-list" >
                                    <!-- Riwayat sewa muncul di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

        <!-- Modal Export Data -->
<!-- Modal Export -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-xl rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="modal-header bg-gradient text-white py-4 position-relative">
                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-20" style="background: linear-gradient(90deg, #3498db, #2980b9);"></div>
                <h5 class="modal-title d-flex align-items-center z-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download me-2" width="24" height="24" stroke="white" fill="none">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 11l5 5l5 -5" />
                        <path d="M12 4l0 12" />
                    </svg>
                    Export Resident Data
                </h5>
                <button type="button" class="btn-close btn-close-white z-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">
                <p class="text-muted mb-4 text-center fw-light">
                    Pilih kategori penghuni yang ingin diekspor:
                </p>

                <div class="row g-3 justify-content-center">
                    <!-- All Data -->
                    <div class="col-md-6 col-lg-6">
                        <label class="form-check card card-hover border-light shadow-sm rounded-3">
                            <input type="radio" name="export_type" value="all" class="form-check-input" checked style="margin: 1rem;">
                            <div class="card-body d-flex align-items-center p-3">
                                <div class="avatar avatar-lg bg-blue-lt text-blue rounded-circle me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                </div>
                                <div>
                                    <strong class="fs-5">All Data</strong>
                                    <div class="text-muted small">Semua penghuni (owner & leasee)</div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Owner -->
                    <div class="col-md-6 col-lg-6">
                        <label class="form-check card card-hover border-light shadow-sm rounded-3">
                            <input type="radio" name="export_type" value="owner" class="form-check-input" style="margin: 1rem;">
                            <div class="card-body d-flex align-items-center p-3">
                                <div class="avatar avatar-lg bg-success-lt text-success rounded-circle me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crown" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                        <path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z" />
                                    </svg>
                                </div>
                                <div>
                                    <strong class="fs-5">Owner</strong>
                                    <div class="text-muted small">Pemilik unit (full access)</div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Leasee Active -->
                    <div class="col-md-6 col-lg-6">
                        <label class="form-check card card-hover border-light shadow-sm rounded-3">
                            <input type="radio" name="export_type" value="leasee_active" class="form-check-input" style="margin: 1rem;">
                            <div class="card-body d-flex align-items-center p-3">
                                <div class="avatar avatar-lg bg-teal-lt text-teal rounded-circle me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-check" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                        <rect x="4" y="5" width="16" height="16" rx="2" />
                                        <line x1="16" y1="3" x2="16" y2="7" />
                                        <line x1="8" y1="3" x2="8" y2="7" />
                                        <line x1="4" y1="11" x2="20" y2="11" />
                                        <path d="M15 15l3 -3" />
                                        <path d="M18 15l-3 -3" />
                                    </svg>
                                </div>
                                <div>
                                    <strong class="fs-5">Leasee (Active)</strong>
                                    <div class="text-muted small">Kontrak masih berlaku</div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Leasee Expired -->
                    <div class="col-md-6 col-lg-6">
                        <label class="form-check card card-hover border-light shadow-sm rounded-3">
                            <input type="radio" name="export_type" value="leasee_expired" class="form-check-input" style="margin: 1rem;">
                            <div class="card-body d-flex align-items-center p-3">
                                <div class="avatar avatar-lg bg-danger-lt text-danger rounded-circle me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-x" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                        <rect x="4" y="5" width="16" height="16" rx="2" />
                                        <line x1="16" y1="3" x2="16" y2="7" />
                                        <line x1="8" y1="3" x2="8" y2="7" />
                                        <line x1="4" y1="11" x2="20" y2="11" />
                                        <line x1="17" y1="17" x2="21" y2="21" />
                                        <line x1="21" y1="17" x2="17" y2="21" />
                                    </svg>
                                </div>
                                <div>
                                    <strong class="fs-5">Leasee (Expired)</strong>
                                    <div class="text-muted small">Kontrak telah berakhir</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer bg-light px-4 py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    <i class="icon icon-tabler icon-tabler-file-xls me-1"></i>
                    Format: Excel (.xlsx)
                </small>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary px-4" id="confirmExportBtn">
                        <span class="spinner-border spinner-border-sm d-none me-2" id="exportSpinner"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download me-1" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 11l5 5l5 -5" />
                            <path d="M12 4l0 12" />
                        </svg>
                        Export Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('confirmExportBtn').addEventListener('click', function () {
        const selectedType = document.querySelector('input[name="export_type"]:checked')?.value;

        if (!selectedType) {
            alert('Silakan pilih kategori export.');
            return;
        }

        const button = this;
        const spinner = document.getElementById('exportSpinner');
        const modalEl = document.getElementById('exportModal');
        const modal = bootstrap.Modal.getInstance(modalEl);

        // Aktifkan loading
        button.disabled = true;
        spinner.classList.remove('d-none');
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';

        fetch(`/export-residents?type=${selectedType}`, {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal mendapatkan data.');
            return response.blob();
        })
        .then(blob => {
            // Trigger download
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `residents_${selectedType}_${new Date().toISOString().split('T')[0]}.xlsx`;
            document.body.appendChild(a);
            a.click();
            URL.revokeObjectURL(url);
            document.body.removeChild(a);

            // 🔔 Notifikasi opsional (bisa dihapus jika tidak perlu)
            showToast(`Export ${selectedType} berhasil!`);
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Export gagal: ' + err.message);
        })
        .finally(() => {
            // Reset tombol
            button.disabled = false;
            spinner.classList.add('d-none');
            button.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download me-1" width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                    <path d="M7 11l5 5l5 -5" />
                    <path d="M12 4l0 12" />
                </svg>
                Export Sekarang
            `;

            // ✅ Tutup modal
            if (modal) {
                modal.hide();
            } else {
                new bootstrap.Modal(modalEl).hide();
            }

            // ✅ Hapus backdrop jika masih ada
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            document.body.classList.remove('modal-open');

            // 🚀🚀🚀 RELOAD HALAMAN SETELAH DOWNLOAD
            setTimeout(() => {
                window.location.reload();
            }, 500); // Delay kecil agar download benar-benar tercatat
        });

        function showToast(message) {
            const toastEl = document.getElementById('exportToast');
            if (toastEl) {
                document.getElementById('toastMessage').textContent = message;
                const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }
        }
    });
</script>

<style>
        .card-hover {
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .transition-transform {
        transition: transform 0.2s ease;
    }

    .hover-scale {
        transition: transform 0.2s ease;
    }

    .hover-scale:hover {
        transform: scale(1.02);
    }

    .bg-gradient-primary {
        background: linear-gradient(90deg, #2980b9, #3498db);
    }
</style>

<!-- Custom Styles -->
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
    .list-group-item {
        border-radius: 8px !important;
        margin-bottom: 6px;
        padding: 12px 16px;
        transition: all 0.2s ease;
    }
    .list-group-item:hover {
        background-color: #f7f9fb;
        border-color: #51A49A;
        color: #51A49A;
    }
    .badge {
        font-size: 0.75rem;
        padding: 4px 8px;
    }
    .action-btn {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }
    .card-header.bg-teal-lt {
        background-color: #51A49A !important;
        color: white !important;
    }
    #resident-list .border-bottom {
        border-bottom: 1px solid #eee !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {
    // Data dari backend
    const allResidents = @json($residents);

    // Struktur unit per tower
    const unitsByTower = {};
    @foreach($towers as $tower)
        unitsByTower[{{ $tower->id }}] = [
            @foreach($tower->units as $unit)
                {
                    id: {{ $unit->id }},
                    code: "{{ $unit->unit_code }}",
                    floor: "{{ $unit->floor->name ?? 'N/A' }}"
                },
            @endforeach
        ];
    @endforeach

    $('.tower-item').on('click', function () {
        const towerId = $(this).data('tower-id');
        const units = unitsByTower[towerId] || [];
        const unitList = $('#unit-list');
        const residentList = $('#resident-list');
        const historyList = $('#lease-history-list');

        // Reset tampilan
        unitList.hide().empty();
        residentList.empty();
        historyList.empty();
        $('#resident-placeholder').text('Select a unit to view the residents');
        $('#history-placeholder').text('');

        if (units.length === 0) {
            $('#unit-placeholder').text('There are no units in this tower.');
            return;
        }

        $('#unit-placeholder').text('Select units:');
        unitList.show();

        // Tampilkan daftar unit
        units.forEach(unit => {
            const today = new Date().toISOString().split('T')[0];
            const activeResidentCount = allResidents.filter(r => {
                const unitInfo = r.units.find(u => u.id == unit.id);
                if (!unitInfo) return false;

                if (r.is_owner) return true; // Owner selalu aktif
                if (!['Leasee', 'Co-Leasee'].includes(unitInfo.role)) return false;
                const endDate = unitInfo.end_date;
                return endDate && endDate >= today;
            }).length;

            // Hitung jumlah penghuni tidak aktif (leasee dengan end_date < hari ini)
                    const inactiveResidentCount = allResidents.filter(r => {
                        const unitInfo = r.units.find(u => u.id == unit.id);
                        if (!unitInfo) return false;

                        // Hanya Leasee/Co-Leasee yang dicek masa sewanya
                        if (!['Leasee', 'Co-Leasee'].includes(unitInfo.role)) return false;

                        const endDate = unitInfo.end_date;
                        return endDate && new Date(endDate) < new Date(); // Sudah lewat
                    }).length;

                    // Buat teks info penghuni
                    let statusText = `Floor: ${unit.floor}`;
                    if (activeResidentCount > 0) {
                        statusText += ` • <span class="text-success">${activeResidentCount}</span> active`;
                    }
                    if (inactiveResidentCount > 0) {
                        statusText += ` • <span class="text-danger">${inactiveResidentCount}</span> expired`;
                    }
                    if (activeResidentCount === 0 && inactiveResidentCount === 0) {
                        statusText += ` • no occupants`;
                    }

                    const unitItem = `
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action unit-item" data-unit-id="${unit.id}">
                            <strong>${unit.code}</strong>
                            <small class="d-block text-muted" style="line-height: 1.4;">
                                ${statusText}
                            </small>
                        </a>
                    `;
                                unitList.append(unitItem);
        });

        // Event handler untuk klik unit
        $(document).off('click', '.unit-item').on('click', '.unit-item', function () {
            const unitId = $(this).data('unit-id');
            const today = new Date().toISOString().split('T')[0];

            // --- 1. Tampilkan Penghuni Aktif ---
            const filteredResidents = allResidents.filter(r => {
                const unitInfo = r.units.find(u => u.id == unitId);
                if (!unitInfo) return false;

                if (r.is_owner) return true;
                if (!['Leasee', 'Co-Leasee'].includes(unitInfo.role)) return false;
                const endDate = unitInfo.end_date;
                return endDate && endDate >= today;
            });

            residentList.empty();
            $('#resident-placeholder').text('');

            if (filteredResidents.length === 0) {
                $('#resident-placeholder').text('No active occupants in this unit.');
            } else {
                filteredResidents.forEach(r => {
                    const unitInfo = r.units.find(u => u.id == unitId);
                    const unitLabel = unitInfo ? `${unitInfo.unit_code} (${unitInfo.tower_name})` : '-';
                    const statusBadge = `<span class="badge bg-${r.is_owner ? 'green' : 'blue'}-lt">${r.is_owner ? 'Owner' : 'Leasee'}</span>`;

                    const actions = `
                        <div class="btn-list d-flex gap-1 flex-wrap mt-2">
                            <a href="/admin/master/residents/${r.id}" class="btn btn-sm btn-outline-info action-btn">Detail</a>
                            <a href="/admin/master/residents/${r.id}/edit" class="btn btn-sm btn-outline-primary action-btn">Edit</a>
                            <form action="/admin/master/residents/${r.id}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger action-btn" onclick="return confirm('Hapus penghuni?')">Hapus</button>
                            </form>
                        </div>
                    `;

                    residentList.append(`
                        <div class="border-bottom pb-3 mb-3">
                            <h4 class="h5 mb-1">${r.full_name}</h4>
                            <small><strong>Email:</strong> ${r.email || '-'}</small><br>
                            <small><strong>HP:</strong> ${r.phone || '-'}</small><br>
                            <small><strong>Status:</strong></small> ${statusBadge}<br>
                            <small><strong>Unit:</strong> ${unitLabel}</small><br>
                            <div class="mt-2">${actions}</div>
                        </div>
                    `);
                });
            }

            // --- 2. Tampilkan Lease History ---
            loadLeaseHistory(unitId);
        });
    });

    function loadLeaseHistory(unitId) {
    const historyList = $('#lease-history-list');
    historyList.empty();
    $('#history-placeholder').text('');

    let histories = [];

    allResidents.forEach(r => {
        r.units.forEach(u => {
            if (u.id == unitId && ['Leasee', 'Co-Leasee'].includes(u.role)) {
                const endDate = u.end_date;
                if (endDate && new Date(endDate) < new Date()) {
                    histories.push({
                        resident_id: r.id,
                        resident_name: r.full_name,
                        start_date: u.start_date,
                        end_date: endDate,
                        role: u.role
                    });
                }
            }
        });
    });

    // Urutkan dari terbaru
    histories.sort((a, b) => new Date(b.end_date) - new Date(a.end_date));

    if (histories.length === 0) {
        historyList.append(`
            <div class="text-center text-muted p-3 border rounded">
                No lease history found for this unit.
            </div>
        `);
        return;
    }

    histories.forEach(h => {
        const startDate = formatDate(h.start_date);
        const endDate = formatDate(h.end_date);

        historyList.append(`
            <div class="border-bottom pb-3 mb-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="h6 mb-1">${h.resident_name}</h4>
                        <small><strong>Role:</strong> ${h.role}</small><br>
                        <small><strong>Period:</strong> ${startDate} → ${endDate}</small>
                    </div>
                    <div>
                        <a href="/admin/master/residents/${h.resident_id}" 
                           class="btn btn-sm btn-outline-info action-btn mt-1"
                           title="View Resident Details">
                            Detail
                        </a>
                    </div>
                </div>
                <small class="text-muted">Lease expired</small>
            </div>
        `);
    });
}

    // Helper: Format tanggal
    function formatDate(dateStr) {
        if (!dateStr) return '-';
        const [y, m, d] = dateStr.split('-');
        return new Date(y, m - 1, d).toLocaleDateString('en-US', { 
            day: '2-digit', 
            month: 'short', 
            year: 'numeric' 
        });
    }
});
</script>