<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
               <div class="col">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2">
                        <div>
                            <h2 class="page-title mb-0 d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list me-2" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="#51A49A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 12l3 0" />
                                    <path d="M9 16l6 0" />
                                </svg>
                                <span style="color: #19c0d3; font-weight: 700;">WORK ORDER MONITORING</span>
                            </h2>
                            <div class="text-muted mt-1" style="font-size: 0.9rem; ">
                                Total  {{ $workOrders->total() }} Work Orders
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('admin.wo.create') }}" class="btn" style="background-color: #51A49A; color: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Add Work Order
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl"> 
            <!-- Status Navigation Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card card-sm status-card" data-status="progress">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-blue text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-progress" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" />
                                            <path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" />
                                            <path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" />
                                            <path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" />
                                            <path d="M6.907 4.579a8.954 8.954  0 0 1 3.093 -1.356" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        On Progress & Reschedule
                                    </div>
                                    <div class="text-muted">
                                        {{ $workOrders->whereIn('status', ['On Progress', 'Reschedule'])->count() }} Work Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              

                <div class="col-md-3">
                    <div class="card card-sm status-card" data-status="proses">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-info text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Proses
                                    </div>
                                    <div class="text-muted">
                                        {{ $workOrders->where('status', 'Proses')->count() }} Work Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-sm status-card" data-status="done">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-success text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0 z" fill="none"/>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path d="M9 12l2 2l4 -4" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Done
                                    </div>
                                    <div class="text-muted">
                                        {{ $workOrders->where('status', 'Done')->count() }} Work Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  <div class="col-md-3">
                    <div class="card card-sm status-card" data-status="cancel">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-danger text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Cancel
                                    </div>
                                    <div class="text-muted">
                                        {{ $workOrders->where('status', 'Cancel')->count() }} Work Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- Accordion Content -->
            <div class="accordion" id="woAccordion">
                <!-- On Progress & Reschedule Accordion -->
                <div class="accordion-item">
