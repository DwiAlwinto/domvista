@extends('admin.layouts.wrapper')

@section('content')
<div class="page-header d-print-none mt-4">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Logbook Management</div>
                <h2 class="page-title">Today's Logbook - {{ today()->format('F d, Y') }}</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if($logbook)
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-export">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M7 11l5 5l5 -5"></path>
                            <path d="M12 4l0 12"></path>
                        </svg>
                        Export
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        @if(!$logbook)
        <div class="alert alert-info">
            <div class="d-flex">
                <div>
                    <h4 class="alert-title">No Logbook for Today</h4>
                    <div class="text-secondary">There is no logbook created for today yet.</div>
                </div>
            </div>
        </div>
        @else
        <div class="row row-deck row-cards">
            <!-- Logbook Summary -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Logbook Summary</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Logbook Number</label>
                                    <input type="text" class="form-control" value="{{ $logbook->logbook_number }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <input type="text" class="form-control" value="{{ $logbook->status }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Total Entries</label>
                                    <input type="text" class="form-control" value="{{ $logbook->entries->count() }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Completed</label>
                                    <input type="text" class="form-control" value="{{ $logbook->entries->where('status', 'Done')->count() }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">In Progress</label>
                                    <input type="text" class="form-control" value="{{ $logbook->entries->where('status', 'On Progress')->count() }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Information -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Staff Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">MOD</label>
                                    <input type="text" class="form-control" value="{{ $logbook->staff->mod ?? 'N/A' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Chief Technical</label>
                                    <input type="text" class="form-control" value="{{ $logbook->staff->chief_tr ?? 'N/A' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Chief Engineer</label>
                                    <input type="text" class="form-control" value="{{ $logbook->staff->chief_enginer ?? 'N/A' }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Entries Table -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Logbook Entries</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-secondary">
                                Showing
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Entries count">
                                </div>
                                entries
                            </div>
                            <div class="ms-auto text-secondary">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" aria-label="Search entries">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Tower</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Completed</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logbook->entries as $entry)
                                <tr>
                                    <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                    <td>{{ $entry->tower }}</td>
                                    <td>{{ $entry->unit }}</td>
                                    <td class="text-secondary">{{ Str::limit($entry->description, 50) }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $entry->status == 'Done' ? 'bg-green' : '' }}
                                            {{ $entry->status == 'On Progress' ? 'bg-blue' : '' }}
                                            {{ $entry->status == 'Set Schedule' ? 'bg-yellow' : '' }}
                                            {{ $entry->status == 'Reschedule' ? 'bg-orange' : '' }}
                                            {{ $entry->status == 'Cancel' ? 'bg-red' : '' }}
                                        ">{{ $entry->status }}</span>
                                    </td>
                                    <td class="text-secondary">
                                        @if($entry->userDone)
                                            {{ $entry->userDone->name }}
                                        @else
                                            <span class="text-muted">Unassigned</span>
                                        @endif
                                    </td>
                                    <td class="text-secondary">
                                        @if($entry->time_done)
                                            {{ $entry->time_done->format('M d, H:i') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal-entry-{{ $entry->id }}">
                                                View
                                            </a>
                                            @if($entry->status != 'Done' && Auth::id() == $entry->user_done)
                                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-update-entry-{{ $entry->id }}">
                                                Update
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Export Modal -->
<div class="modal modal-blur fade" id="modal-export" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Logbook</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Export Format</label>
                    <select class="form-select">
                        <option value="pdf">PDF Document</option>
                        <option value="excel">Excel Spreadsheet</option>
                        <option value="csv">CSV File</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Include</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked id="include-entries">
                        <label class="form-check-label" for="include-entries">
                            All Entries
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked id="include-staff">
                        <label class="form-check-label" for="include-staff">
                            Staff Information
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="include-completed-only">
                        <label class="form-check-label" for="include-completed-only">
                            Completed Tasks Only
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary ms-auto">
                    Export Logbook
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Entry Detail Modals -->
@if($logbook)
@foreach($logbook->entries as $entry)
<div class="modal modal-blur fade" id="modal-entry-{{ $entry->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Entry Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tower</label>
                            <input type="text" class="form-control" value="{{ $entry->tower }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Unit</label>
                            <input type="text" class="form-control" value="{{ $entry->unit }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" readonly>{{ $entry->description }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" value="{{ $entry->status }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Assigned To</label>
                            <input type="text" class="form-control" value="{{ $entry->userDone ? $entry->userDone->name : 'Unassigned' }}" readonly>
                        </div>
                    </div>
                </div>
                @if($entry->result)
                <div class="mb-3">
                    <label class="form-label">Result</label>
                    <textarea class="form-control" rows="2" readonly>{{ $entry->result }}</textarea>
                </div>
                @endif
                @if($entry->time_done)
                <div class="mb-3">
                    <label class="form-label">Completed On</label>
                    <input type="text" class="form-control" value="{{ $entry->time_done->format('M d, Y H:i') }}" readonly>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@if($entry->status != 'Done' && Auth::id() == $entry->user_done)
<div class="modal modal-blur fade" id="modal-update-entry-{{ $entry->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff.logbook.entries.update', $entry->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="On Progress" {{ $entry->status == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="Set Schedule" {{ $entry->status == 'Set Schedule' ? 'selected' : '' }}>Set Schedule</option>
                            <option value="Done" {{ $entry->status == 'Done' ? 'selected' : '' }}>Done</option>
                            <option value="Reschedule" {{ $entry->status == 'Reschedule' ? 'selected' : '' }}>Reschedule</option>
                            <option value="Cancel" {{ $entry->status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Result</label>
                        <textarea class="form-control" name="result" rows="3" placeholder="Enter task result...">{{ $entry->result }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary ms-auto">
                        Update Entry
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endforeach
@endif
@endsection