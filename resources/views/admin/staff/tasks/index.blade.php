@extends('admin.layouts.wrapper')

@section('content')
<div class="page-header d-print-none mt-4">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Tasks Management</div>
                <h2 class="page-title">My Tasks</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-filter">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M9 12l2 2l4 -4"></path>
                        </svg>
                        Filter Tasks
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Task List</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-secondary">
                                Showing
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Tasks count">
                                </div>
                                entries
                            </div>
                            <div class="ms-auto text-secondary">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" aria-label="Search tasks">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Tower/Unit</th>
                                    <th>Description</th>
                                    <th>Logbook Date</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Completed</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr>
                                    <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                    <td>{{ $task->tower }}/{{ $task->unit }}</td>
                                    <td class="text-secondary">{{ Str::limit($task->description, 50) }}</td>
                                    <td class="text-secondary">
                                        {{ $task->logbook->logbook_date->format('M d, Y') }}
                                    </td>
                                    <td>
                                        <span class="badge 
                                            {{ $task->status == 'Done' ? 'bg-green' : '' }}
                                            {{ $task->status == 'On Progress' ? 'bg-blue' : '' }}
                                            {{ $task->status == 'Set Schedule' ? 'bg-yellow' : '' }}
                                            {{ $task->status == 'Reschedule' ? 'bg-orange' : '' }}
                                            {{ $task->status == 'Cancel' ? 'bg-red' : '' }}
                                        ">{{ $task->status }}</span>
                                    </td>
                                    <td class="text-secondary">
                                        {{ $task->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="text-secondary">
                                        @if($task->time_done)
                                            {{ $task->time_done->format('M d, Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal-task-{{ $task->id }}">
                                                View
                                            </a>
                                            @if($task->status != 'Done')
                                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $task->id }}">
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
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-secondary">Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} entries</p>
                        <ul class="pagination m-0 ms-auto">
                            {{ $tasks->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal modal-blur fade" id="modal-filter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Tasks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select">
                        <option value="">All Status</option>
                        <option value="On Progress">On Progress</option>
                        <option value="Done">Done</option>
                        <option value="Set Schedule">Set Schedule</option>
                        <option value="Reschedule">Reschedule</option>
                        <option value="Cancel">Cancel</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date Range</label>
                    <div class="input-group">
                        <input type="date" class="form-control" placeholder="From">
                        <span class="input-group-text">to</span>
                        <input type="date" class="form-control" placeholder="To">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tower</label>
                    <input type="text" class="form-control" placeholder="Tower">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Task Detail Modals -->
@foreach($tasks as $task)
<div class="modal modal-blur fade" id="modal-task-{{ $task->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Tower/Unit</label>
                    <input type="text" class="form-control" value="{{ $task->tower }}/{{ $task->unit }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" readonly>{{ $task->description }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" value="{{ $task->status }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Logbook Date</label>
                            <input type="text" class="form-control" value="{{ $task->logbook->logbook_date->format('M d, Y') }}" readonly>
                        </div>
                    </div>
                </div>
                @if($task->result)
                <div class="mb-3">
                    <label class="form-label">Result</label>
                    <textarea class="form-control" rows="2" readonly>{{ $task->result }}</textarea>
                </div>
                @endif
                @if($task->time_done)
                <div class="mb-3">
                    <label class="form-label">Completed On</label>
                    <input type="text" class="form-control" value="{{ $task->time_done->format('M d, Y H:i') }}" readonly>
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

@if($task->status != 'Done')
<div class="modal modal-blur fade" id="modal-update-{{ $task->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff.tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="On Progress" {{ $task->status == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="Set Schedule" {{ $task->status == 'Set Schedule' ? 'selected' : '' }}>Set Schedule</option>
                            <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                            <option value="Reschedule" {{ $task->status == 'Reschedule' ? 'selected' : '' }}>Reschedule</option>
                            <option value="Cancel" {{ $task->status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Result</label>
                        <textarea class="form-control" name="result" rows="3" placeholder="Enter task result...">{{ $task->result }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary ms-auto">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endforeach
@endsection