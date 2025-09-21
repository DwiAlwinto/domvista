<?php

namespace App\Http\Controllers;


use App\Models\Unit;
use App\Models\Tower;

use App\Models\WorkOrder;

use Illuminate\Http\Request;
use App\Models\ConciergeStaff;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; // Import Rule class

use App\Exports\WorkOrderExport;
use Maatwebsite\Excel\Facades\Excel;


class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //

    public function exportToExcelByDate(Request $request)
    {
        $request->validate(['date' => 'required|date']);

        $date = $request->date;

        $workOrders = WorkOrder::with(['tower', 'unit'])
            ->whereDate('schedule_date', $date)
            ->get();

        return Excel::download(
            new WorkOrderExport($workOrders, $date),
            'WORK_ORDERS_' . str_replace('-', '', $date) . '.xlsx'
        );
    }
    public function index()
    {
        $query = WorkOrder::with(['tower', 'unit', 'concierges'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Filter by date range
        if (request('start_date')) {
            $query->whereDate('schedule_date', '>=', request('start_date'));
        }
        if (request('end_date')) {
            $query->whereDate('schedule_date', '<=', request('end_date'));
        }

        $workOrders = $query->paginate(10);

        // Ambil semua tower untuk dropdown filter
        $towers = \App\Models\Tower::orderBy('name')->get(); // Ganti dengan namespace model Anda jika berbeda

        $data = [
            'title' => 'Work Order Monitoring',
            'workOrders' => $workOrders,
            'towers' => $towers, // ← tambahkan ini
            'content' => 'admin.wo.index'
        ];

        return view('admin.layouts.wrapper', $data);
    }

    function create()
    {
        $data = [
            'title' => 'Tambah Work Order',
            'towers' => Tower::all(),
            'units' => Unit::with(['tower', 'unitType'])->get(),
            'concierges' => ConciergeStaff::with('user')->get(),
            'content' => 'admin.wo.add'
        ];

        return view('admin.layouts.wrapper', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'wo_no' => 'required|unique:work_orders,wo_no|max:50',
            'tower_id' => 'required|exists:towers,id',
            'unit_id' => 'required|exists:units,id',
            'date_request_wo' => 'required|date',
            'tenant_name' => 'required|string|max:100',
            'work_description' => 'required|string',
            'details' => 'nullable|string',
            'schedule_date' => 'required|date|after_or_equal:today',
            'time_schedule' => 'nullable|date_format:H:i',
            'status' => 'required|in:On Progress,Proses,Reschedule',
            'present' => 'boolean'
        ]);

        // Set default values
        $validated['present'] = $request->boolean('present');

        try {
            $workOrder = WorkOrder::create($validated);

            return redirect()->route('work-orders.index')
                ->with('success', 'Work Order berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal membuat Work Order: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workOrder = WorkOrder::with(['tower', 'unit', 'doneBy', 'concierges.user'])->findOrFail($id);

        $data = [
            'title' => 'Detail Work Order',
            'workOrder' => $workOrder,
            'content' => 'admin.wo.show'
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $workOrder = WorkOrder::with(['tower', 'unit'])->findOrFail($id);
        $towers = Tower::all();
        $units = Unit::with(['tower', 'unitType', 'floor'])->get();

        $data = [
            'title' => 'Edit Work Order',
            'workOrder' => $workOrder,
            'towers' => $towers,
            'units' => $units,
            'content' => 'admin.wo.edit'
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $workOrder = WorkOrder::findOrFail($id);

        $validated = $request->validate([
            'wo_no' => ['required', 'max:50', Rule::unique('work_orders')->ignore($workOrder->id)],
            'tower_id' => 'required|exists:towers,id',
            'unit_id' => 'required|exists:units,id',
            'date_request_wo' => 'required|date',
            'tenant_name' => 'required|string|max:100',
            'work_description' => 'required|string',
            'details' => 'nullable|string',
            'schedule_date' => 'required|date',
            'time_schedule' => 'nullable|date_format:H:i',
            'status' => 'required|in:On Progress,Proses,Done,Cancel,Reschedule',
            'present' => 'boolean',

            // Engineer
            'engineer_name' => 'nullable|string|max:100',
            'engineer_notes' => 'nullable|string',
            'assigned_at' => 'nullable|date',

            // Cancellation
            'cancel_reason' => 'nullable|required_if:status,Cancel|string|max:500',
            'canceled_by' => 'nullable|exists:users,id',

            // Completion
            'deskripsi_wo_done' => 'nullable|required_if:status,Done|string|max:1000',
            'wo_done_at' => 'nullable|date',
            'wo_done_by' => 'nullable|exists:users,id',
        ]);

        $validated['present'] = $request->boolean('present');

        // Selalu pertahankan data engineer dari DB jika tidak direset
        $validated['engineer_name'] = $workOrder->engineer_name;
        $validated['engineer_notes'] = $workOrder->engineer_notes;
        $validated['assigned_at'] = $workOrder->assigned_at;

        // Handle engineer (Proses) — hanya ubah jika status = Proses
        if ($request->status === 'Proses') {
            $validated['engineer_name'] = $request->engineer_name;
            $validated['engineer_notes'] = $request->engineer_notes;

            // Set assigned_at hanya sekali
            if (!$workOrder->assigned_at) {
                $validated['assigned_at'] = $request->assigned_at ?? now();
            }

            // Reset cancellation
            $validated['cancel_reason'] = null;
            $validated['canceled_by'] = null;
        }

        // Handle cancellation
        if ($request->status === 'Cancel') {
            $validated['cancel_reason'] = $request->cancel_reason;
            $validated['canceled_by'] = $request->canceled_by;

            // Opsional: reset engineer saat cancel
            $validated['engineer_name'] = null;
            $validated['engineer_notes'] = null;
            $validated['assigned_at'] = null;

            // Reset completion data
            $validated['deskripsi_wo_done'] = null;
            $validated['wo_done_at'] = null;
            $validated['wo_done_by'] = null;
        }

        // Handle Done
        if ($request->status === 'Done') {
            $validated['deskripsi_wo_done'] = $request->deskripsi_wo_done;
            $validated['wo_done_at'] = $request->wo_done_at ?? now();
            $validated['wo_done_by'] = $request->wo_done_by;

            // ✅ JANGAN sentuh engineer_name, engineer_notes, assigned_at
            // Mereka sudah di-set dari data lama di atas

            // Reset cancellation jika sebelumnya cancel
            if ($workOrder->status === 'Cancel') {
                $validated['cancel_reason'] = null;
                $validated['canceled_by'] = null;
            }
        }

        try {
            DB::beginTransaction();
            $workOrder->update($validated);
            DB::commit();

            return redirect()->route('admin.wo.index')
                ->with('success', 'Work Order updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to update Work Order: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for deleting the specified resource.
     */
    public function destroy(string $id)
    {
        $workOrder = WorkOrder::findOrFail($id);

        try {
            $workOrder->delete();
            return redirect()->route('admin.wo.index')
                ->with('success', 'Work Order berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus Work Order: ' . $e->getMessage());
        }
    }
}
