<?php

use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBukuController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\AdminJenisController;
use App\Http\Controllers\AdminAnggotaController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminPenerbitController;
use App\Http\Controllers\Admin\ResidentController;
use App\Exports\ResidentExportBulk;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\ResidentExportController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔐 Login & Logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
    Route::post('/login/do', [AdminAuthController::class, 'doLogin']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

Route::get('/export-residents', [ResidentExportController::class, 'export'])
    ->name('residents.export');

Route::get('/admin/master/residents/{id}/export', [ResidentController::class, 'export'])->name('admin.master.residents.export');

Route::get('/logbook/{id}/export/excel', [LogbookController::class, 'exportToExcel'])
    ->name('admin.logbook.export.excel');

// Rute untuk export WO per tanggal
Route::get('/admin/wo/export/excel', [WorkOrderController::class, 'exportToExcelByDate'])
    ->name('admin.wo.export.excel');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // 🏠 Dashboard
    Route::get('/', function () {
        return view('admin.auth.login');
    });

    Route::get('/home', function () {
        $data = ['content' => 'admin.dashboard.index'];
        return view('admin.layouts.wrapper', $data);
    })->name('home');

    Route::get('/admin/dashboard', function () {
        $data = ['content' => 'admin.dashboard.index'];
        return view('admin.layouts.wrapper', $data);
    })->name('admin.dashboard');

    // 👤 User Management
    //Route::resource('/admin/user', AdminUserController::class);
    Route::middleware(['auth', 'can:view-user-data'])->group(function () {
        Route::resource('/admin/user', AdminUserController::class);
    });
    // 🧑‍💼 Staff Area
    Route::get('/admin/staff/tasks', function () {
        $myTasks = \App\Models\LogbookEntry::where('user_done', Auth::id())
            ->orWhere('status', 'On Progress')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'tasks' => $myTasks,
            'content' => 'admin.staff.tasks.index'
        ];
        return view('admin.layouts.wrapper', $data);
    })->name('admin.staff.tasks');

    Route::get('/admin/staff/logbook/today', function () {
        $todayLogbook = \App\Models\Logbook::whereDate('logbook_date', today())->first();

        $data = [
            'logbook' => $todayLogbook,
            'content' => 'admin.staff.logbook.today'
        ];
        return view('admin.layouts.wrapper', $data);
    })->name('admin.staff.logbook.today');

    // 🏗️ Master Data
    Route::prefix('admin/master')->as('admin.master.')->group(function () {
        Route::resource('anggota', AdminAnggotaController::class);
        Route::resource('jenis', AdminJenisController::class);
        Route::resource('kategori', AdminKategoriController::class);
        Route::resource('penerbit', AdminPenerbitController::class);


        // ✅ Hanya 1 kali resource untuk residents
        Route::resource('residents', ResidentController::class)->names([
            'index' => 'residents.index',
            'create' => 'residents.create',
            'store' => 'residents.store',
            'show' => 'residents.show',
            'edit' => 'residents.edit',
            'update' => 'residents.update',
            'destroy' => 'residents.destroy'
        ])->parameters([
            'residents' => 'resident'
        ]);

        // 🔧 Fitur tambahan untuk penghuni
        Route::post('residents/{resident}/family', [ResidentController::class, 'storeFamily'])->name('residents.storeFamily');
        Route::delete('residents/family/{familyMember}', [ResidentController::class, 'destroyFamily'])->name('residents.destroyFamily');

        Route::post('residents/{resident}/staff', [ResidentController::class, 'storeStaff'])->name('residents.storeStaff');
        Route::delete('residents/staff/{staff}', [ResidentController::class, 'destroyStaff'])->name('residents.destroyStaff');

        Route::post('residents/{resident}/document', [ResidentController::class, 'storeDocument'])->name('residents.storeDocument');
        Route::delete('residents/document/{document}', [ResidentController::class, 'destroyDocument'])->name('residents.destroyDocument');

        // ✅ TAMBAHKAN ROUTE INI UNTUK RELEASE PARKING
        Route::post('residents/{resident}/release-parking', [ResidentController::class, 'releaseParking'])
            ->name('residents.release-parking');
    });

    // 🛠️ Work Order (WO)
    Route::prefix('admin/wo')->as('admin.wo.')->group(function () {
        Route::get('/list', [WorkOrderController::class, 'index'])->name('index');
        Route::get('/add', [WorkOrderController::class, 'create'])->name('create');
        Route::post('/add', [WorkOrderController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WorkOrderController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [WorkOrderController::class, 'update'])->name('update');
        Route::get('/show/{id}', [WorkOrderController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [WorkOrderController::class, 'destroy'])->name('destroy');

        // 🔗 API untuk unit berdasarkan tower
        Route::get('/api/towers/{towerId}/units', function ($towerId) {
            $units = Unit::with(['floor', 'unitType'])
                ->where('tower_id', $towerId)
                ->get(['id', 'unit_code', 'tower_id', 'floor_id', 'unit_type_id']);
            return response()->json($units);
        })->name('api.towers.units');

        // 🔐 Verifikasi untuk aksi kritis
        Route::post('/verify', [VerificationController::class, 'verifyCredentials'])->name('verify');
    });

    // 📓 Logbook
    Route::prefix('admin/logbook')->as('admin.logbook.')->group(function () {
        Route::get('/', [LogbookController::class, 'index'])->name('index');
        Route::get('/create', [LogbookController::class, 'create'])->name('create');
        Route::post('/', [LogbookController::class, 'store'])->name('store');
        Route::get('/{id}', [LogbookController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [LogbookController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LogbookController::class, 'update'])->name('update');
        Route::delete('/{logbook}', [LogbookController::class, 'destroy'])->name('destroy');
        Route::delete('/entries/{entry}', [LogbookController::class, 'destroyEntry'])->name('entries.destroy');

        // Status update
        Route::post('/{logbook}/mark-completed', [LogbookController::class, 'markAsCompleted'])->name('mark-completed');
        Route::post('/{logbook}/mark-progress', [LogbookController::class, 'markAsProgress'])->name('mark-progress');
    });

    // 🔐 Verifikasi umum (opsional)
    Route::post('/verify-credentials', [VerificationController::class, 'verifyCredentials'])->name('verify.credentials');
});
