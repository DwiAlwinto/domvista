
   <div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="dashboard-header">
            <div class="container-xl">
            <div class="row align-items-center mb-4">
            <!-- Kolom Kiri: Judul -->
            <div class="col-md-6 col-lg-7 col-sm-12">
                <h1 class="page-title mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                        <path d="M9 3h6v4h-6z" />
                        <path d="M9 12l2 0" />
                        <path d="M9 16l4 0" />
                    </svg>
                    WORK ORDER MONITORING
                </h1>
                <p class="text-muted mb-0 mt-1">Total {{ $workOrders->total() }} Work Orders</p>
            </div>

           <div class="col-md-6 col-lg-5 col-sm-12 d-flex justify-content-end align-items-center gap-3">
    <!-- Add Work Order Button -->
    <a href="{{ route('admin.wo.create') }}" 
       class="btn btn-primary d-flex align-items-center px-3 py-2"
       style="background-color: #51A49A; border-color: #51A49A; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;"
       title="Add New Work Order">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 5v14" />
            <path d="M5 12h14" />
        </svg>
        <span class="fw-semibold">Add Work Order</span>
    </a>

    <!-- Export to Excel Button -->
    <button onclick="openExportModal()"
            class="btn btn-success d-flex align-items-center px-3 py-2"
            style="background-color: #51A49A; border-color: #51A49A; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;"
            title="Export Work Orders to Excel">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
            <path d="M12 11v6" />
            <path d="M9 14l3 -3l3 3" />
        </svg>
        <span class="fw-semibold">Export Excel</span>
    </button>

    <!-- View Toggle Buttons -->
    <div class="btn-group btn-group-sm" role="group" style="border-radius: 8px; overflow: hidden;">
        <button type="button" 
                class="btn btn-white px-3 py-2 view-toggle active" 
                data-view="horizontal" 
                title="Grid View"
                style="border-right: 1px solid #dee2e6; transition: all 0.2s ease;">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-grid" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>
        </button>
        <button type="button" 
                class="btn btn-white px-3 py-2 view-toggle" 
                data-view="vertical" 
                title="List View"
                style="transition: all 0.2s ease;">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="9" y1="6" x2="20" y2="6" />
                <line x1="9" y1="12" x2="20" y2="12" />
                <line x1="9" y1="18" x2="20" y2="18" />
                <line x1="5" y1="6" x2="5" y2="6.01" />
                <line x1="5" y1="12" x2="5" y2="12.01" />
                <line x1="5" y1="18" x2="5" y2="18.01" />
            </svg>
        </button>
    </div>
</div>

            
                </div>
        </div>

        <div class="container-xl py-6">

            <!-- Horizontal Cards View -->
            <div class="horizontal-cards mb-4" id="horizontalView">
                <!-- On Progress & Reschedule Card -->
                <div class="horizontal-card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0">On Progress & Reschedule</h3>
                            <a href="#"
                                class="btn btn-icon btn-sm ms-2 text-success hover-shadow"
                                style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;"
                                onclick="sendToWhatsApp(event)"
                                title="Send to WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="hover-grow">
                                        <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-.7 3.9" />
                                        <path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" />
                                    </svg>
                            </a>
                        </div>
                             <span class="badge badge-progress">{{ $workOrders->whereIn('status', ['On Progress', 'Reschedule'])->count() }}</span>
                    </div>
                    <div class="card-body">
                        @forelse($workOrders->whereIn('status', ['On Progress', 'Reschedule']) as $wo)
                        <div class="wo-item" style="border-left-color: var(--blue);">
                            <div class="wo-priority priority-high"></div>
                            <div class="wo-number">
                                <span>{{ $wo->wo_no }}</span>
                                <span class="status-badge badge-progress">{{ $wo->status }}</span>
                            </div>
                            <div class="wo-desc" 
                                data-full-description="{{ $wo->work_description }}">
                                {{ Str::limit($wo->work_description, 60) }}
                            </div>
                            <div class="wo-meta">
                                <div><i class="bi bi-building me-1"></i> {{ $wo->tower->name ?? '-' }} • {{ $wo->unit->unit_code ?? '-' }}</div>
                                <div class="wo-date">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $wo->schedule_date->format('M d, Y') }}
                                    @if($wo->time_schedule)
                                    • {{ \Carbon\Carbon::parse($wo->time_schedule)->format('H:i') }}
                                    @endif
                                </div>
                            </div>
                            <div class="wo-actions">
                                <div class="wo-assignee">
                                    <small><i class="bi bi-person me-1"></i> {{ $wo->assignee ?? 'Unassigned' }}</small>
                                </div>
                                <a href="{{ route('admin.wo.show', $wo->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <p>No work orders in progress</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                

                <!-- Proses Card -->
                <div class="horizontal-card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="card-header-icon icon-proses">
                                <i class="bi bi-gear"></i>
                            </div>
                            <h3 class="mb-0">In Process</h3>
                        </div>
                        <span class="badge badge-proses">{{ $workOrders->where('status', 'Proses')->count() }}</span>
                    </div>
                    <div class="card-body">
                        @forelse($workOrders->where('status', 'Proses') as $wo)
                        <div class="wo-item" style="border-left-color: var(--info);">
                            <div class="wo-priority priority-medium"></div>
                            <div class="wo-number">
                                <span>{{ $wo->wo_no }}</span>
                                <span class="status-badge badge-proses">{{ $wo->status }}</span>
                            </div>
                            <div class="wo-desc">{{ Str::limit($wo->work_description, 60) }}</div>
                            <div class="wo-meta">
                                <div><i class="bi bi-building me-1"></i> {{ $wo->tower->name ?? '-' }} • {{ $wo->unit->unit_code ?? '-' }}</div>
                                <div class="wo-date">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $wo->schedule_date->format('M d, Y') }}
                                    @if($wo->time_schedule)
                                    • {{ \Carbon\Carbon::parse($wo->time_schedule)->format('H:i') }}
                                    @endif
                                </div>
                            </div>
                            <div class="wo-actions">
                                <div class="wo-assignee">
                                    <small><i class="bi bi-person me-1"></i> {{ $wo->assignee ?? 'Unassigned' }}</small>
                                </div>
                                <a href="{{ route('admin.wo.show', $wo->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <p>No work orders in process</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Done Card -->
                <div class="horizontal-card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="card-header-icon icon-done">
                                <i class="bi bi-check2-circle"></i>
                            </div>
                            <h3 class="mb-0">Completed</h3>
                        </div>
                        <span class="badge badge-done">{{ $workOrders->where('status', 'Done')->count() }}</span>
                    </div>
                    <div class="card-body">
                        @forelse($workOrders->where('status', 'Done') as $wo)
                        <div class="wo-item" style="border-left-color: var(--success);">
                            <div class="wo-priority priority-low"></div>
                            <div class="wo-number">
                                <span>{{ $wo->wo_no }}</span>
                                <span class="status-badge badge-done">{{ $wo->status }}</span>
                            </div>
                            <div class="wo-desc">{{ Str::limit($wo->work_description, 60) }}</div>
                            <div class="wo-meta">
                                <div><i class="bi bi-building me-1"></i> {{ $wo->tower->name ?? '-' }} • {{ $wo->unit->unit_code ?? '-' }}</div>
                                <div class="wo-date">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $wo->schedule_date->format('M d, Y') }}
                                    @if($wo->time_schedule)
                                    • {{ \Carbon\Carbon::parse($wo->time_schedule)->format('H:i') }}
                                    @endif
                                </div>
                            </div>
                            <div class="wo-actions">
                                <div class="wo-assignee">
                                    <small><i class="bi bi-person me-1"></i> {{ $wo->assignee ?? 'Unassigned' }}</small>
                                </div>
                                <a href="{{ route('admin.wo.show', $wo->id) }}" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <p>No completed work orders</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Cancel Card -->
                <div class="horizontal-card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="card-header-icon icon-cancel">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <h3 class="mb-0">Canceled</h3>
                        </div>
                        <span class="badge badge-cancel">{{ $workOrders->where('status', 'Cancel')->count() }}</span>
                    </div>
                    <div class="card-body">
                        @forelse($workOrders->where('status', 'Cancel') as $wo)
                        <div class="wo-item" style="border-left-color: var(--danger);">
                            <div class="wo-priority"></div>
                            <div class="wo-number">
                                <span>{{ $wo->wo_no }}</span>
                                <span class="status-badge badge-cancel">{{ $wo->status }}</span>
                            </div>
                            <div class="wo-desc">{{ Str::limit($wo->work_description, 60) }}</div>
                            <div class="wo-meta">
                                <div><i class="bi bi-building me-1"></i> {{ $wo->tower->name ?? '-' }} • {{ $wo->unit->unit_code ?? '-' }}</div>
                                <div class="wo-date">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $wo->schedule_date->format('M d, Y') }}
                                    @if($wo->time_schedule)
                                    • {{ \Carbon\Carbon::parse($wo->time_schedule)->format('H:i') }}
                                    @endif
                                </div>
                            </div>
                            <div class="wo-actions">
                                <div class="wo-assignee">
                                    <small><i class="bi bi-person me-1"></i> {{ $wo->assignee ?? 'Unassigned' }}</small>
                                </div>
                                <a href="{{ route('admin.wo.show', $wo->id) }}" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <p>No canceled work orders</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Vertical View (Hidden by default) -->
            <div class="d-none" id="verticalView">
                <!-- This would be the accordion view from the original code -->
                <!-- Implementation would go here -->
            </div>
        </div>
    </div>
    </div>

     <!-- Modal Konfirmasi Export -->
                    <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                                <!-- Header -->
                                <div class="modal-header bg-gradient-primary text-white" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                    <h5 class="modal-title d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M14 3v4a1 1 0 0 1 -1 1h-4" />
                                            <path d="M5 12l2 0" />
                                            <path d="M17 12l2 0" />
                                            <path d="M5 16l2 0" />
                                            <path d="M17 16l2 0" />
                                            <path d="M12 16v4" />
                                            <path d="M9 20h6" />
                                            <path d="M9 4h6" />
                                        </svg>
                                        Konfirmasi Export
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Body -->
                                <div class="modal-body text-center py-5">
                                    <div class="avatar avatar-lg bg-blue-lt mb-3 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="32" height="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M16 3l0 4" />
                                            <path d="M8 3l0 4" />
                                            <path d="M4 11h16" />
                                            <path d="M8 15h2v2h-2z" />
                                        </svg>
                                    </div>
                                    <p class="lead mb-2">Pilih tanggal untuk ekspor data WO</p>
                                    <div class="form-group">
                                        <label for="exportDateInput" class="visually-hidden">Tanggal</label>
                                        <input type="date" 
                                            id="exportDateInput" 
                                            class="form-control form-control-lg text-center"
                                            value="{{ now()->format('Y-m-d') }}"
                                            style="font-size: 1.1rem;">
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="modal-footer justify-content-center border-0 pb-4">
                                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-primary px-4" onclick="confirmExport()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                            <path d="M7 11l5 5l5 -5" />
                                            <path d="M12 4l0 12" />
                                        </svg>
                                        Ekspor Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

 <style>
        :root {
            --primary-color: #51A49A;
            --primary-dark: #438a80;
            --primary-light: #e0f2f0;
            --secondary-color: #2f3e4e;
            --secondary-light: #f5f7f9;
            --blue: #467fcf;
            --blue-light: #e8f0fe;
            --info: #17a2b8;
            --info-light: #e6f7fa;
            --success: #28a745;
            --success-light: #e9f7ef;
            --danger: #dc3545;
            --danger-light: #fce8e8;
            --warning: #ffc107;
            --warning-light: #fff8e1;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 12px 30px rgba(228, 13, 156, 0.15);
            --card-radius: 16px;
        }
        
        .page-title {
            font-weight: 800;
            color: var(--primary-color);
            font-size: 1.1rem;
            letter-spacing: -0.5px;
            margin-top: 0.5rem;
        }
        
        /* Enhanced Stats Cards */
        .stats-card {
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            border: none;
            transition: all 0.3s ease;
            height: 100%;
            background: white;
            position: relative;
            overflow: hidden;
        }
        
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        
        .stats-card .card-body {
            padding: 1.75rem;
            position: relative;
        }
        
        .stats-icon {
            width: 65px;
            height: 65px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .stats-number {
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.25rem;
            color: var(--secondary-color);
        }
        
        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .stats-trend {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .trend-up {
            color: var(--success);
        }
        
        .trend-down {
            color: var(--danger);
        }
        
        /* Enhanced Status Badges */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        /* Enhanced Horizontal Cards */
        .horizontal-cards {
            display: flex;
            overflow-x: auto;
            gap: 1.5rem;
            padding: 0.75rem 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #c1c1c1 transparent;
        }
        
        .horizontal-cards::-webkit-scrollbar {
            height: 8px;
        }
        
        .horizontal-cards::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        .horizontal-card {
            min-width: 300px;
            flex: 1;
            border-radius: var(--card-radius);
            box-shadow: var(--card-shadow);
            background: white;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
        }
        
        .horizontal-card:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-3px);
        }
        
        .horizontal-card .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .horizontal-card .card-header h3 {
            font-weight: 900;
            display: flex;
            align-items: center;
            color: #0ca3ad;
        }
        
        .horizontal-card .card-body {
            padding: 1.5rem;
            max-height: 700px;
            overflow-y: auto;
            background: var(--secondary-light);
        }
        
        /* Enhanced Work Order Items */
        .wo-item {
            border-left: 4px solid transparent;
            padding: 1.25rem;
            margin-bottom: 1rem;
            border-radius: 12px;
            background: white;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            position: relative;
        }
        
        .wo-item:hover {
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transform: translateX(3px);
        }
        
        .wo-priority {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        
        .priority-high {
            background-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
        }
        
        .priority-medium {
            background-color: var(--warning);
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
        }
        
        .priority-low {
            background-color: var(--success);
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
        }
        
        .wo-number {
            font-weight: 800;
            color: var(--secondary-color);
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .wo-desc {
            font-size: 0.9rem;
            color: #6c757d;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.75rem;
            line-height: 1.5;
        }
        
        .wo-meta {
            font-size: 0.85rem;
            color: #8c8c8c;
            margin-bottom: 1rem;
        }
        
        .wo-meta div {
            margin-bottom: 0.25rem;
        }
        
        .wo-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .wo-date {
            font-size: 0.8rem;
            color: #a0a0a0;
            display: flex;
            align-items: center;
        }
        
        .empty-state {
            padding: 2.5rem 1rem;
            text-align: center;
            color: #6c757d;
        }
        
        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.4;
        }
        
        .empty-state p {
            margin-bottom: 0;
            font-weight: 500;
        }
        
        /* Enhanced Filter Bar */
        .filter-bar {
            background: white;
            border-radius: var(--card-radius);
            padding: 1.25rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }
        
        .view-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .view-toggle {
            padding: 0.6rem;
            border-radius: 10px;
            background: white;
            border: 1px solid #dee2e6;
            color: #6c757d;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .view-toggle.active, .view-toggle:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 3px 8px rgba(81, 164, 154, 0.3);
        }
        
        /* Enhanced Button */
        .btn-primary-custom {
            background: var(--primary-color);
            border: none;
            color: white;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(81, 164, 154, 0.25);
        }
        
        .btn-primary-custom:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(81, 164, 154, 0.35);
            color: white;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .horizontal-card {
                min-width: 85%;
            }
            
            .stats-number {
                font-size: 1.8rem;
            }
            
            .wo-item {
                padding: 1rem;
            }
        }
        
        /* Custom colors for statuses */
        .bg-progress {
            background: linear-gradient(135deg, var(--blue) 0%, #2c5aa0 100%);
        }
        
        .bg-proses {
            background: linear-gradient(135deg, var(--info) 0%, #128293 100%);
        }
        
        .bg-done {
            background: linear-gradient(135deg, var(--success) 0%, #1e7e34 100%);
        }
        
        .bg-cancel {
            background: linear-gradient(135deg, var(--danger) 0%, #c0392b 100%);
        }
        
        .text-progress {
            color: var(--blue);
        }
        
        .text-proses {
            color: var(--info);
        }
        
        .text-done {
            color: var(--success);
        }
        
        .text-cancel {
            color: var(--danger);
        }
        
        .badge-progress {
            background-color: var(--blue-light);
            color: var(--blue);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.7rem;
        }
        
        .badge-proses {
            background-color: var(--info-light);
            color: var(--info);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.7rem;
        }
        
        .badge-done {
            background-color: var(--success-light);
            color: var(--success);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.7rem;
        }
        
        .badge-cancel {
            background-color: var(--danger-light);
            color: var(--danger);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.7rem;
        }
        
        /* Card header icons */
        .card-header-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }
        
        .icon-progress {
            background-color: var(--blue-light);
            color: var(--blue);
        }
        
        .icon-proses {
            background-color: var(--info-light);
            color: var(--info);
        }
        
        .icon-done {
            background-color: var(--success-light);
            color: var(--success);
        }
        
        .icon-cancel {
            background-color: var(--danger-light);
            color: var(--danger);
        }
        
        /* Animation for cards */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .horizontal-card {
            animation: fadeIn 0.4s ease-out;
        }
        
        .wo-item {
            animation: fadeIn 0.3s ease-out;
        }
</style>


   
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // View toggle functionality
            const viewToggles = document.querySelectorAll('.view-toggle');
            const horizontalView = document.getElementById('horizontalView');
            const verticalView = document.getElementById('verticalView');
            
            viewToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const viewType = this.getAttribute('data-view');
                    
                    // Update active state
                    viewToggles.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show/hide views
                    if (viewType === 'horizontal') {
                        horizontalView.classList.remove('d-none');
                        verticalView.classList.add('d-none');
                    } else {
                        horizontalView.classList.add('d-none');
                        verticalView.classList.remove('d-none');
                    }
                });
            });
            
            // Add hover effects to cards programmatically
            const cards = document.querySelectorAll('.horizontal-card, .wo-item');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = this.classList.contains('wo-item') ? 'translateX(5px)' : 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>

