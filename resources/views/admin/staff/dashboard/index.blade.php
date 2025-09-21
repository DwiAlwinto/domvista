@extends('admin.layouts.wrapper')

@section('content')
<div class="page-header d-print-none mt-4">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Staff Overview</div>
                <h2 class="page-title">My Dashboard</h2>
            </div>
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

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            
            <!-- Today's Logbook Status Card -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Today's Logbook</div>
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
                        <div class="h1 mb-3">
                            @php
                                $todayLogbook = App\Models\Logbook::whereDate('logbook_date', today())->first();
                                echo $todayLogbook ? $todayLogbook->logbook_number : 'Not Created';
                            @endphp
                        </div>
                        <div class="d-flex mb-2">
                            <div>Status</div>
                            <div class="ms-auto">
                                <span class="badge {{ $todayLogbook && $todayLogbook->status == 'Done' ? 'bg-green' : 'bg-yellow' }}">
                                    {{ $todayLogbook ? $todayLogbook->status : 'Not Started' }}
                                </span>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            @php
                                $progress = 0;
                                if ($todayLogbook) {
                                    $totalEntries = $todayLogbook->entries()->count();
                                    $completedEntries = $todayLogbook->entries()->where('status', 'Done')->count();
                                    $progress = $totalEntries > 0 ? ($completedEntries / $totalEntries) * 100 : 0;
                                }
                            @endphp
                            <div class="progress-bar bg-primary" style="width: {{ $progress }}%" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                <span class="visually-hidden">{{ $progress }}% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- My Completed Tasks Today -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">My Completed Tasks</div>
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
                            <div class="h1 mb-0 me-2">
                                @php
                                    $myCompletedToday = App\Models\LogbookEntry::where('user_done', Auth::id())
                                        ->whereDate('time_done', today())
                                        ->count();
                                    echo $myCompletedToday;
                                @endphp
                            </div>
                            <div class="me-auto">
                                <span class="text-green d-inline-flex align-items-center lh-1">
                                    @php 
                                        $yesterdayCompleted = App\Models\LogbookEntry::where('user_done', Auth::id())
                                            ->whereDate('time_done', today()->subDay())
                                            ->count();
                                        $change = $yesterdayCompleted > 0 ? (($myCompletedToday - $yesterdayCompleted) / $yesterdayCompleted) * 100 : ($myCompletedToday > 0 ? 100 : 0);
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
                    <div id="chart-my-completed-tasks" class="chart-sm"></div>
                </div>
            </div>
            
            <!-- Pending Tasks -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">My Pending Tasks</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Active</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Active</a>
                                        <a class="dropdown-item" href="#">All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">
                                @php
                                    $myPendingTasks = App\Models\LogbookEntry::where('status', 'On Progress')
                                        ->whereHas('logbook', function($query) {
                                            $query->whereDate('logbook_date', '>=', today()->subWeek());
                                        })
                                        ->count();
                                    echo $myPendingTasks;
                                @endphp
                            </div>
                            <div class="me-auto">
                                <span class="text-yellow d-inline-flex align-items-center lh-1">
                                    High Priority
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="chart-pending-tasks" class="chart-sm"></div>
                </div>
            </div>
            
            <!-- Team Performance -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Team Performance</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">This Week</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">This Week</a>
                                        <a class="dropdown-item" href="#">Last Week</a>
                                        <a class="dropdown-item" href="#">This Month</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">
                                @php
                                    $teamCompletedThisWeek = App\Models\LogbookEntry::where('status', 'Done')
                                        ->whereBetween('time_done', [today()->startOfWeek(), today()->endOfWeek()])
                                        ->count();
                                    echo $teamCompletedThisWeek;
                                @endphp
                            </div>
                            <div class="me-auto">
                                <span class="text-green d-inline-flex align-items-center lh-1">
                                    @php 
                                        $lastWeekCompleted = App\Models\LogbookEntry::where('status', 'Done')
                                            ->whereBetween('time_done', [today()->subWeek()->startOfWeek(), today()->subWeek()->endOfWeek()])
                                            ->count();
                                        $change = $lastWeekCompleted > 0 ? (($teamCompletedThisWeek - $lastWeekCompleted) / $lastWeekCompleted) * 100 : ($teamCompletedThisWeek > 0 ? 100 : 0);
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
                    <div id="chart-team-performance" class="chart-sm"></div>
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
                                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ App\Models\LogbookEntry::where('status', 'On Progress')->count() }} Pending Tasks
                                        </div>
                                        <div class="text-secondary">
                                            {{ App\Models\LogbookEntry::where('status', 'On Progress')->whereHas('logbook', function($q) { $q->whereDate('logbook_date', today()); })->count() }} today
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
                                                <path d="M9 12l2 2l4 -4"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ App\Models\LogbookEntry::where('status', 'Done')->where('user_done', Auth::id())->count() }} My Completed
                                        </div>
                                        <div class="text-secondary">
                                            {{ App\Models\LogbookEntry::where('status', 'Done')->where('user_done', Auth::id())->whereDate('time_done', today())->count() }} today
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
                                                <path d="M12 3a9 9 0 0 1 9 9"></path>
                                                <path d="M12 3a9 9 0 0 0 -9 9"></path>
                                                <path d="M3 12h18"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ App\Models\Logbook::whereDate('logbook_date', today())->count() }} Today's Logbook
                                        </div>
                                        <div class="text-secondary">
                                            {{ App\Models\Logbook::whereMonth('logbook_date', today()->month)->count() }} this month
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
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                <path d="M12 8v4"></path>
                                                <path d="M12 16h.01"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ App\Models\LogbookEntry::where('status', '!=', 'Done')->whereHas('logbook', function($q) { $q->whereDate('logbook_date', today()); })->count() }} Urgent Tasks
                                        </div>
                                        <div class="text-secondary">
                                            Needs immediate attention
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Tasks and Recent Activities -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Recent Tasks</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Tower/Unit</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $myTasks = App\Models\LogbookEntry::where('user_done', Auth::id())->orWhere('status', 'On Progress')->orderBy('created_at', 'desc')->take(5)->get(); @endphp
                                    @foreach($myTasks as $task)
                                    <tr>
                                        <td>{{ $task->tower }}/{{ $task->unit }}</td>
                                        <td class="text-secondary">{{ Str::limit($task->description, 30) }}</td>
                                        <td>
                                            <span class="badge 
                                                {{ $task->status == 'Done' ? 'bg-green' : '' }}
                                                {{ $task->status == 'On Progress' ? 'bg-blue' : '' }}
                                                {{ $task->status == 'Set Schedule' ? 'bg-yellow' : '' }}
                                            ">{{ $task->status }}</span>
                                        </td>
                                        <td>{{ $task->created_at->format('M d') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('staff.tasks') }}" class="btn btn-primary">View all My Tasks</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Today's Logbook Entries</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Tower/Unit</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Assigned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $todayEntries = App\Models\LogbookEntry::whereHas('logbook', function($q) {
                                            $q->whereDate('logbook_date', today());
                                        })->orderBy('created_at', 'desc')->take(5)->get();
                                    @endphp
                                    @foreach($todayEntries as $entry)
                                    <tr>
                                        <td>{{ $entry->tower }}/{{ $entry->unit }}</td>
                                        <td class="text-secondary">{{ Str::limit($entry->description, 30) }}</td>
                                        <td>
                                            <span class="badge 
                                                {{ $entry->status == 'Done' ? 'bg-green' : '' }}
                                                {{ $entry->status == 'On Progress' ? 'bg-blue' : '' }}
                                                {{ $entry->status == 'Set Schedule' ? 'bg-yellow' : '' }}
                                            ">{{ $entry->status }}</span>
                                        </td>
                                        <td>
                                            @if($entry->userDone)
                                                {{ $entry->userDone->name }}
                                            @else
                                                <span class="text-muted">Unassigned</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('staff.logbook.today') }}" class="btn btn-primary">View Today's Logbook</a>
                    </div>
                </div>
            </div>

            <!-- Task Distribution and Performance Charts -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Task Status Distribution</h3>
                    </div>
                    <div class="card-body">
                        <div id="chart-my-task-distribution" class="chart-lg"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Weekly Performance</h3>
                    </div>
                    <div class="card-body">
                        <div id="chart-weekly-performance" class="chart-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // My Task Status Distribution Chart
        window.myTaskDistributionChart = new ApexCharts(document.getElementById("chart-my-task-distribution"), {
            chart: {
                type: 'donut',
                fontFamily: 'inherit',
                height: 300,
                animations: {
                    enabled: false
                },
            },
            labels: ['On Progress', 'Set Schedule', 'Done', 'Reschedule', 'Cancel'],
            series: [
                {{ App\Models\LogbookEntry::where('user_done', Auth::id())->where('status', 'On Progress')->count() }},
                {{ App\Models\LogbookEntry::where('user_done', Auth::id())->where('status', 'Set Schedule')->count() }},
                {{ App\Models\LogbookEntry::where('user_done', Auth::id())->where('status', 'Done')->count() }},
                {{ App\Models\LogbookEntry::where('user_done', Auth::id())->where('status', 'Reschedule')->count() }},
                {{ App\Models\LogbookEntry::where('user_done', Auth::id())->where('status', 'Cancel')->count() }}
            ],
            colors: [tabler.getColor("blue"), tabler.getColor("yellow"), tabler.getColor("green"), tabler.getColor("orange"), tabler.getColor("red")],
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
        }).render();

        // Weekly Performance Chart
        window.weeklyPerformanceChart = new ApexCharts(document.getElementById("chart-weekly-performance"), {
            chart: {
                type: 'bar',
                fontFamily: 'inherit',
                height: 300,
                animations: {
                    enabled: false
                },
            },
            series: [{
                name: 'Completed Tasks',
                data: [
                    @php
                        // Generate data for the last 4 weeks
                        for ($i = 3; $i >= 0; $i--) {
                            $weekStart = now()->subWeeks($i)->startOfWeek();
                            $weekEnd = now()->subWeeks($i)->endOfWeek();
                            $count = App\Models\LogbookEntry::where('user_done', Auth::id())
                                ->where('status', 'Done')
                                ->whereBetween('time_done', [$weekStart, $weekEnd])
                                ->count();
                            echo $count . ',';
                        }
                    @endphp
                ]
            }],
            xaxis: {
                categories: [
                    @php
                        for ($i = 3; $i >= 0; $i--) {
                            $weekStart = now()->subWeeks($i)->startOfWeek();
                            echo '"Week ' . $weekStart->format('W') . '",';
                        }
                    @endphp
                ],
                labels: {
                    style: {
                        colors: tabler.getColor("secondary"),
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
                        colors: tabler.getColor("secondary"),
                        fontSize: '12px'
                    }
                }
            },
            colors: [tabler.getColor("primary")],
            grid: {
                borderColor: tabler.getColor("border"),
                strokeDashArray: 4
            },
            tooltip: {
                theme: 'dark'
            }
        }).render();

        // Small charts
        window.myCompletedTasksChart = new ApexCharts(document.getElementById("chart-my-completed-tasks"), {
            chart: {
                type: "area",
                fontFamily: "inherit",
                height: 40,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
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
                data: [3, 5, 2, 4, 6, 8, 7, 9, 5, 6, 8, 10]
            }],
            tooltip: {
                theme: "dark",
            },
            colors: [tabler.getColor("green")],
        }).render();

        window.pendingTasksChart = new ApexCharts(document.getElementById("chart-pending-tasks"), {
            chart: {
                type: "line",
                fontFamily: "inherit",
                height: 40,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
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
                name: "Pending",
                data: [8, 10, 12, 9, 11, 14, 12]
            }],
            tooltip: {
                theme: "dark",
            },
            colors: [tabler.getColor("yellow")],
        }).render();

        window.teamPerformanceChart = new ApexCharts(document.getElementById("chart-team-performance"), {
            chart: {
                type: "bar",
                fontFamily: "inherit",
                height: 40,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
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
                name: "Team",
                data: [15, 18, 14, 22, 17, 19, 24]
            }],
            tooltip: {
                theme: "dark",
            },
            colors: [tabler.getColor("primary")],
        }).render();
    });
</script>
@endsection