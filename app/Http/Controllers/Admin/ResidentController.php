<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Staff;
use App\Models\Tower;
use App\Exports\ResidentExportBulk;
use App\Models\Document;
use App\Models\Resident;
use App\Models\ParkingLot;
use App\Models\FamilyMember;
use App\Models\LeaseHistory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\ResidentExport;
use App\Models\ParkingAssignment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;



class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with([
            'units' => function ($query) {
                $query->withPivot('role', 'start_date', 'end_date', 'is_primary'); // ← tambahkan end_date
            },
            'units.tower'
        ])->get();

        $residentsForJs = $residents->map(function ($r) {
            return [
                'id' => $r->id,
                'full_name' => $r->full_name,
                'email' => $r->email,
                'phone' => $r->phone,
                'identity_number' => $r->identity_number,
                'is_owner' => $r->is_owner,
                'units' => $r->units->map(function ($u) {
                    return [
                        'id' => $u->id,
                        'unit_code' => $u->unit_code,
                        'tower_name' => $u->tower->name,
                        'floor' => $u->floor->name ?? 'N/A',
                        // Ambil dari pivot
                        'role' => $u->pivot->role,
                        'start_date' => $u->pivot->start_date,
                        'end_date' => $u->pivot->end_date, // ← penting!
                    ];
                })->values()->all(),
            ];
        });

        $towers = Tower::with('units.floor')->get();

        return view('admin.layouts.wrapper', [
            'content' => 'admin.residents.index',
            'residents' => $residentsForJs,
            'towers' => $towers,
        ]);
    }

    public function create()
    {
        $towers = Tower::with('units.floor')->get();
        $units = Unit::with('tower', 'floor')->get();

        // PERBAIKAN: Gunakan scope available() dari model ParkingLot
        $parkingLots = ParkingLot::with('parkingArea')
            ->available()
            ->get();

        return view('admin.layouts.wrapper', [
            'content' => 'admin.residents.create',
            'towers' => $towers,
            'units' => $units,
            'parkingLots' => $parkingLots,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:residents,email',
            'identity_number' => 'nullable|string|unique:residents,identity_number',
            'unit_id' => 'required|exists:units,id',
            'role' => 'required|in:Owner,Leasee',
            'start_date' => 'required|date',
            'ktp_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ownership_file' => 'required_if:role,Owner,Co-Owner|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'lease_file' => 'required_if:role,Leasee,Co-Leasee|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'doc_file.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'parking_ids' => 'nullable|array|max:3',
            'parking_ids.*' => 'exists:parking_lots,id',
            'number_agent' => 'nullable|string|max:15',

            // ✅ Validasi khusus untuk Owner
            'date_sold' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->role === 'Owner' && empty($value)) {
                        $fail('Tanggal penjualan wajib diisi untuk Owner.');
                    }
                },
            ],
            'date_handover' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->role === 'Owner' && empty($value)) {
                        $fail('Tanggal serah terima wajib diisi untuk Owner.');
                    }
                },
            ],
        ]);

        // Hanya ambil data yang masuk ke tabel residents
        $data = $request->only(
            'full_name',
            'phone',
            'email',
            'identity_number',
            'citizenship',
            'religion',
            'place_of_birth',
            'date_of_birth',
            'gender',
            'occupation',
            'company',
            'agent_name',
            'agent_company',
            'number_agent'
        );

        $resident = Resident::create($data);

        // ✅ SET is_owner BERDASARKAN ROLE
        $resident->update([
            'is_owner' => ($request->role === 'Owner') ? 1 : 0,
        ]);

        // Hubungkan ke unit
        $isPrimary = ($request->role === 'Owner');

        if ($isPrimary) {
            DB::table('unit_residents')
                ->where('unit_id', $request->unit_id)
                ->where('is_primary', true)
                ->update(['is_primary' => false]);
        }

        // ✅ ATTACH KE PIVOT TABLE DENGAN date_sold DAN date_handover
        $resident->units()->attach($request->unit_id, [
            'role' => $request->role,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_primary' => $isPrimary,
            'date_sold' => $request->filled('date_sold') ? $request->date_sold : null,
            'date_handover' => $request->filled('date_handover') ? $request->date_handover : null,
        ]);

        // Parking assignment
        $parkingIds = $request->input('parking_ids', []);
        $parkingIds = array_slice($parkingIds, 0, 3);

        foreach ($parkingIds as $parkingId) {
            ParkingAssignment::create([
                'parking_id' => $parkingId,
                'unit_id' => $request->unit_id,
                'resident_id' => $resident->id,
                'assigned_at' => now(),
                'notes' => 'Assigned to resident ' . $resident->full_name
            ]);

            ParkingLot::where('id', $parkingId)->update(['is_available' => false]);
        }

        // Dokumen
        $this->uploadDocument($request->ktp_file, $resident->id, $request->unit_id, 'KTP', true);

        if ($request->hasFile('ownership_file')) {
            $this->uploadDocument($request->ownership_file, $resident->id, $request->unit_id, 'Sertifikat Kepemilikan', true);
        }

        if ($request->hasFile('lease_file')) {
            $this->uploadDocument($request->lease_file, $resident->id, $request->unit_id, 'Kontrak Sewa', true);
        }

        if ($request->hasFile('doc_file')) {
            foreach ($request->doc_file as $index => $file) {
                if ($file && isset($request->doc_type[$index]) && $request->doc_type[$index]) {
                    $this->uploadDocument($file, $resident->id, $request->unit_id, $request->doc_type[$index]);
                }
            }
        }

        return redirect()->route('admin.master.residents.index')
            ->with('success', 'Penghuni berhasil ditambahkan!');
    }

    // Helper: Upload dokumen
    private function uploadDocument($file, $residentId, $unitId, $type, $isRequired = false)
    {
        $path = $file->store('documents/residents', 'public');
        Document::create([
            'resident_id' => $residentId,
            'unit_id' => $unitId,
            'document_type' => $type,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'is_required' => $isRequired,
        ]);
    }

    public function show(Resident $resident)
    {
        // PERBAIKAN: Gunakan activeParkingAssignment instead of parkingAssignments
        $resident->load([
            'units.tower',
            'familyMembers',
            'staffs',
            'documents',
            'activeParkingAssignment.parkingLot.parkingArea' // Pastikan relasi lengkap
        ]);

        $data = [
            'content' => 'admin.residents.show',
            'resident' => $resident,
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function edit(Resident $resident)
    {
        // Load relasi
        $resident->load('units', 'activeParkingAssignment.parkingLot.parkingArea', 'familyMembers', 'staffs', 'documents');

        // Ambil semua unit
        $units = Unit::with('tower', 'floor')->get();

        // Ambil unit aktif
        $currentUnit = $resident->units->first();

        // Ambil semua tower
        $towers = Tower::all();

        // PERBAIKAN: Ambil parking lot yang available ATAU yang sedang digunakan oleh resident ini
        $parkingLots = ParkingLot::with('parkingArea')
            ->where(function ($query) use ($resident) {
                $query->where('is_available', true)
                    ->orWhereIn('id', $resident->activeParkingAssignment->pluck('parking_id'));
            })
            ->get();

        $data = [
            'content' => 'admin.residents.edit',
            'resident' => $resident,
            'units' => $units,
            'currentUnit' => $currentUnit,
            'parkingLots' => $parkingLots,
            'towers' => $towers,
        ];

        return view('admin.layouts.wrapper', $data);
    }

    public function update(Request $request, Resident $resident)
    {
        // ✅ VALIDASI UTAMA: Field dokumen dibuat sepenuhnya opsional di sini
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:residents,email,' . $resident->id,
            'identity_number' => 'nullable|string|unique:residents,identity_number,' . $resident->id,
            'unit_id' => 'required|exists:units,id',
            'role' => 'required|in:Owner,Leasee,Co-Owner,Co-Leasee',
            'start_date' => 'required|date',
            'family_members.*.name' => 'nullable|string|max:255',
            'family_members.*.relationship' => 'nullable|string|max:100',
            'staff_members.*.name' => 'nullable|string|max:255',
            'staff_members.*.type' => 'nullable|string|max:50',
            'parking_ids' => 'nullable|array|max:3',
            'parking_ids.*' => 'exists:parking_lots,id',

            'date_sold' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->role === 'Owner' && empty($value)) {
                        $fail('Tanggal penjualan wajib diisi untuk Owner.');
                    }
                },
            ],
            'date_handover' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->role === 'Owner' && empty($value)) {
                        $fail('Tanggal serah terima wajib diisi untuk Owner.');
                    }
                },
            ],

            // ✅ DIUBAH: Hapus 'required_with', buat jadi 'nullable' agar tidak wajib
            'document_type' => 'nullable|string|max:255',
            'document_file' => ['nullable', 'file', 'max:10240'], // 10MB
        ]);

        // 1. UPDATE DATA DASAR RESIDENT (Tidak ada perubahan di sini)
        $data = $request->only(
            'full_name',
            'phone',
            'email',
            'identity_number',
            'citizenship',
            'religion',
            'place_of_birth',
            'date_of_birth',
            'gender',
            'occupation',
            'company',
            'agent_name',
            'agent_company',
            'number_agent'
        );
        $resident->update($data);
        $resident->update([
            'is_owner' => in_array($request->role, ['Owner', 'Co-Owner']) ? 1 : 0,
        ]);


        // 2. UPDATE RELASI UNIT (Tidak ada perubahan di sini)
        $resident->units()->detach();
        $isPrimary = in_array($request->role, ['Owner', 'Co-Owner']);
        if ($isPrimary) {
            DB::table('unit_residents')
                ->where('unit_id', $request->unit_id)
                ->where('is_primary', true)
                ->where('resident_id', '!=', $resident->id)
                ->update(['is_primary' => false]);
        }
        $pivotData = [
            'role' => $request->role,
            'start_date' => $request->start_date,
            'end_date' => $request->filled('end_date') ? $request->end_date : null,
            'is_primary' => $isPrimary,
            'date_sold' => $request->filled('date_sold') ? $request->date_sold : null,
            'date_handover' => $request->filled('date_handover') ? $request->date_handover : null,
        ];
        $resident->units()->attach($request->unit_id, $pivotData);


        // 3. LOGIKA HISTORY SEWA (Tidak ada perubahan di sini)
        if ($request->role === 'Leasee' && $request->filled('end_date')) {
            // ... (logika history sewa Anda tetap sama)
        }

        // 4. UPDATE PARKIR, KELUARGA, DAN STAF (Tidak ada perubahan di sini)
        $this->updateParkingAssignment($resident, $request->input('parking_ids', []), $request->unit_id);
        // ... (logika update family dan staff Anda tetap sama)


        // 5. ✅ PROSES UPLOAD DOKUMEN BARU (JIKA ADA) DENGAN LOGIKA BARU
        if ($request->hasFile('document_file')) {
            // ✅ VALIDASI KEDUA: Lakukan validasi khusus hanya jika ada file yang diupload
            $request->validate([
                'document_type' => 'required|string|max:255',
                'document_file' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
                        if (!in_array(strtolower($value->getClientOriginalExtension()), $allowedExtensions)) {
                            $fail('Hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan.');
                        }
                    },
                ]
            ]);

            $file = $request->file('document_file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $mimeType = $file->getMimeType();

            $fileName = \Illuminate\Support\Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_' . time() . '.' . $extension;
            $filePath = $file->storeAs('residents/documents/' . $resident->id, $fileName, 'public');

            $resident->documents()->create([
                'document_type' => $request->input('document_type'),
                'file_name' => $originalName,
                'file_path' => $filePath,
                'file_size' => $file->getSize(),
                'mime_type' => $mimeType,
                'uploaded_by' => auth()->id(),
            ]);
        }

        return redirect()->route('admin.master.residents.index')
            ->with('success', 'Data penghuni berhasil diperbarui!');
    }
    private function updateParkingAssignment($resident, $parkingIds, $unitId)
    {
        $parkingIds = $parkingIds ?? [];
        $parkingIds = array_unique(array_filter($parkingIds, 'is_numeric'));
        $parkingIds = array_slice($parkingIds, 0, 3);

        // Dapatkan parking assignments yang aktif
        $currentAssignments = $resident->activeParkingAssignment;
        $currentParkingIds = $currentAssignments->pluck('parking_id')->toArray();

        // Hapus assignments yang tidak dipilih lagi
        $toRemove = array_diff($currentParkingIds, $parkingIds);
        foreach ($toRemove as $parkingId) {
            $assignment = $currentAssignments->where('parking_id', $parkingId)->first();
            if ($assignment) {
                $assignment->delete();
                ParkingLot::where('id', $parkingId)->update(['is_available' => true]);
            }
        }

        // Tambahkan assignments baru
        $toAdd = array_diff($parkingIds, $currentParkingIds);
        foreach ($toAdd as $parkingId) {
            // Pastikan parking lot tersedia
            $parkingLot = ParkingLot::find($parkingId);
            if ($parkingLot && $parkingLot->is_available) {
                ParkingAssignment::create([
                    'resident_id' => $resident->id,
                    'parking_id' => $parkingId,
                    'unit_id' => $unitId,
                    'assigned_at' => now(),
                    'notes' => 'Assigned to resident ' . $resident->full_name
                ]);
                ParkingLot::where('id', $parkingId)->update(['is_available' => false]);
            }
        }
    }


    public function destroy(Resident $resident)
    {
        // Ambil semua parking assignment yang masih aktif (belum dilepas)
        $activeAssignments = $resident->parkingAssignments()->whereNull('released_at')->get();

        foreach ($activeAssignments as $assignment) {
            // Update released_at dan notes
            $assignment->update([
                'released_at' => now(),
                'notes' => 'Released due to resident deletion'
            ]);

            // Kembalikan status parking lot ke "available"
            ParkingLot::where('id', $assignment->parking_id)->update(['is_available' => true]);
        }

        // Hapus penghuni setelah semua relasi diproses
        $resident->delete();

        return redirect()->route('admin.master.residents.index')
            ->with('success', 'Penghuni berhasil dihapus dan slot parkir dikembalikan!');
    }

    // Family
    public function storeFamily(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:100',
        ]);

        FamilyMember::create($request->all());
        return redirect()->back()->with('success', 'Anggota keluarga ditambahkan.');
    }

    public function destroyFamily(FamilyMember $familyMember)
    {
        $familyMember->delete();
        return redirect()->back()->with('success', 'Anggota keluarga dihapus.');
    }

    // Staff
    public function storeStaff(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        Staff::create($request->all());
        return redirect()->back()->with('success', 'Staf ditambahkan.');
    }

    public function destroyStaff(Staff $staff)
    {
        $staff->delete();
        return redirect()->back()->with('success', 'Staf dihapus.');
    }

    // Document
    public function storeDocument(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'document_type' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
        ]);

        $file = $request->file('file');
        $path = $file->store('documents/residents', 'public');

        Document::create([
            'resident_id' => $request->resident_id,
            'unit_id' => $request->unit_id,
            'document_type' => $request->document_type,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'is_required' => $request->is_required ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diupload.');
    }

    public function destroyDocument(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return redirect()->back()->with('success', 'Dokumen dihapus.');
    }


    public function releaseParking($id, Request $request)
    {
        try {
            $resident = Resident::findOrFail($id);

            $request->validate([
                'parking_id' => 'required|exists:parking_assignments,id'
            ]);

            $parkingAssignment = ParkingAssignment::findOrFail($request->parking_id);

            if ($parkingAssignment->resident_id != $resident->id) {
                return redirect()->back()
                    ->with('error', 'Akses tidak diperbolehkan.');
            }

            // Ambil ID parking lot dari assignment
            $parkingLotId = $parkingAssignment->parking_id;

            // Hapus assignment
            $parkingAssignment->delete();

            // 🔥 UPDATE: Set parking lot kembali tersedia
            ParkingLot::where('id', $parkingLotId)->update(['is_available' => true]);

            return redirect()->back()
                ->with('success', 'Slot parkir berhasil dilepaskan dan kembali tersedia.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }




    public function export($id, Excel $excel)
    {
        $resident = Resident::with([
            'units.tower',
            'units.floor',
            'familyMembers',
            'staffs',
            'activeParkingAssignment.parkingLot.parkingArea'
        ])->findOrFail($id);

        return $excel->download(new ResidentExport($resident), "resident_{$resident->full_name}_detail.xlsx");
    }
}
