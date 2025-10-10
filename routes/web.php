<?php

use Illuminate\Support\Facades\Route;
use App\Models\Contact;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('admin/dashboard', [DashboardController::class, 'index'])
    ->name('backpack.custom.dashboard');

