
<div class="page-wrapper">
    <div class="container-xl">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Digital Logbook</div>
                    <h2 class="page-title">
                        {{ $logbook->logbook_number }}
                    </h2>
                    <div class="text-muted mt-1">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M11 15h1" />
                                <path d="M12 15v3" />
                            </svg>
                            {{ $logbook->logbook_date->format('d F Y') }}
                        </span>
                        <span class="badge bg-blue-lt">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <path d="M9 9l1 0" />
                                <path d="M9 13l6 0" />
                                <path d="M9 17l6 0" />
                            </svg>
                            Digital Version
                        </span>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.logbook.index') }}" class="btn btn-outline-teal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                            </svg>
                            Back to List
                        </a>

                        <a href="{{ route('admin.logbook.edit', $logbook->id) }}" 
                            class="btn btn-teal text-white d-flex align-items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    class="icon text-white" 
                                    width="24" height="24" 
                                    viewBox="0 0 24 24" 
                                    stroke-width="2" 
                                    stroke="currentColor" 
                                    fill="none" 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                    <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                </svg>

                                <span class="text-white">Edit Logbook</span>
                            </a>

                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-md-12">
                    <!-- Logbook Information Card -->
                    <div class="card card-lg">
                        <div class="card-header bg-primary-lt">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 8l.01 0" />
                                    <path d="M11 12l1 0l0 4l1 0" />
                                </svg>
                                Logbook Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="border rounded p-3 h-100">
                                        <div class="text-muted mb-1">Logbook Date</div>
                                        <div class="h3 mb-0">
                                            {{ $logbook->logbook_date->format('d') }}
                                            <small class="text-muted fs-4">{{ $logbook->logbook_date->format('M Y') }}</small>
                                        </div>
                                        <div class="text-muted">{{ $logbook->logbook_date->format('l') }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-3 h-100">
                                        <div class="text-muted mb-1">Logbook Number</div>
                                        <div class="h2 text-primary">{{ $logbook->logbook_number }}</div>
                                        <div class="text-muted">Digital Version</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <div class="alert alert-info">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 9v2m0 4v.01" />
                                                <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                            </svg>
                                        </div>
                                        <div class="flex-fill">
                                            <h4 class="alert-title">Digital Logbook Summary</h4>
                                            <div class="text-muted">
                                                This digital logbook contains {{ $logbook->entries->count() }} entries with various statuses.
                                                Last updated {{ $logbook->updated_at->diffForHumans() }}.
                                            </div>
                                        </div>
                                        <button class="btn-close mt-2" data-bs-dismiss="alert"></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

    <div class="container-xl mt-2">
    @if($hasUnfinished)
        <!-- Unfinished Entries Card -->
        <div class="card mb-4 border-danger">
            <div class="card-header bg-danger-lt d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M12 8v4" />
                        <path d="M12 16h.01" />
                    </svg>
                    <h3 class="card-title mb-0">
                        Unfinished Entries from Previous Dates
                    </h3>
                </div>
                <div>
                    <span class="badge bg-danger text-white">
                        {{ $previousEntries->count() }} Pending Items
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-danger alert-dismissible bg-danger-lt mb-3">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 9v2m0 4v.01"></path>
                                <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="me-2 alert-title">Attention Required</h4>
                            <div class="text-secondary">Click on any logbook entry below to update or complete the information.</div>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover table-striped table-bordered">
                        <thead class="bg-danger-lt">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%">Original Date</th>
                                <th width="15%">Logbook Number</th>
                                <th width="15%">Unit Location</th>
                                <th>Work Description</th>
                                <th width="15%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($previousEntries as $entry)
                            <tr style="cursor: pointer;" onclick="window.location='{{ route('admin.logbook.edit', $entry->logbook_id) }}'">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="text-danger">
                                        {{ $entry->logbook->logbook_date->format('d M Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-muted">
                                        {{ $entry->logbook->logbook_number }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge bg-red text-white mb-1">Tower {{ $entry->tower }}</span>
                                        <span class="badge bg-orange text-white">Unit {{ $entry->unit }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-wrap" style="min-width: 200px;">
                                        {{ Str::limit($entry->description, 100) }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-red text-white p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-exclamation" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M20.986 12.502a9 9 0 1 0 -5.973 7.98" />
                                            <path d="M12 7v5l3 3" />
                                            <path d="M19 16v3" />
                                            <path d="M19 22v.01" />
                                        </svg>
                                        On Progress
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer bg-danger-lt">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 8l.01 0" />
                                <path d="M11 12l1 0l0 4l1 0" />
                            </svg>
                            Click on any row to edit the logbook entry
                        </small>
                        <small class="text-muted">
                            Last updated: {{ now()->format('d M Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

    <div class="container-xl">
         
        <div class="row mt-4">
         
             <!-- Right Column -->
                <div class="col-12 mt-4">
                    <!-- Entries Card -->
                    <div class="card card-lg">
                        <div class="card-header bg-purple-lt">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M13 5h8" />
                                    <path d="M13 9h5" />
                                    <path d="M13 15h8" />
                                    <path d="M13 19h5" />
                                    <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                </svg>
                                Logbook Entries
                            </h3>
                            <div class="card-actions">
                                <span class="badge bg-purple-lt text-purple">
                                    {{ $logbook->entries->count() }} Entries
                                </span>
                            </div>
                        </div>
                     <div class="card-body">
                        <!-- Improved Accordion with Icons and Better Visual Hierarchy -->
                        <div class="accordion" id="logbook-accordion">
                            @foreach($logbook->entries as $entry)
                            <div class="accordion-item mb-3 border-0 shadow-sm">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed d-flex align-items-center py-3" type="button" 
                                        data-bs-toggle="collapse" data-bs-target="#logbook-entry-{{ $loop->index }}" 
                                        aria-expanded="false" style="background-color: #f8f9fa;">
                                        
                                        <div class="d-flex w-100 align-items-center">
                                            <!-- Entry Number with Icon -->
                                            <div class="me-3 d-flex align-items-center">
                                                <span class="avatar avatar-sm bg-blue-lt d-flex align-items-center justify-content-center me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M9 6l11 0" />
                                                        <path d="M9 12l11 0" />
                                                        <path d="M9 18l11 0" />
                                                        <path d="M5 6l0 .01" />
                                                        <path d="M5 12l0 .01" />
                                                        <path d="M5 18l0 .01" />
                                                    </svg>
                                                </span>
                                                <strong class="text-primary">#{{ $loop->iteration }}</strong>
                                            </div>
                                            
                                            <!-- Tower/Unit Badges with Icons -->
                                            <div class="d-flex align-items-center me-3">
                                                <span class="badge bg-blue-lt text-blue d-flex align-items-center me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M3 21l18 0" />
                                                        <path d="M5 21v-14l8 -4v18" />
                                                        <path d="M19 21v-10l-6 -4" />
                                                        <path d="M9 9l0 .01" />
                                                        <path d="M9 12l0 .01" />
                                                        <path d="M9 15l0 .01" />
                                                        <path d="M9 18l0 .01" />
                                                    </svg>
                                                    Tower {{ $entry->tower }}
                                                </span>
                                                <span class="badge bg-azure-lt text-azure d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M14 12v.01" />
                                                        <path d="M3 21h18" />
                                                        <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                                                    </svg>
                                                    Unit {{ $entry->unit }}
                                                </span>
                                            </div>
                                            
                                            <!-- Status Badge with Icon -->
                                            <div class="me-3">
                                                <span class="badge d-flex align-items-center
                                                    @if($entry->status == 'Done') bg-green-lt text-green
                                                    @elseif($entry->status == 'On Progress') bg-blue-lt text-blue
                                                    @elseif($entry->status == 'Set Schedule') bg-cyan-lt text-cyan
                                                    @elseif($entry->status == 'Reschedule') bg-orange-lt text-orange
                                                    @elseif($entry->status == 'Cancel') bg-red-lt text-red
                                                    @endif">
                                                    @if($entry->status == 'Done')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M9 12l2 2l4 -4" />
                                                    </svg>
                                                    @elseif($entry->status == 'On Progress')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-progress me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" />
                                                        <path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" />
                                                        <path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" />
                                                        <path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" />
                                                        <path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" />
                                                    </svg>
                                                    @elseif($entry->status == 'Set Schedule')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                        <path d="M16 3l0 4" />
                                                        <path d="M8 3l0 4" />
                                                        <path d="M4 11l16 0" />
                                                        <path d="M8 15h2v2h-2z" />
                                                    </svg>
                                                    @elseif($entry->status == 'Reschedule')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-time me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                        <path d="M15 3v4" />
                                                        <path d="M7 3v4" />
                                                        <path d="M3 11h16" />
                                                        <path d="M18 16.496v1.504l1 1" />
                                                    </svg>
                                                    @elseif($entry->status == 'Cancel')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M10 10l4 4m0 -4l-4 4" />
                                                    </svg>
                                                    @endif
                                                    {{ $entry->status }}
                                                </span>
                                            </div>
                                            
                                          
                                        </div>
                                    </button>
                                </h2>
                                
                                <div id="logbook-entry-{{ $loop->index }}" class="accordion-collapse collapse" 
                                    data-bs-parent="#logbook-accordion">
                                    <div class="accordion-body pt-3 pb-3 bg-white">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card card-body border-0 shadow-none">
                                                    <!-- Description Section -->
                                                    <div class="mb-4">
                                                        <h5 class="d-flex align-items-center mb-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                                                <path d="M9 7l6 0" />
                                                                <path d="M9 11l6 0" />
                                                                <path d="M9 15l4 0" />
                                                            </svg>
                                                            Description
                                                        </h5>
                                                        <div class="ps-4">
                                                            <p class="mb-0">{{ $entry->description }}</p>
                                                        </div>
                                                    </div>

                                                    <!-- Di dalam accordion-body, setelah Description section -->
                @if(!empty($entry->result))
                    <div class="mb-4">
                        <h5 class="d-flex align-items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkup-list me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M9 14h.01" />
                                <path d="M9 17h.01" />
                                <path d="M12 16l1 1l3 -3" />
                            </svg>
                            Work Result
                        </h5>
                        <div class="ps-4">
                            <div class="card bg-green-lt border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3">
                                            <span class="avatar avatar-sm bg-green text-white rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="flex-fill">
                                            <div class="text-muted mb-1">Completed Work Details</div>
                                            <div class="font-weight-medium">{!! nl2br(e($entry->result)) !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr-text my-4">
                        <span class="text-muted">Entry Details</span>
                    </div>
                @else
                    <div class="hr-text my-4">
                        <span class="text-muted">Entry Details</span>
                    </div>
                @endif
                                                    
                                                    
                                                    
            <!-- Details in Two Columns -->
                <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper me-2 text-blue" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                        <path d="M3 21l18 0" />
                                                                        <path d="M5 21v-14l8 -4v18" />
                                                                        <path d="M19 21v-10l-6 -4" />
                                                                        <path d="M9 9l0 .01" />
                                                                        <path d="M9 12l0 .01" />
                                                                        <path d="M9 15l0 .01" />
                                                                        <path d="M9 18l0 .01" />
                                                                    </svg>
                                                                    <small class="text-muted">Tower</small>
                                                                </div>
                                                                <div class="ps-4">
                                                                    <strong>{{ $entry->tower }}</strong>
                                                                </div>
                                                            </div>
                                                            
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar me-2 text-blue" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                            <path d="M16 3v4" />
                            <path d="M8 3v4" />
                            <path d="M4 11h16" />
                            <path d="M11 15h1" />
                            <path d="M12 15v3" />
                        </svg>
                        <small class="text-muted">Date Created</small>
                    </div>
                    <div class="ps-4">
                        <strong>{{ $entry->created_at->format('d M Y, H:i') }}</strong>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check me-2 text-green" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        <small class="text-muted">Date Done</small>
                    </div>
                    <div class="ps-4">
                    <strong>
                        @if($entry->time_done)
                            {{ $entry->time_done }}
                        @else
                            Not completed yet
                        @endif
                    </strong>
                </div>

               <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check me-2 text-green" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        <small class="text-muted">Completed By</small>
                    </div>
                    <div class="ps-4">
                        <strong>
                            @if($entry->userDone)
                                {{ $entry->userDone->name }} 
                            @else
                                Not completed yet
                            @endif
                        </strong>
                    </div>
                </div>

                </div>

                     </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <div class="d-flex align-items-center mb-2">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door me-2 text-blue" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                                        <path d="M14 12v.01" />
                                                                                        <path d="M3 21h18" />
                                                                                        <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                                                                                    </svg>
                                                                                    <small class="text-muted">Unit</small>
                                                                                </div>
                                                                                <div class="ps-4">
                                                                                    <strong>{{ $entry->unit }}</strong>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="mb-3">
                                                                                <div class="d-flex align-items-center mb-2">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle me-2 text-blue" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                                                        <path d="M12 9h.01" />
                                                                                        <path d="M11 12h1v4h1" />
                                                                                    </svg>
                                                                                    <small class="text-muted">Status</small>
                                                                                </div>
                                                                                <div class="ps-4">
                                                                                    <span class="badge 
                                                                                        @if($entry->status == 'Done') bg-green-lt text-green
                                                                                        @elseif($entry->status == 'On Progress') bg-blue-lt text-blue
                                                                                        @elseif($entry->status == 'Set Schedule') bg-cyan-lt text-cyan
                                                                                        @elseif($entry->status == 'Reschedule') bg-orange-lt text-orange
                                                                                        @elseif($entry->status == 'Cancel') bg-red-lt text-red
                                                                                        @endif">
                                                                                        {{ $entry->status }}
                                                                                    </span>
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
                                            @endforeach
                                        </div>

                                        <!-- Enhanced Summary Cards -->
                                        <div class="mt-4">
                                            <div class="row row-cards">
                                                <div class="col-sm-6">
    <div class="card card-sm border-0 shadow-sm hover-scale transition-transform">
        <div class="card-body p-3">
            <div class="row align-items-center g-3">
                <!-- Icon -->
                <div class="col-auto">
                    <span class="avatar avatar-lg bg-gradient-primary text-white shadow-sm" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <path d="M8 11h8" />
                            <path d="M8 15h8" />
                            <path d="M8 7h.01" />
                        </svg>
                    </span>
                </div>

                <!-- Info -->
                <div class="col">
                    <h3 class="h5 mb-1 text-dark">Export to Excel</h3>
                    <p class="text-muted mb-0 small">
                        Generate a professional report in Excel format (.xlsx)
                    </p>
                </div>

                <!-- Action Button -->
                <div class="col-auto">
                    <a href="{{ route('admin.logbook.export.excel', $logbook->id) }}"
                       class="btn btn-primary px-3 py-2 d-flex align-items-center gap-2"
                       target="_blank"
                       data-bs-toggle="tooltip"
                       title="Download full logbook as Excel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 11l5 5l5 -5" />
                            <path d="M12 4l0 12" />
                        </svg>
                        <strong>Export</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

                                                
                                                <div class="col-sm-6">
                                                    <div class="card card-sm border-0 shadow-sm hover-shadow">
                                                        <div class="card-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <span class="avatar avatar-md bg-green text-white">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                                            <path d="M9 15l2 2l4 -4" />
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="font-weight-medium">Verification Status</div>
                                                                    <div class="text-muted">All entries have been confirmed</div>
                                                                    <small class="text-muted">Verified on {{ now()->format('d M Y') }}</small>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <span class="badge bg-success-lt text-success">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                            <path d="M5 12l5 5l10 -10" />
                                                                        </svg>
                                                                        Verified
                                                                    </span>
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
                        </div>

                    </div>
        </div>

    </div>
      

    <style>
        .hover-scale {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-scale:hover {
    transform: translateY(-2px) scale(1.01);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #3498db, #2980b9);
}
    </style>