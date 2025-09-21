<?php

namespace App\Http\Controllers;

use App\Exports\ResidentExportBulk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ResidentExportController extends Controller
{
    public function export(Request $request)
    {
        $type = $request->query('type', 'all');

        $validTypes = ['all', 'owner', 'leasee_active', 'leasee_expired'];
        if (!in_array($type, $validTypes)) {
            abort(400, 'Invalid export type.');
        }

        return Excel::download(
            new ResidentExportBulk($type),
            "residents_{$type}_" . now()->format('Y-m-d') . ".xlsx"
        );
    }
}
