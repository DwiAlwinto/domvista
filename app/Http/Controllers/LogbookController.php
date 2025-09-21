<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Logbook;
use App\Models\LogbookEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Exports\LogbookExport;
use Maatwebsite\Excel\Facades\Excel;


class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function exportToExcel($id)
    {
        $logbook = Logbook::with(['entries.userDone'])->findOrFail($id);

        return Excel::download(
            new LogbookExport($logbook),
            'LOGBOOK_' . $logbook->logbook_number . '_' . now()->format('Y-m-d') . '.xlsx'
        );
    }


    public function index(Request $request)
    {
        $query = Logbook::query()->with('entries')->latest();

        // Filter pencarian
        if ($request->has('search')) {
            $query->where('logbook_number', 'like', '%' . $request->search . '%');
        }

        // Filter tanggal - jika tidak ada date, default ke hari ini (WIB)
        $selectedDate = $request->date ?? Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $query->whereDate('logbook_date', $selectedDate);

        // Filter status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $logbooks = $query->paginate(10);

        $data = [
            'title'   => 'Manajemen Logbook',
            'logbooks' => $logbooks,
            'content' => 'admin.logbook.index'
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Set timezone Jakarta secara eksplisit
        $today = Carbon::now('Asia/Jakarta');

        // 1. Cek logbook hari ini dengan timezone Jakarta
        $todayLogbook = Logbook::whereDate('logbook_date', $today->format('Y-m-d'))->first();

        if ($todayLogbook) {
            return redirect()
                ->route('admin.logbook.show', $todayLogbook->id)
                ->with('info', 'Logbook hari ini sudah ada.');
        }

        // 2. Ambil semua entri belum selesai (On Progress) dari semua logbook sebelumnya
        $previousEntries = LogbookEntry::where('status', 'On Progress')
            ->whereHas('logbook', function ($query) use ($today) {
                $query->whereDate('logbook_date', '<', $today->format('Y-m-d'));
            })
            ->orderBy('tower')
            ->orderBy('unit')
            ->get();

        // 3. Format data untuk view
        $data = [
            'title'            => 'Tambah Logbook - ' . $today->format('d/m/Y'),
            'content'         => 'admin.logbook.create',
            'unfinishedEntries' => $previousEntries,
            'hasUnfinished'   => $previousEntries->isNotEmpty(),
            'currentDate'     => $today->format('Y-m-d'),
            'currentTime'     => $today->format('H:i'),
            'previousDate'    => $today->copy()->subDay()->format('d F Y') // Tetap tampilkan tanggal kemarin untuk referensi
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta');

        $validator = Validator::make($request->all(), [
            'logbook_date'   => 'required|date',
            'logbook_number' => 'required|string|max:255|unique:logbooks,logbook_number',
            'mod'            => 'required|string|max:255',
            'chief_tr'       => 'required|string|max:255',
            'chief_enginer'  => 'required|string|max:255',
            'chief_security' => 'required|string|max:255',
            'chief_hk'       => 'required|string|max:255',
            'c_morning'      => 'required|string|max:255',
            'c_afternoon'    => 'required|string|max:255',
            'c_evening'      => 'required|string|max:255',
            'hc_morning'     => 'required|string|max:255',
            'hc_afternoon'   => 'required|string|max:255',
            'enginer_morning'    => 'required|string|max:255',
            'enginer_afternoon'  => 'required|string|max:255',
            'enginer_night'      => 'required|string|max:255',
            'hk_morning'     => 'required|string|max:255',
            'hk_afternoon'   => 'required|string|max:255',
            'hk_night'       => 'required|string|max:255',
            'sec_morning'    => 'required|string|max:255',
            'sec_afternoon'  => 'required|string|max:255',
            'sec_night'      => 'required|string|max:255',
            'hse_morning'    => 'required|string|max:255',
            'hse_afternoon'  => 'required|string|max:255',
            'hse_night'      => 'required|string|max:255',
            'entries'              => 'required|array|min:1',
            'entries.*.tower'     => 'required|string|max:255',
            'entries.*.unit'      => 'required|string|max:255',
            'entries.*.status'    => 'required|string|in:On Progress,Set Schedule,Reschedule,Done,Cancel',
            'entries.*.description' => 'required|string',
            'entries.*.result' => 'required_if:entries.*.status,Done',
        ], [
            'entries.*.result.required_if' => 'The result field is required when status is Done.',
        ]);

        $validator->after(function ($validator) use ($request) {
            foreach ($request->entries as $index => $entry) {
                if ($entry['status'] === 'Done' && empty($entry['result'])) {
                    $validator->errors()->add(
                        "entries.$index.result",
                        "Result is required for Tower {$entry['tower']} Unit {$entry['unit']} when status is Done"
                    );
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please check the form for errors');
        }

        DB::beginTransaction();
        try {
            // 1. Create main logbook first
            $logbook = Logbook::create([
                'logbook_date'    => $request->logbook_date,
                'logbook_number'  => $request->logbook_number,
                'status'          => 'On Progress',
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);

            // 2. Create staff data associated with the logbook
            $logbook->staff()->create([
                'mod'               => $request->mod,
                'chief_tr'          => $request->chief_tr,
                'chief_enginer'     => $request->chief_enginer,
                'chief_security'    => $request->chief_security,
                'chief_hk'          => $request->chief_hk,
                'c_morning'         => $request->c_morning,
                'c_afternoon'       => $request->c_afternoon,
                'c_evening'         => $request->c_evening,
                'hc_morning'        => $request->hc_morning,
                'hc_afternoon'      => $request->hc_afternoon,
                'enginer_morning'   => $request->enginer_morning,
                'enginer_afternoon' => $request->enginer_afternoon,
                'enginer_night'     => $request->enginer_night,
                'hk_morning'        => $request->hk_morning,
                'hk_afternoon'      => $request->hk_afternoon,
                'hk_night'          => $request->hk_night,
                'sec_morning'       => $request->sec_morning,
                'sec_afternoon'     => $request->sec_afternoon,
                'sec_night'         => $request->sec_night,
                'hse_morning'       => $request->hse_morning,
                'hse_afternoon'     => $request->hse_afternoon,
                'hse_night'         => $request->hse_night,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);

            // 3. Create entries
            foreach ($request->entries as $entry) {
                $logbook->entries()->create([
                    'tower'       => $entry['tower'],
                    'unit'        => $entry['unit'],
                    'status'      => $entry['status'],
                    'description' => $entry['description'],
                    'result'      => $entry['result'] ?? null,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);
            }

            // Update status based on entries
            $logbook->updateStatus();

            DB::commit();
            return redirect()->route('admin.logbook.index')->with('success', 'Logbook created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create logbook: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $logbook = Logbook::with(['staff', 'entries.userDone'])->findOrFail($id);
        $previousEntries = Logbook::whereDate('logbook_date', '<', $logbook->logbook_date)
            ->with(['entries' => function ($query) {
                $query->where('status', 'On Progress');
            }])
            ->get()
            ->pluck('entries')
            ->flatten();
        $unfinishedCount = $previousEntries->count();
        $data = [
            'title'           => 'Detail Logbook',
            'logbook'         => $logbook,
            'previousEntries' => $previousEntries,
            'hasUnfinished'   => $unfinishedCount > 0,
            'unfinishedCount' => $unfinishedCount,
            'content'         => 'admin.logbook.show'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $logbook = Logbook::with(['staff', 'entries.userDone'])->findOrFail($id);
        $now = Carbon::now('Asia/Jakarta');

        $previousDate = Carbon::parse($logbook->logbook_date, 'Asia/Jakarta')->subDay();
        $previousLogbook = Logbook::whereDate('logbook_date', $previousDate)
            ->with(['entries' => function ($query) {
                $query->where('status', 'On Progress');
            }])
            ->first();

        $data = [
            'title' => 'Edit Logbook',
            'logbook' => $logbook,
            'previousEntries' => $previousLogbook ? $previousLogbook->entries : collect(),
            'hasUnfinished' => $previousLogbook && $previousLogbook->entries->isNotEmpty(),
            'currentDate' => $now->format('Y-m-d'),
            'currentTime' => $now->format('H:i'),
            'content' => 'admin.logbook.edit'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $now = Carbon::now('Asia/Jakarta');

        $validator = Validator::make($request->all(), [
            'logbook_date'   => 'required|date',
            'logbook_number' => 'required|string|max:255|unique:logbooks,logbook_number,' . $id,
            'mod'            => 'required|string|max:255',
            'chief_tr'       => 'required|string|max:255',
            'chief_enginer'  => 'required|string|max:255',
            'chief_security' => 'required|string|max:255',
            'chief_hk'       => 'required|string|max:255',
            'c_morning'      => 'required|string|max:255',
            'c_afternoon'    => 'required|string|max:255',
            'c_evening'      => 'required|string|max:255',
            'hc_morning'     => 'required|string|max:255',
            'hc_afternoon'   => 'required|string|max:255',
            'enginer_morning'    => 'required|string|max:255',
            'enginer_afternoon'  => 'required|string|max:255',
            'enginer_night'      => 'required|string|max:255',
            'hk_morning'     => 'required|string|max:255',
            'hk_afternoon'   => 'required|string|max:255',
            'hk_night'       => 'required|string|max:255',
            'sec_morning'    => 'required|string|max:255',
            'sec_afternoon'  => 'required|string|max:255',
            'sec_night'      => 'required|string|max:255',
            'hse_morning'    => 'required|string|max:255',
            'hse_afternoon'  => 'required|string|max:255',
            'hse_night'      => 'required|string|max:255',
            'entries'               => 'sometimes|array',
            'entries.*.id'          => 'sometimes|exists:logbook_entries,id',
            'entries.*.tower'       => 'required|string|max:255',
            'entries.*.unit'        => 'required|string|max:255',
            'entries.*.status'      => 'required|string|in:On Progress,Set Schedule,Reschedule,Done,Cancel',
            'entries.*.description' => 'required|string',
            'entries.*.result'      => 'required_if:entries.*.status,Done',
            'carried_entries'               => 'sometimes|array',
            'carried_entries.*.id'          => 'required|exists:logbook_entries,id',
            'carried_entries.*.tower'       => 'required|string|max:255',
            'carried_entries.*.unit'        => 'required|string|max:255',
            'carried_entries.*.status'      => 'required|string|in:On Progress,Set Schedule,Reschedule,Done,Cancel',
            'carried_entries.*.description' => 'required|string',
            'carried_entries.*.result'      => 'required_if:carried_entries.*.status,Done',
        ], [
            'entries.*.result.required_if' => 'The result field is required when status is Done.',
            'carried_entries.*.result.required_if' => 'The result field is required when status is Done for carried over entries.',
        ]);

        $validator->after(function ($validator) use ($request) {
            foreach ($request->entries ?? [] as $index => $entry) {
                if ($entry['status'] === 'Done' && empty($entry['result'])) {
                    $validator->errors()->add("entries.$index.result", "Result is required for Tower {$entry['tower']} Unit {$entry['unit']} when status is Done");
                }
            }
            foreach ($request->carried_entries ?? [] as $index => $entry) {
                if ($entry['status'] === 'Done' && empty($entry['result'])) {
                    $validator->errors()->add("carried_entries.$index.result", "Result is required for carried over entry (Tower {$entry['tower']} Unit {$entry['unit']}) when status is Done");
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please check the form for errors');
        }

        DB::beginTransaction();
        try {
            $logbook = Logbook::with('entries')->findOrFail($id);

            // 1. Update logbook utama
            $logbook->update([
                'logbook_date'   => $request->logbook_date,
                'logbook_number' => $request->logbook_number,
                'updated_at'     => $now,
            ]);

            // 2. Update staff information
            $logbook->staff()->updateOrCreate(
                ['logbook_id' => $logbook->id],
                [
                    'mod'               => $request->mod,
                    'chief_tr'          => $request->chief_tr,
                    'chief_enginer'     => $request->chief_enginer,
                    'chief_security'    => $request->chief_security,
                    'chief_hk'          => $request->chief_hk,
                    'c_morning'         => $request->c_morning,
                    'c_afternoon'       => $request->c_afternoon,
                    'c_evening'         => $request->c_evening,
                    'hc_morning'        => $request->hc_morning,
                    'hc_afternoon'      => $request->hc_afternoon,
                    'enginer_morning'   => $request->enginer_morning,
                    'enginer_afternoon' => $request->enginer_afternoon,
                    'enginer_night'     => $request->enginer_night,
                    'hk_morning'        => $request->hk_morning,
                    'hk_afternoon'      => $request->hk_afternoon,
                    'hk_night'          => $request->hk_night,
                    'sec_morning'       => $request->sec_morning,
                    'sec_afternoon'     => $request->sec_afternoon,
                    'sec_night'         => $request->sec_night,
                    'hse_morning'       => $request->hse_morning,
                    'hse_afternoon'     => $request->hse_afternoon,
                    'hse_night'         => $request->hse_night,
                    'updated_at'    => $now,
                ]
            );

            // 3. Update, Create, atau Delete entries biasa
            $submittedEntryIds = [];
            if ($request->has('entries')) {
                foreach ($request->entries as $entryData) {
                    $entryId = $entryData['id'] ?? null;

                    $payload = [
                        'tower'       => $entryData['tower'],
                        'unit'        => $entryData['unit'],
                        'status'      => $entryData['status'],
                        'description' => $entryData['description'],
                        'result'      => $entryData['result'] ?? null,
                        'updated_at'  => $now,
                    ];

                    if ($entryId) {
                        // --- UPDATE ENTRI YANG ADA ---
                        $entryToUpdate = LogbookEntry::find($entryId);
                        if ($entryToUpdate) {
                            // Cek jika status diubah menjadi 'Done' dari status lain
                            if ($entryData['status'] === 'Done' && $entryToUpdate->status !== 'Done') {
                                $payload['time_done'] = $now;
                                $payload['user_done'] = Auth::id();
                            }
                            $entryToUpdate->update($payload);
                            $submittedEntryIds[] = $entryId;
                        }
                    } else {
                        // --- BUAT ENTRI BARU ---
                        if ($entryData['status'] === 'Done') {
                            $payload['time_done'] = $now;
                            $payload['user_done'] = Auth::id();
                        }
                        $newEntry = $logbook->entries()->create($payload);
                        $submittedEntryIds[] = $newEntry->id;
                    }
                }
            }
            // Hapus entri yang tidak ada dalam request (dihapus dari form)
            $logbook->entries()->whereNotIn('id', $submittedEntryIds)->delete();

            // 4. Update carried over entries
            if ($request->has('carried_entries')) {
                foreach ($request->carried_entries as $entryData) {
                    $entry = LogbookEntry::find($entryData['id']);
                    if ($entry) {
                        $updateData = [
                            'tower'       => $entryData['tower'],
                            'unit'        => $entryData['unit'],
                            'status'      => $entryData['status'],
                            'description' => $entryData['description'],
                            'result'      => $entryData['result'] ?? null,
                            'updated_at'  => $now,
                        ];

                        if ($entryData['status'] === 'Done' && $entry->status !== 'Done') {
                            $updateData['time_done'] = $now;
                            $updateData['user_done'] = Auth::id();
                        }

                        if ($entryData['status'] === 'Done' && empty($entry->original_date)) {
                            $updateData['original_date'] = $entry->created_at->timezone('Asia/Jakarta')->toDateString();
                        }

                        $entry->update($updateData);
                    }
                }
            }

            // 5. Muat ulang relasi dan perbarui status logbook
            $logbook->load('entries'); // <-- TAMBAHKAN BARIS INI
            $logbook->updateStatus();

            DB::commit();
            return redirect()->route('admin.logbook.show', $logbook->id)->with('success', 'Logbook updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Failed to update logbook: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $logbook = Logbook::with(['entries', 'staff'])->findOrFail($id);
            $logbook->entries()->delete();
            $logbook->staff()->delete();
            $logbook->delete();
            DB::commit();
            return redirect()->route('admin.logbook.index')->with('success', 'Logbook deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete logbook: ' . $e->getMessage());
        }
    }

    /**
     * Remove all entries from a logbook.
     */
    public function destroyEntry(string $entryId)
    {
        DB::beginTransaction();
        try {
            $entry = LogbookEntry::findOrFail($entryId);
            $entry->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Entry deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete entry: ' . $e->getMessage());
        }
    }
}