<script>
        function sendToWhatsApp(event) {
            event.preventDefault();

            // Ambil semua Work Order dengan status "On Progress" atau "Reschedule"
            const woItems = document.querySelectorAll('.horizontal-card:first-child .wo-item');

            let message = `🚨 *WORK ORDER ALERT: ON PROGRESS & RESCHEDULE* 🚨\n\n`;

            // Tambahkan info WO untuk hari ini
            const today = new Date();
            const todayFormatted = today.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            message += `📅 *Work Order Hari Ini:* ${todayFormatted}\n`;
            message += `📌 Prioritaskan tugas yang masih berjalan dan butuh tindak lanjut segera.\n\n`;

            if (woItems.length === 0) {
                message += "ℹ️ Tidak ada work order dalam proses.";
            } else {
                message += `📋 *DAFTAR WORK ORDER:* \n\n`;

                woItems.forEach(item => {
                    // Nomor WO
                    const woNo = item.querySelector('.wo-number span:first-child').textContent.trim();

                    // Deskripsi lengkap dari data attribute
                    const desc = item.querySelector('.wo-desc').dataset.fullDescription?.trim() || 'Deskripsi tidak tersedia';

                    // Ekstrak Tower dan Unit
                    const towerUnitText = item.querySelector('.wo-meta div')?.textContent.trim();
                    const parts = towerUnitText ? towerUnitText.split('•').map(part => part.trim()) : [];
                    const tower = parts[0] ? parts[0].replace(/^Tower\s*/i, '').trim() : 'Tidak diketahui';
                    const unit = parts[1] ? parts[1].replace(/^Unit\s*/i, '').trim() : 'Tidak diketahui';

                    // Ekstrak Tanggal dan Waktu
                    const dateText = item.querySelector('.wo-date').textContent.trim();
                    const dateMatch = dateText.match(/([A-Za-z]{3} \d{1,2}, \d{4})/);
                    const timeMatch = dateText.match(/•\s*(\d{1,2}:\d{2})/);

                    const formattedDate = dateMatch ? dateMatch[1] : 'Tanggal tidak diatur';
                    const formattedTime = timeMatch ? timeMatch[1] : '';

                    // PIC / Assignee
                    const assignee = item.querySelector('.wo-assignee small')
                        ?.textContent.replace(/👤\s*/, '').trim() || 'Belum ditugaskan';

                    // Bangun pesan tiap WO
                    message += `📌 *WO:* ${woNo}\n`;
                    message += `📝 ${desc}\n`;
                    message += `📍 Tower ${tower} • Unit ${unit}\n`;
                    message += `📅 ${formattedDate}\n`;
                    if (formattedTime) {
                        message += `⏰ ${formattedTime}\n`;
                    }
                    message += `👷 ${assignee}\n`;
                    message += `──────────────────────\n`;
                });
            }

            // Timestamp akhir
            const now = new Date();
            const formattedNow = now.toLocaleString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }).replace(',', ' pukul');

            message += `\n✅ *Generated by:* Digital WO System\n`;
            message += `🗓️ ${formattedNow}`;

            // Encode dan buka WhatsApp Web
            const url = `https://web.whatsapp.com/send?text=${encodeURIComponent(message)}`;
                    
            // Gunakan nama window agar tidak buka tab baru terus
            window.open(url, 'whatsapp-share', 'noopener,noreferrer');
        }
