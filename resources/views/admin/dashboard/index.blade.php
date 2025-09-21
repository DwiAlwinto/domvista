<!-- Page header -->
        <div class="page-header d-print-none mt-4">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Overview</div>
                        <h2 class="page-title">Dashboard</h2>
                    </div>
                    <!-- Date selector -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <div class="input-icon">
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="date-filter">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M16 3l0 4"></path>
                                        <path d="M8 3l0 4"></path>
                                        <path d="M4 11l16 0"></path>
                                        <path d="M8 15h2v2h-2z"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    
                    <!-- Work Order Statistics Cards -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Total Work Orders</div>
                                    <div class="ms-auto lh-1">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Time</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item active" href="#">All Time</a>
                                                <a class="dropdown-item" href="#">Last 7 days</a>
                                                <a class="dropdown-item" href="#">Last 30 days</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="h1 mb-3">{{ App\Models\WorkOrder::count() }}</div>
                                <div class="d-flex mb-2">
                                    <div>Active Work Orders</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            {{ App\Models\WorkOrder::whereIn('status', ['On Progress', 'Proses'])->count() }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon ms-1 icon-2">
                                                <path d="M3 17l6 -6l4 4l8 -8"></path>
                                                <path d="M14 7l7 0l0 7"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    @php
                                        $totalWO = App\Models\WorkOrder::count();
                                        $doneWO = App\Models\WorkOrder::where('status', 'Done')->count();
                                        $completionPercentage = $totalWO > 0 ? ($doneWO / $totalWO) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar bg-primary" style="width: {{ $completionPercentage }}%" role="progressbar" aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                        <span class="visually-hidden">{{ round($completionPercentage, 1) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Completed Today</div>
                                    <div class="ms-auto lh-1">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Today</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item active" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Yesterday</a>
                                                <a class="dropdown-item" href="#">This Week</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <div class="h1 mb-0 me-2">{{ App\Models\WorkOrder::where('status', 'Done')->whereDate('updated_at', today())->count() }}</div>
                                    <div class="me-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            @php
                                                $yesterdayDone = App\Models\WorkOrder::where('status', 'Done')->whereDate('updated_at', today()->subDay())->count();
                                                $todayDone = App\Models\WorkOrder::where('status', 'Done')->whereDate('updated_at', today())->count();
                                                $change = $yesterdayDone > 0 ? (($todayDone - $yesterdayDone) / $yesterdayDone) * 100 : ($todayDone > 0 ? 100 : 0);
                                            @endphp
                                            {{ round($change, 1) }}%
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon ms-1 icon-2">
                                                <path d="M3 17l6 -6l4 4l8 -8"></path>
                                                <path d="M14 7l7 0l0 7"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="chart-completed-today" class="chart-sm"></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Pending Approval</div>
                                    <div class="ms-auto lh-1">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item active" href="#">Last 7 days</a>
                                                <a class="dropdown-item" href="#">Last 30 days</a>
                                                <a class="dropdown-item" href="#">Last 3 months</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <div class="h1 mb-3 me-2">{{ App\Models\WorkOrder::where('status', 'On Progress')->count() }}</div>
                                    <div class="me-auto">
                                        <span class="text-yellow d-inline-flex align-items-center lh-1">
                                            @php
                                                $lastWeekPending = App\Models\WorkOrder::where('status', 'On Progress')->whereDate('created_at', '>=', today()->subWeek())->count();
                                                $currentPending = App\Models\WorkOrder::where('status', 'On Progress')->count();
                                                $changePercent = $lastWeekPending > 0 ? ($currentPending / $lastWeekPending) * 100 : ($currentPending > 0 ? 100 : 0);
                                            @endphp
                                            {{ round($changePercent, 1) }}%
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon ms-1 icon-2">
                                                <path d="M3 17l6 -6l4 4l8 -8"></path>
                                                <path d="M14 7l7 0l0 7"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div id="chart-pending-approval" class="chart-sm"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Logbook Entries</div>
                                    <div class="ms-auto lh-1">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Today</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item active" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Yesterday</a>
                                                <a class="dropdown-item" href="#">This Week</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <div class="h1 mb-3 me-2">{{ App\Models\Logbook::whereDate('logbook_date', today())->count() }}</div>
                                    <div class="me-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            @php
                                                $yesterdayLogbooks = App\Models\Logbook::whereDate('logbook_date', today()->subDay())->count();
                                                $todayLogbooks = App\Models\Logbook::whereDate('logbook_date', today())->count();
                                                $logbookChange = $yesterdayLogbooks > 0 ? (($todayLogbooks - $yesterdayLogbooks) / $yesterdayLogbooks) * 100 : ($todayLogbooks > 0 ? 100 : 0);
                                            @endphp
                                            {{ round($logbookChange, 1) }}%
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon ms-1 icon-2">
                                                <path d="M3 17l6 -6l4 4l8 -8"></path>
                                                <path d="M14 7l7 0l0 7"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div id="chart-logbook-entries" class="chart-sm"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Row -->
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 8l-4 4"></path>
                                                        <path d="M12 8v8"></path>
                                                        <path d="M16 12l-4 -4"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ App\Models\WorkOrder::where('status', 'On Progress')->count() }} Active WO
                                                </div>
                                                <div class="text-secondary">
                                                    {{ App\Models\WorkOrder::where('status', 'On Progress')->whereDate('schedule_date', today())->count() }} scheduled today
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-green text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                        <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                                        <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                                        <path d="M9 12l2 2l4 -4"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ App\Models\WorkOrder::where('status', 'Done')->count() }} Completed WO
                                                </div>
                                                <div class="text-secondary">
                                                    {{ App\Models\WorkOrder::where('status', 'Done')->whereDate('updated_at', today())->count() }} today
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-twitter text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                        <path d="M4 19.5v-15a2.5 2.5 0 0 1 5 0v15a2.5 2.5 0 0 1 -5 0z"></path>
                                                        <path d="M14 19.5v-15a2.5 2.5 0 0 1 5 0v15a2.5 2.5 0 0 1 -5 0z"></path>
                                                        <path d="M4 12h10"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ App\Models\Logbook::count() }} Logbooks
                                                </div>
                                                <div class="text-secondary">
                                                    {{ App\Models\LogbookEntry::count() }} total entries
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-facebook text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                        <path d="M9 12l2 2l4 -4"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ App\Models\LogbookEntry::where('status', 'On Progress')->count() }} Ongoing Tasks
                                                </div>
                                                <div class="text-secondary">
                                                    {{ App\Models\LogbookEntry::where('status', 'Done')->whereDate('updated_at', today())->count() }} completed today
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Work Orders and Logbooks -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Work Orders</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>WO Number</th>
                                                <th>Tenant</th>
                                                <th>Status</th>
                                                <th>Schedule</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $recentWorkOrders = App\Models\WorkOrder::with(['tower', 'unit'])->orderBy('created_at', 'desc')->take(5)->get(); @endphp
                                            @foreach($recentWorkOrders as $wo)
                                            <tr>
                                                <td>{{ $wo->wo_no }}</td>
                                                <td class="text-secondary">{{ $wo->tenant_name }}</td>
                                                <td>
                                                    <span class="badge text-white 
                                                        @if($wo->status == 'Done') bg-green @endif
                                                        @if($wo->status == 'On Progress') bg-blue @endif
                                                        @if($wo->status == 'Proses') bg-yellow @endif
                                                        @if($wo->status == 'Cancel') bg-red @endif
                                                        @if($wo->status == 'Reschedule') bg-orange @endif
                                                    ">{{ $wo->status }}</span>
                                                </td>
                                                <td>{{ $wo->schedule_date ? \Carbon\Carbon::parse($wo->schedule_date)->format('d M Y') : '-' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.wo.index') }}" class="btn btn-primary">View all Work Orders</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Logbooks</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Logbook Number</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Entries</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $recentLogbooks = App\Models\Logbook::withCount('entries')->orderBy('logbook_date', 'desc')->take(5)->get(); @endphp
                                            @foreach($recentLogbooks as $logbook)
                                            <tr>
                                                <td>{{ $logbook->logbook_number }}</td>
                                                <td class="text-secondary">{{ \Carbon\Carbon::parse($logbook->logbook_date)->format('d M Y') }}</td>
                                                <td>
                                                    <span class="badge text-white
                                                        @if($logbook->status == 'Done') bg-green @endif
                                                        @if($logbook->status == 'On Progress') bg-blue @endif
                                                    ">{{ $logbook->status }}</span>
                                                </td>
                                                <td>{{ $logbook->entries_count }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.logbook.index') }}" class="btn btn-primary">View all Logbooks</a>
                            </div>
                        </div>
                    </div>

                    <!-- Status Distribution Charts -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Work Order Status Distribution</h3>
                            </div>
                            <div class="card-body">
                                <div id="chart-status-distribution" class="chart-lg"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Monthly Completion Trend</h3>
                            </div>
                            <div class="card-body">
                                <div id="chart-monthly-trend" class="chart-lg"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Attendance Overview -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Staff On Duty - Detailed View</h3>
                                <div class="ms-auto">
                                    <span class="badge bg-blue text-white">
                                        @php
                                            $today = \Carbon\Carbon::now('Asia/Jakarta')->startOfDay();
                                            $todayLogbook = App\Models\Logbook::whereDate('logbook_date', $today)->first();
                                            $staff = $todayLogbook?->staff;
                                        @endphp
                                        {{ $staff ? $today->format('d M Y') : 'No data for today' }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                @if(!$staff)
                                    <div class="text-center text-muted py-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-lg mb-2 opacity-50">
                                            <path d="M12 2a10 10 0 1 0 10 10"></path>
                                            <path d="M12 8v4"></path>
                                            <path d="M12 16h.01"></path>
                                        </svg>
                                        <p class="mb-0">No logbook entry for today.</p>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-vcenter card-table">
                                            <thead class="bg-gray-light">
                                                <tr>
                                                    <th class="w-25">Department</th>
                                                    <th>Morning</th>
                                                    <th>Afternoon</th>
                                                    <th>Night</th>
                                                    <th>Leaders / Notes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- MOD -->
                                                <tr>
                                                    <td><span class="badge bg-dark me-1">👤</span> <strong>MOD</strong></td>
                                                    <td class="text-center" colspan="3">{{ $staff->mod ?: '-' }}</td>
                                                    <td>-</td>
                                                </tr>

                                                <!-- Tenant Relations -->
                                                <tr>
                                                    <td><span class="badge bg-blue me-1">👔</span> <strong>Tenant Relations</strong></td>
                                                    <td>{{ $staff->c_morning ?: '-' }}</td>
                                                    <td>{{ $staff->c_afternoon ?: '-' }}</td>
                                                    <td>{{ $staff->c_evening ?: '-' }}</td>
                                                    <td>{{ $staff->chief_tr ?: '-' }}</td>
                                                </tr>

                                                <!-- Health Club -->
                                                <tr>
                                                    <td><span class="badge bg-cyan me-1">👥</span> <strong>Health Club</strong></td>
                                                    <td>{{ $staff->hc_morning ?: '-' }}</td>
                                                    <td>{{ $staff->hc_afternoon ?: '-' }}</td>
                                                    <td>-</td>
                                                    <td>{{ $staff->chief_tr ?: '-' }}</td>
                                                </tr>

                                                <!-- Engineering -->
                                                <tr>
                                                    <td><span class="badge bg-green me-1">🔧</span> <strong>Engineering</strong></td>
                                                    <td>{{ $staff->engineer_morning ?: '-' }}</td>
                                                    <td>{{ $staff->engineer_afternoon ?: '-' }}</td>
                                                    <td>{{ $staff->engineer_night ?: '-' }}</td>
                                                    <td>{{ $staff->chief_engineer ?: '-' }}</td>
                                                </tr>

                                                <!-- Security -->
                                                <tr>
                                                    <td><span class="badge bg-red me-1">🛡️</span> <strong>Security</strong></td>
                                                    <td>{{ $staff->sec_morning ?: '-' }}</td>
                                                    <td>{{ $staff->sec_afternoon ?: '-' }}</td>
                                                    <td>{{ $staff->sec_night ?: '-' }}</td>
                                                    <td>{{ $staff->chief_security ?: '-' }}</td>
                                                </tr>

                                                <!-- Housekeeping -->
                                                <tr>
                                                    <td><span class="badge bg-yellow me-1">🧹</span> <strong>Housekeeping</strong></td>
                                                    <td>{{ $staff->hk_morning ?: '-' }}</td>
                                                    <td>{{ $staff->hk_afternoon ?: '-' }}</td>
                                                    <td>{{ $staff->hk_night ?: '-' }}</td>
                                                    <td>{{ $staff->chief_hk ?: '-' }}</td>
                                                </tr>

                                                <!-- HSE -->
                                                <tr>
                                                    <td><span class="badge bg-orange me-1">⛑️</span> <strong>HSE</strong></td>
                                                    <td>{{ $staff->hse_morning ?: '-' }}</td>
                                                    <td>{{ $staff->hse_afternoon ?: '-' }}</td>
                                                    <td>{{ $staff->hse_night ?: '-' }}</td>
                                                    <td>{{ $staff->hse_morning ?: '-' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Resident Overview -->
                    <div class="col-12">
                        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                            <!-- Card Header -->
                            <div class="card-header bg-white d-flex align-items-center justify-content-between p-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-rounded bg-gradient-primary text-white me-3 shadow-sm d-flex align-items-center justify-content-center" 
                                        style="width: 48px; height: 48px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </div>
                                    <h3 class="card-title mb-0 fs-5 text-dark fw-bold">Resident Overview</h3>
                                </div>
                                <a href="{{ route('admin.master.residents.index') }}" 
                                class="btn btn-outline-primary btn-sm px-3 d-flex align-items-center shadow-sm rounded-pill hover-elevate">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                        <path d="M12 5v14"></path>
                                        <path d="M5 12h14"></path>
                                    </svg>
                                    View All Residents
                                </a>
                            </div>

                            <!-- Mini Stats Cards -->
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <!-- Owners -->
                                    <div class="col-6 col-md-3">
                                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-elevate transition-all"
                                            style="background: linear-gradient(135deg, #06d6a0, #118ab2); color: white;">
                                            <div class="card-body p-3 text-center">
                                                <div class="small opacity-90 mb-1 d-flex align-items-center justify-content-center gap-1">
                                                    <span>🏠</span>
                                                    <span>Owners</span>
                                                </div>
                                                <div class="h4 mb-0 fw-bold">{{ App\Models\Resident::where('is_owner', 1)->count() }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Active Leasees -->
                                    <div class="col-6 col-md-3">
                                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-elevate transition-all"
                                            style="background: linear-gradient(135deg, #f77f00, #e76f51); color: white;">
                                            <div class="card-body p-3 text-center">
                                                <div class="small opacity-90 mb-1 d-flex align-items-center justify-content-center gap-1">
                                                    <span>👔</span>
                                                    <span>Active Leasees</span>
                                                </div>
                                                @php
                                                $activeLeasees = \App\Models\Resident::where('is_owner', false)
                                                    ->whereHas('units', function ($q) {
                                                        $q->whereNull('end_date')->orWhere('end_date', '>', now());
                                                    })->count();
                                                @endphp
                                                <div class="h4 mb-0 fw-bold">{{ $activeLeasees }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Family Members -->
                                    <div class="col-6 col-md-3">
                                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-elevate transition-all"
                                            style="background: linear-gradient(135deg, #d62828, #8e2420); color: white;">
                                            <div class="card-body p-3 text-center">
                                                <div class="small opacity-90 mb-1 d-flex align-items-center justify-content-center gap-1">
                                                    <span>👨‍👩‍👧‍👦</span>
                                                    <span>Family Members</span>
                                                </div>
                                                <div class="h4 mb-0 fw-bold">{{ App\Models\FamilyMember::count() }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Parking Used -->
                                    <div class="col-6 col-md-3">
                                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-elevate transition-all"
                                            style="background: linear-gradient(135deg, #e76f51, #c0392b); color: white;">
                                            <div class="card-body p-3 text-center">
                                                <div class="small opacity-90 mb-1 d-flex align-items-center justify-content-center gap-1">
                                                    <span>🚗</span>
                                                    <span>Parking Used</span>
                                                </div>
                                                <div class="h4 mb-0 fw-bold">{{ App\Models\ParkingAssignment::count() }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Parking Available -->
                                    <div class="col-6 col-md-3">
                                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-elevate transition-all"
                                            style="background: linear-gradient(135deg, #83c5be, #00796b); color: white;">
                                            <div class="card-body p-3 text-center">
                                                <div class="small opacity-90 mb-1 d-flex align-items-center justify-content-center gap-1">
                                                    <span>🅿️</span>
                                                    <span>Parking Available</span>
                                                </div>
                                                @php
                                                $totalParking = App\Models\ParkingLot::count();
                                                $usedParking = App\Models\ParkingAssignment::count();
                                                $availableParking = max(0, $totalParking - $usedParking);
                                                @endphp
                                                <div class="h4 mb-0 fw-bold">{{ $availableParking }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Parking -->
                                    <div class="col-6 col-md-3">
                                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-elevate transition-all"
                                            style="background: linear-gradient(135deg, #a29bfe, #6c5ce7); color: white;">
                                            <div class="card-body p-3 text-center">
                                                <div class="small opacity-90 mb-1 d-flex align-items-center justify-content-center gap-1">
                                                    <span>📍</span>
                                                    <span>Total Parking</span>
                                                </div>
                                                <div class="h4 mb-0 fw-bold">{{ App\Models\ParkingLot::count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Unit Sales Overview by Tower -->
                    <div class="col-12 mt-4">
                        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                            <!-- Card Header -->
                            <div class="card-header bg-white d-flex align-items-center justify-content-between p-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-rounded bg-gradient-success text-white me-3 shadow-sm d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="3" y1="9" x2="21" y2="9"></line>
                                            <line x1="9" y1="21" x2="9" y2="9"></line>
                                        </svg>
                                    </div>
                                    <h3 class="card-title mb-0 fs-5 text-dark fw-bold">Unit Sales by Tower</h3>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary active" id="btnCardView">📊 Cards</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btnChartView">📈 Chart</button>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-4">
                                <!-- Cards View (Default) -->
                                <div id="cardView" class="row g-4">
                                    @php
                                    // Tower Sales Data
                                    $totalTower1 = \App\Models\Unit::whereHas('tower', function($q) {
                                        $q->whereRaw('LOWER(TRIM(name)) = ?', ['t1']);
                                    })->count();

                                    $totalTower2 = \App\Models\Unit::whereHas('tower', function($q) {
                                        $q->whereRaw('LOWER(TRIM(name)) = ?', ['t2']);
                                    })->count();

                                    $soldTower1 = \App\Models\Resident::where('is_owner', 1)
                                        ->whereHas('units.tower', function($q) {
                                            $q->whereRaw('LOWER(TRIM(name)) = ?', ['t1']);
                                        })->count();

                                    $soldTower2 = \App\Models\Resident::where('is_owner', 1)
                                        ->whereHas('units.tower', function($q) {
                                            $q->whereRaw('LOWER(TRIM(name)) = ?', ['t2']);
                                        })->count();

                                    $percentTower1 = $totalTower1 > 0 ? round(($soldTower1 / $totalTower1) * 100, 1) : 0;
                                    $percentTower2 = $totalTower2 > 0 ? round(($soldTower2 / $totalTower2) * 100, 1) : 0;
                                    @endphp

                                    <!-- Tower 1 (T1) -->
                                    <div class="col-12 col-md-6">
                                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-elevate transition-all"
                                            style="background: linear-gradient(135deg, #4ade80, #16a34a); color: white; transform: translateY(0); transition: transform 0.3s ease;"
                                            onmouseover="this.style.transform='translateY(-5px)'" 
                                            onmouseout="this.style.transform='translateY(0)'">
                                            <div class="card-body p-4 text-center">
                                                <h5 class="mb-3 fw-bold">Tower T1</h5>
                                                <div class="display-5 fw-bold">{{ $soldTower1 }} / {{ $totalTower1 }}</div>
                                                <div class="small opacity-90 mb-2">Units Sold</div>
                                                <div class="progress" style="height: 10px; background-color: rgba(255,255,255,0.3); border-radius: 5px;">
                                                    <div class="progress-bar bg-white rounded-pill" role="progressbar" style="width: {{ $percentTower1 }}%" aria-valuenow="{{ $percentTower1 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="mt-2 fw-semibold fs-5">{{ $percentTower1 }}% Sold</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tower 2 (T2) -->
                                    <div class="col-12 col-md-6">
                                        <div class="card border-0 rounded-4 h-100 shadow-sm hover-elevate transition-all"
                                            style="background: linear-gradient(135deg, #fbbf24, #ea580c); color: white; transform: translateY(0); transition: transform 0.3s ease;"
                                            onmouseover="this.style.transform='translateY(-5px)'" 
                                            onmouseout="this.style.transform='translateY(0)'">
                                            <div class="card-body p-4 text-center">
                                                <h5 class="mb-3 fw-bold">Tower T2</h5>
                                                <div class="display-5 fw-bold">{{ $soldTower2 }} / {{ $totalTower2 }}</div>
                                                <div class="small opacity-90 mb-2">Units Sold</div>
                                                <div class="progress" style="height: 10px; background-color: rgba(255,255,255,0.3); border-radius: 5px;">
                                                    <div class="progress-bar bg-white rounded-pill" role="progressbar" style="width: {{ $percentTower2 }}%" aria-valuenow="{{ $percentTower2 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="mt-2 fw-semibold fs-5">{{ $percentTower2 }}% Sold</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Chart View (Hidden by default) -->
                                <div id="chartView" class="row g-4" style="display: none;">
                                    <div class="col-12">
                                        <div class="bg-white p-4 rounded-4 shadow-sm">
                                            <canvas id="salesChart" height="120"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="bg-white p-4 rounded-4 shadow-sm">
                                            <h5 class="text-center mb-3">Tower T1</h5>
                                            <canvas id="pieChartT1" height="150"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="bg-white p-4 rounded-4 shadow-sm">
                                            <h5 class="text-center mb-3">Tower T2</h5>
                                            <canvas id="pieChartT2" height="150"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

      
        <!-- Chart.js for Unit Sales Charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                
                // Work Order Status Distribution Chart
                if (typeof ApexCharts !== 'undefined') {
                    window.statusDistributionChart = new ApexCharts(document.getElementById("chart-status-distribution"), {
                        chart: {
                            type: 'donut',
                            fontFamily: 'inherit',
                            height: 300,
                            animations: {
                                enabled: true
                            },
                        },
                        labels: ['On Progress', 'Proses', 'Done', 'Cancel', 'Reschedule'],
                        series: [
                            {{ App\Models\WorkOrder::where('status', 'On Progress')->count() }},
                            {{ App\Models\WorkOrder::where('status', 'Proses')->count() }},
                            {{ App\Models\WorkOrder::where('status', 'Done')->count() }},
                            {{ App\Models\WorkOrder::where('status', 'Cancel')->count() }},
                            {{ App\Models\WorkOrder::where('status', 'Reschedule')->count() }}
                        ],
                        colors: ['#3b82f6', '#eab308', '#10b981', '#ef4444', '#f97316'],
                        legend: {
                            show: true,
                            position: 'bottom',
                            offsetY: 10
                        },
                        dataLabels: {
                            enabled: true,
                            dropShadow: {
                                enabled: false
                            }
                        },
                        tooltip: {
                            theme: 'dark'
                        }
                    });
                    window.statusDistributionChart.render();

                    // Monthly Completion Trend Chart
                    window.monthlyTrendChart = new ApexCharts(document.getElementById("chart-monthly-trend"), {
                        chart: {
                            type: 'line',
                            fontFamily: 'inherit',
                            height: 300,
                            animations: {
                                enabled: true
                            },
                        },
                        series: [{
                            name: 'Completed Work Orders',
                            data: [
                                @php
                                $monthlyData = [];
                                for ($i = 5; $i >= 0; $i--) {
                                    $month = now()->subMonths($i);
                                    $count = App\Models\WorkOrder::where('status', 'Done')
                                        ->whereYear('updated_at', $month->year)
                                        ->whereMonth('updated_at', $month->month)
                                        ->count();
                                    $monthlyData[] = $count;
                                }
                                echo implode(',', $monthlyData);
                                @endphp
                            ]
                        }],
                        xaxis: {
                            categories: [
                                @php
                                $categories = [];
                                for ($i = 5; $i >= 0; $i--) {
                                    $categories[] = '"' . now()->subMonths($i)->format('M Y') . '"';
                                }
                                echo implode(',', $categories);
                                @endphp
                            ],
                            labels: {
                                style: {
                                    colors: '#6b7280',
                                    fontSize: '12px'
                                }
                            },
                            axisBorder: {
                                show: false
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#6b7280',
                                    fontSize: '12px'
                                }
                            }
                        },
                        colors: ['#3b82f6'],
                        grid: {
                            borderColor: '#e5e7eb',
                            strokeDashArray: 4
                        },
                        tooltip: {
                            theme: 'dark'
                        }
                    });
                    window.monthlyTrendChart.render();

                    // Small charts
                    window.completedTodayChart = new ApexCharts(document.getElementById("chart-completed-today"), {
                        chart: {
                            type: "area",
                            fontFamily: "inherit",
                            height: 40,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: true,
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 0.16,
                            type: "solid",
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: "Completed",
                            data: [9, 5, 7, 12, 15, 18, 20, 15, 12, 8, 10, 13]
                        }],
                        tooltip: {
                            theme: "dark",
                        },
                        colors: ['#10b981'],
                    });
                    window.completedTodayChart.render();

                    window.pendingApprovalChart = new ApexCharts(document.getElementById("chart-pending-approval"), {
                        chart: {
                            type: "line",
                            fontFamily: "inherit",
                            height: 40,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: true,
                            },
                        },
                        fill: {
                            opacity: 1,
                        },
                        stroke: {
                            width: [2, 1],
                            dashArray: [0, 3],
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: "This Week",
                            data: [22, 19, 25, 17, 21, 23, 19]
                        }],
                        tooltip: {
                            theme: "dark",
                        },
                        colors: ['#eab308'],
                    });
                    window.pendingApprovalChart.render();

                    window.logbookEntriesChart = new ApexCharts(document.getElementById("chart-logbook-entries"), {
                        chart: {
                            type: "bar",
                            fontFamily: "inherit",
                            height: 40,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: true,
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%",
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 1,
                        },
                        series: [{
                            name: "Entries",
                            data: [5, 8, 6, 9, 7, 10, 8, 9, 11, 7, 8, 10]
                        }],
                        tooltip: {
                            theme: "dark",
                        },
                        colors: ['#3b82f6'],
                    });
                    window.logbookEntriesChart.render();
                }

                // Unit Sales Chart Toggle Functionality
                const btnCardView = document.getElementById('btnCardView');
                const btnChartView = document.getElementById('btnChartView');
                const cardView = document.getElementById('cardView');
                const chartView = document.getElementById('chartView');

                if (btnCardView && btnChartView && cardView && chartView) {
                    btnCardView.addEventListener('click', function() {
                        btnCardView.classList.add('active');
                        btnChartView.classList.remove('active');
                        cardView.style.display = 'block';
                        chartView.style.display = 'none';
                    });

                    btnChartView.addEventListener('click', function() {
                        btnChartView.classList.add('active');
                        btnCardView.classList.remove('active');
                        cardView.style.display = 'none';
                        chartView.style.display = 'block';
                        
                        // Initialize Chart.js charts when view is shown
                        initSalesCharts();
                    });
                }

                function initSalesCharts() {
                    if (typeof Chart !== 'undefined') {
                        // Bar Chart
                        const salesCtx = document.getElementById('salesChart');
                        if (salesCtx && !salesCtx.chart) {
                            salesCtx.chart = new Chart(salesCtx, {
                                type: 'bar',
                                data: {
                                    labels: ['Tower T1', 'Tower T2'],
                                    datasets: [{
                                        label: 'Units Sold',
                                        data: [{{ $soldTower1 }}, {{ $soldTower2 }}],
                                        backgroundColor: ['#4ade80', '#fbbf24']
                                    }, {
                                        label: 'Total Units',
                                        data: [{{ $totalTower1 }}, {{ $totalTower2 }}],
                                        backgroundColor: ['#e5e7eb', '#e5e7eb']
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        title: {
                                            display: true,
                                            text: 'Unit Sales Comparison'
                                        }
                                    }
                                }
                            });
                        }

                        // Pie Chart T1
                        const pieCtxT1 = document.getElementById('pieChartT1');
                        if (pieCtxT1 && !pieCtxT1.chart) {
                            pieCtxT1.chart = new Chart(pieCtxT1, {
                                type: 'pie',
                                data: {
                                    labels: ['Sold', 'Available'],
                                    datasets: [{
                                        data: [{{ $soldTower1 }}, {{ $totalTower1 - $soldTower1 }}],
                                        backgroundColor: ['#4ade80', '#e5e7eb']
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                        }
                                    }
                                }
                            });
                        }

                        // Pie Chart T2
                        const pieCtxT2 = document.getElementById('pieChartT2');
                        if (pieCtxT2 && !pieCtxT2.chart) {
                            pieCtxT2.chart = new Chart(pieCtxT2, {
                                type: 'pie',
                                data: {
                                    labels: ['Sold', 'Available'],
                                    datasets: [{
                                        data: [{{ $soldTower2 }}, {{ $totalTower2 - $soldTower2 }}],
                                        backgroundColor: ['#fbbf24', '#e5e7eb']
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                        }
                                    }
                                }
                            });
                        }
                    }
                }
            });
        </script>

        <style>
            .hover-elevate {
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .hover-elevate:hover {
                transform: translateY(-4px) scale(1.02);
                box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
            }
            .card {
                overflow: hidden;
            }
            .avatar {
                font-size: 1.1rem;
            }
            .transition-all {
                transition: all 0.3s ease;
            }
            .bg-gradient-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .bg-gradient-success {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            }
        </style>