<div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">Resident Details</h2>
                    </div>
                  <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <!-- Tombol Export Excel -->
                            <a href="{{ route('admin.master.residents.export', $resident->id) }}" 
                            class="btn btn-export-excel d-flex align-items-center gap-2"
                            target="_blank"
                            title="Export data penghuni ke Excel">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-export">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <path d="M15 14v-6" />
                                    <path d="M15 11l-3 -3" />
                                    <path d="M15 11l3 -3" />
                                </svg>
                                Export Excel
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.master.residents.edit', $resident->id) }}" 
                            class="btn btn-brand-primary d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.415v3h3l8.415 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                                Edit
                            </a>

                            <!-- Tombol Kembali -->
                            <a href="{{ route('admin.master.residents.index') }}" 
                            class="btn btn-brand-outline d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                    <line x1="5" y1="12" x2="11" y2="18" />
                                    <line x1="5" y1="12" x2="11" y2="6" />
                                </svg>
                                Back
                            </a>
                        </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <!-- Informasi Utama Penghuni -->
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Occupant Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Full Name:</strong> {{ $resident->full_name }}</p>
                                        <p><strong>Email:</strong> {{ $resident->email ?? '-' }}</p>
                                        <p><strong>Telepon:</strong> {{ $resident->phone ?? '-' }}</p>
                                        <p><strong>Identity (NIK/PASSPORT):</strong> {{ $resident->identity_number ?? '-' }}</p>
                                        <p><strong>Status:</strong>
                                            <span class="badge bg-{{ $resident->is_owner ? 'green' : 'blue' }}-lt">
                                                {{ $resident->is_owner ? 'Owner' : 'Leasee' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Citizenship:</strong> {{ $resident->citizenship ?? '-' }}</p>
                                        <p><strong>Religion:</strong> {{ $resident->religion ?? '-' }}</p>
                                        <p><strong>Place and date of birth:</strong>
                                            {{ $resident->place_of_birth ? $resident->place_of_birth . ', ' : '' }}
                                            {{ $resident->date_of_birth ? \Carbon\Carbon::parse($resident->date_of_birth)->format('d M Y') : '-' }}
                                        </p>
                                        <p><strong>Gender:</strong> {{ ucfirst($resident->gender) ?? '-' }}</p>
                                        <p><strong>Work:</strong> {{ $resident->occupation ?? '-' }}</p>
                                        <p><strong>Company:</strong> {{ $resident->company ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p><strong>Agent Company:</strong> {{ $resident->agent_company ?? '-' }}</p>
                                        <p><strong>Agent Name:</strong> {{ $resident->agent_name ?? '-' }}</p>
                                        <p><strong>Agent Number:</strong> {{ $resident->number_agent ?? '-' }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                
                 <!-- Unit yang Dihuni -->
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Occupied Units</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Tower</th>
                                            <th>Unit</th>
                                            <th>Role</th>
                                            <th>Start Date</th>
                                            <th>Completion Date</th>
                                            <th>Sale date</th>
                                            <th>Handover Date</th>
                                            <th>Parking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($resident->units as $unit)
                                            <tr>
                                                <td>{{ $unit->tower->name }}</td>
                                                <td><strong>{{ $unit->unit_code }}</strong></td>
                                                <td>
                                                    <span class="badge bg-primary-lt px-3 py-2" style="font-size: 0.85rem;">
                                                        {{ $unit->pivot->role }}
                                                    </span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($unit->pivot->start_date)->format('d M Y') }}</td>

                                                <!-- Tanggal Selesai: hanya tampilkan jika Leasee -->
                                                <td>
                                                    @if($unit->pivot->role === 'Leasee' || $unit->pivot->role === 'Co-Leasee')
                                                        @if($unit->pivot->end_date)
                                                            {{ \Carbon\Carbon::parse($unit->pivot->end_date)->format('d M Y') }}
                                                        @else
                                                            <span class="text-success fw-bold">Aktif</span>
                                                        @endif
                                                    @else
                                                        {{-- Owner: biarkan kosong atau tanda '-' --}}
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                <!-- Tanggal Penjualan: hanya tampilkan jika Owner -->
                                                <td>
                                                    @if($unit->pivot->role === 'Owner' || $unit->pivot->role === 'Co-Owner')
                                                        @if($unit->pivot->date_sold)
                                                            {{ \Carbon\Carbon::parse($unit->pivot->date_sold)->format('d M Y') }}
                                                        @else
                                                            <span class="text-muted">Not filled yet</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                <!-- Tanggal Serah Terima: hanya tampilkan jika Owner -->
                                                <td>
                                                    @if($unit->pivot->role === 'Owner' || $unit->pivot->role === 'Co-Owner')
                                                        @if($unit->pivot->date_handover)
                                                            {{ \Carbon\Carbon::parse($unit->pivot->date_handover)->format('d M Y') }}
                                                        @else
                                                            <span class="text-muted">Not filled yet</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                <!-- Parkir -->
                                                <td>
                                                    @if($resident->activeParkingAssignment && $resident->activeParkingAssignment->isNotEmpty())
                                                        <div class="parking-list">
                                                            @foreach($resident->activeParkingAssignment as $assignment)
                                                                <div class="mb-2 p-2 border rounded" style="background-color: #f8fdfb;">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                            <strong>{{ $assignment->parkingLot->parkingArea->area_code }} - {{ $assignment->parkingLot->lot_number }}</strong>
                                                                            <div class="text-muted small">
                                                                                {{ $assignment->parkingLot->lot_type }} • 
                                                                                {{ $assignment->assigned_at->format('d M Y') }}
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge bg-blue-lt" style="font-size: 0.75rem;">
                                                                            {{ ucfirst($assignment->parkingLot->lot_type) }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-muted small">No parking</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building text-muted" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M3 21h18" />
                                                        <path d="M9 8h1l1 3h5l1 -3h1" />
                                                        <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                                                    </svg>
                                                    <div class="mt-2">No parking</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Anggota Keluarga -->
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Family Members</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Connection</th>
                                            <th>Gender</th>
                                            <th>Number Identity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($resident->familyMembers as $member)
                                            <tr>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->relationship }}</td>
                                                <td>{{ $member->gender }}</td>
                                                <td>{{ $member->identity_number ?? '-' }}</td>
                                                <td>
                                                    <form action="{{ route('admin.master.residents.destroyFamily', $member->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus anggota keluarga ini?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">There are no family members yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Staf Pendamping -->
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Supporting Staff</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Telepon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($resident->staffs as $staff)
                                            <tr>
                                                <td>{{ $staff->name }}</td>
                                                <td>{{ ucfirst($staff->type) }}</td>
                                                <td>{{ $staff->phone ?? '-' }}</td>
                                                <td>
                                                    <form action="{{ route('admin.master.residents.destroyStaff', $staff->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus staf ini?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">There are no registered staff yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Document</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table">
                                    <thead>
                                        <tr>
                                            <th>Document Type</th>
                                            <th>Nama File</th>
                                            <th>Size</th>
                                            <th>Upload Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($resident->documents as $doc)
                                            <tr>
                                                <td>{{ $doc->document_type }}</td>
                                                <td>{{ $doc->file_name }}</td>
                                                <td>{{ number_format($doc->file_size / 1024, 2) }} KB</td>
                                                <td>{{ \Carbon\Carbon::parse($doc->created_at)->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">Lihat</a>
                                                    <form action="{{ route('admin.master.residents.destroyDocument', $doc->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus dokumen ini?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">BelumNo documents have been uploaded yet</td>
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