</script>

<style>
    /* Efek pada tombol WhatsApp */
    .btn-icon:hover svg {
        transform: scale(1.1);
        transition: transform 0.2s ease;
    }

    .btn-icon:hover {
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
        background-color: #e6f7ee;
        border: none;
    }
</style>


<script>
        // Buka modal export
        function openExportModal() {
            const modal = new bootstrap.Modal(document.getElementById('exportModal'));
            modal.show();
        }

        // Eksekusi export setelah konfirmasi
        function confirmExport() {
            const dateInput = document.getElementById('exportDateInput').value;

            if (!dateInput) {
                alert('Silakan pilih tanggal terlebih dahulu.');
                return;
            }

            // Format tanggal untuk ditampilkan (opsional)
            const dateObj = new Date(dateInput);
            const formattedDate = dateObj.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            // Tutup modal
            bootstrap.Modal.getInstance(document.getElementById('exportModal')).hide();

            // Buat URL export
            const url = "{{ route('admin.wo.export.excel') }}?date=" + dateInput;

            // Buka tab download
            window.open(url, '_blank');
        }
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #51A49A, #3a7b70);
    }

    .modal-content {
        overflow: hidden;
    }

    .form-control-lg {
        min-height: 48px;
        padding: 0.75rem 1rem;
    }

    .icon-tabler {
        stroke-width: 1.8;
    }
</style>