<style>
    .icon-container {
        width: 32px;
        height: 32px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .icon-container:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .icon-custom {
        transition: all 0.3s ease;
    }
    
    .badge-count {
        padding: 0.35em 0.65em;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        min-width: 24px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .accordion-button:not(.collapsed) .icon-container {
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    }
    
    .bg-blue {
        background: linear-gradient(135deg, #467fcf 0%, #2c5aa0 100%) !important;
    }
    
    .bg-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%) !important;
    }
    
    .bg-info {
        background: linear-gradient(135deg, #17a2b8 0%, #128293 100%) !important;
    }
    
    .bg-success {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
    }
    
    .accordion-button {
        padding: 1rem 1.25rem;
        transition: all 0.3s ease;
    }
    
    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        box-shadow: inset 0 -1px 0 rgba(0,0,0,0.125);
    }
</style>

                    <h2 class="accordion-header" id="headingProgress">
                        <button class="accordion-button d-flex justify-content-center align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProgress" aria-expanded="true" aria-controls="collapseProgress">
                            <span class="icon-container bg-blue text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-custom" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" />
                                    <path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" />
                                    <path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" />
                                    <path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" />
                                    <path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" />
                                </svg>
                            </span>
                            <span class="mx-2 fw-semibold">On Progress & Reschedule</span>
                            <span class="badge-count bg-blue text-white">{{ $workOrders->whereIn('status', ['On Progress', 'Reschedule'])->count() }}</span>
                        </button>
                    </h2>
                    <div id="collapseProgress" class="accordion-collapse collapse show" aria-labelledby="headingProgress" data-bs-parent="#woAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-md card-table">
                                    <thead>
                                        <tr>
                                            <th>WO Number</th>
                                            <th>Tower/Unit</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th class="w-1">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($workOrders->whereIn('status', ['On Progress', 'Reschedule']) as $wo)
                                        <tr>
                                            <td data-label="WO Number">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-fill">
                                                        <strong>{{ $wo->wo_no }}</strong>
                                                        <div class="text-muted text-truncate mt-1" style="max-width: 200px;">
                                                            {{ Str::limit($wo->work_description, 40) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Tower/Unit">
                                                <div>{{ $wo->tower->name ?? '-' }}</div>
                                                <div class="text-muted">{{ $wo->unit->unit_code ?? '-' }}</div>
                                            </td>
                                            <td data-label="Jadwal">
                                                <div>{{ $wo->schedule_date->format('d M Y') }}</div>
                                                    @if($wo->time_schedule)
                                                        <div class="text-muted">
                                                            {{ \Carbon\Carbon::parse($wo->time_schedule)->format('H:i') }} WIB
                                                        </div>
                                                    @endif
                                             </td>
                                            <td data-label="Status">
                                                <span class="badge text-white bg-{{ $wo->status_badge }}">
                                                    {{ $wo->status }}
                                                </span>
                                            </td>
                                            <td data-label="Actions">
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('admin.wo.show', $wo->id) }}" class="btn btn-icon  btn-info" title="View">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler text-white icon-tabler-eye" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" Status>
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>
                                                    </a>
                                                  
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="empty">
                                                    <div class="empty-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                            <path d="M3 3 l18 18" />
                                                        </svg>
                                                    </div>
                                                    <p class="empty-title">Tidak ada work order On Progress atau Reschedule</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

              

                <!-- Proses Accordion -->
                <div class="accordion-item">
                   <!-- Untuk Proses -->
                    <h2 class="accordion-header" id="headingProses">
                        <button class="accordion-button d-flex justify-content-center align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProses" aria-expanded="false" aria-controls="collapseProses">
                            <span class="icon-container bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-custom" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                </svg>
                            </span>
                            <span class="mx-2 fw-semibold">Proses</span>
                            <span class="badge-count bg-info text-white">{{ $workOrders->where('status', 'Proses')->count() }}</span>
                        </button>
                    </h2>
                    <div id="collapseProses" class="accordion-collapse collapse" aria-labelledby="headingProses" data-bs-parent="#woAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-md card-table">
                                    <thead>
                                        <tr>
                                            <th>WO Number</th>
                                            <th>Tower/Unit</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th class="w-1">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($workOrders->where('status', 'Proses') as $wo)
                                        <tr>
                                            <td data-label="WO Number">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-fill">
                                                        <strong>{{ $wo->wo_no }}</strong>
                                                        <div class="text-muted text-truncate mt-1" style="max-width: 200px;">
                                                            {{ Str::limit($wo->work_description, 40) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Tower/Unit">
                                                <div>{{ $wo->tower->name ?? '-' }}</div>
                                                <div class="text-muted">{{ $wo->unit->unit_code ?? '-' }}</div>
                                            </td>
                                             <td data-label="Jadwal">
                                                <div>{{ $wo->schedule_date->format('d M Y') }}</div>
                                                    @if($wo->time_schedule)
                                                        <div class="text-muted">
                                                            {{ \Carbon\Carbon::parse($wo->time_schedule)->format('H:i') }} WIB
                                                        </div>
                                                    @endif
                                             </td>
                                            <td data-label="Status">
                                                <span class="badge text-white bg-{{ $wo->status_badge }}">
                                                    {{ $wo->status }}
                                                </span>
                                            </td>
                                            <td data-label="Actions">
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('admin.wo.show', $wo->id) }}" class="btn btn-icon btn-info" title="View">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-white icon-tabler icon-tabler-eye" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>
                                                    </a>
                                                  
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="empty">
                                                    <div class="empty-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M9 5h-2a2 2 0 0 0 -2 2 v12a2 2 0 0 0 2 2h10a 2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2  0 0 1 -2 2h-2a2 2 0 0 1 -2 -2 z" />
                                                            <path d="M3 3l18 18" />
                                                        </svg>
                                                    </div>
                                                    <p class="empty-title">Tidak ada work order dengan status Proses</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </ div>
                        </div>
                    </div>
                </div>

                <!-- Done Accordion -->
                <div class="accordion-item">
                    <!-- Untuk Done -->
                        <h2 class="accordion-header" id="headingDone">
                            <button class="accordion-button d-flex justify-content-center align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDone" aria-expanded="false" aria-controls="collapseDone">
                                <span class="icon-container bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-custom" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M9 12l2 2l4 -4" />
                                    </svg>
                                </span>
                                <span class="mx-2 fw-semibold">Done</span>
                                <span class="badge-count bg-success text-white">{{ $workOrders->where('status', 'Done')->count() }}</span>
                            </button>
                        </h2>
                    <div id="collapseDone" class="accordion-collapse collapse" aria-labelledby="headingDone" data-bs-parent="#woAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-md card-table">
                                    <thead>
                                        <tr>
                                            <th>WO Number</th>
                                            <th>Tower/Unit</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th class="w-1">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($workOrders->where('status', 'Done') as $wo)
                                        <tr>
                                            <td data-label="WO Number">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-fill">
                                                        <strong>{{ $wo->wo_no }}</strong>
                                                        <div class="text-muted text-truncate mt-1" style="max-width: 200px;">
                                                            {{ Str::limit($wo->work_description, 40) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Tower/Unit">
                                                <div>{{ $wo->tower->name ?? '-' }}</div>
                                                <div class="text-muted">{{ $wo->unit->unit_code ?? '-' }}</div>
                                            </td>
                                             <td data-label="Jadwal">
                                                <div>{{ $wo->schedule_date->format('d M Y') }}</div>
                                                    @if($wo->time_schedule)
                                                        <div class="text-muted">
                                                            {{ \Carbon\Carbon::parse($wo->time_schedule)->format('H:i') }} WIB
                                                        </div>
                                                    @endif
                                             </td>
                                            <td data-label="Status">
                                                <span class="badge text-white bg-{{ $wo->status_badge }}">
                                                    {{ $wo->status }}
                                                </span>
                                            </td>
                                            <td data-label="Actions">
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('admin.wo.show', $wo->id) }}" class="btn btn-icon btn-info" title="View">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-white icon-tabler icon-tabler-eye" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M 0 0h24v24H0z" fill="none"/>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>
                                                    </a>
                                                  
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="empty">
                                                    <div class="empty-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d=" M9 5h-2a2 2 0 0 0 - 2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                            <path d="M3 3l18 18" />
                                                        </svg>
                                                    </div>
                                                    <p class="empty-title">Tidak ada work order dengan status Done</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Cancel Accordion -->
                <div class="accordion-item">
                    <!-- Untuk Cancel -->
                    <h2 class="accordion-header" id="headingCancel">
                        <button class="accordion-button d-flex justify-content-center align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCancel" aria-expanded="false" aria-controls="collapseCancel">
                            <span class="icon-container bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-custom" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </span>
                            <span class="mx-2 fw-semibold">Cancel</span>
                            <span class="badge-count bg-danger text-white">{{ $workOrders->where('status', 'Cancel')->count() }}</span>
                        </button>
                    </h2>
                    <div id="collapseCancel" class="accordion-collapse collapse" aria-labelledby="headingCancel" data-bs-parent="#woAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-mobile-md card-table">
                                    <thead>
                                        <tr>
                                            <th>WO Number</th>
                                            <th>Tower/Unit</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th class="w-1">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($workOrders->where('status', 'Cancel') as $wo)
                                        <tr>
                                            <td data-label="WO Number">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-fill">
                                                        <strong>{{ $wo->wo_no }}</strong>
                                                        <div class="text-muted text-truncate mt-1" style="max-width: 200px;">
                                                            {{ Str::limit($wo->work_description, 40) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Tower/Unit">
                                                <div>{{ $wo->tower->name ?? '-' }}</div>
                                                <div class="text-muted">{{ $wo->unit->unit_code ?? '-' }}</div>
                                            </td>
                                              <td data-label="Jadwal">
                                                <div>{{ $wo->schedule_date->format('d M Y') }}</div>
                                                    @if($wo->time_schedule)
                                                        <div class="text-muted">
                                                            {{ \Carbon\Carbon::parse($wo->time_schedule)->format('H:i') }} WIB
                                                        </div>
                                                    @endif
                                             </td>
                                            <td data-label="Status">
                                                <span class="badge text-white bg-{{ $wo->status_badge }}">
                                                    {{ $wo->status }}
                                                </span>
                                            </td>
                                            <td data-label="Actions">
                                                <div class="btn-list flex-nowrap">
                                                     <a href="{{ route('admin.wo.show', $wo->id) }}" class="btn btn-action btn-view" title="View Details" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="action-icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="empty">
                                                    <div class="empty-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                            <path d="M3 3l18 18" />
                                                        </svg>
                                                    </div>
                                                    <p class="empty-title">Tidak ada work order dengan status Cancel</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize accordion state from localStorage if available
        const savedState = localStorage.getItem('woAccordionState');
        if (savedState) {
            const accordion = new bootstrap.Collapse(document.getElementById(savedState));
            accordion.show();
        }
        
        // Save accordion state to localStorage when shown
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-bs-target');
                localStorage.setItem('woAccordionState', target.substring(1));
            });
        });

        // Status card click to open accordion
        document.querySelectorAll('.status-card').forEach(card => {
            card.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                const accordionId = 'collapse' + status.charAt(0).toUpperCase() + status.slice(1);
                const accordion = new bootstrap.Collapse(document.getElementById(accordionId));
                accordion.show();
            });
        });

        // Search functionality
        const searchInput = document.getElementById('search-wo');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchValue) ? '' : 'none';
                });
            });
        }

        // Filter by tower
        const filterTower = document.getElementById('filter-tower');
        if (filterTower) {
            filterTower.addEventListener('change', function() {
                const towerId = this.value;
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    if (!towerId) {
                        row.style.display = '';
                        return;
                    }
                    
                    const towerCell = row.querySelector('td[data-label="Tower/Unit"]');
                    if (towerCell) {
                        const towerText = towerCell.textContent;
                        row.style.display = towerText.includes(towerId) ? '' : 'none';
                    }
                });
            });
        }
    });
</script>

<style>
    .status-card {
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .status-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .bg-blue {
        background-color: #467fcf !important;
    }
    
    .badge.bg-blue {
        background-color: #467fcf !important;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #495057;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #6c757d;
    }
    
    .empty {
        padding: 2rem 0;
    }
    
    .empty-icon {
        margin-bottom: 1rem;
    }
    
    .empty-title {
        font-weight: 600;
        color: #6c757d;
    }
</style>

<style>
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .btn-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-action:hover::before {
        left: 100%;
    }
    
    .btn-view {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
    }
    
    .btn-view:hover {
        background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    }
    
    .btn-edit:hover {
        background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }
    
    .btn-delete:hover {
        background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }
    
    .action-icon {
        stroke: white;
        transition: transform 0.3s ease;
    }
    
    .btn-action:hover .action-icon {
        transform: scale(1.1);
    }
    
    .btn-list {
        gap: 8px;
    }
    
    /* Tooltip styling */
    .tooltip {
        font-size: 0.8rem;
    }
    
    /* Animation for button click */
    .btn-action:active {
        transform: translateY(0) scale(0.95);
    }
    
    /* Focus states for accessibility */
    .btn-action:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection