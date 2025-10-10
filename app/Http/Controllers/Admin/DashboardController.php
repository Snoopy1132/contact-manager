<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = backpack_auth()->user();
        $contactsCount = Contact::count();

        return view('admin.dashboard', compact('user', 'contactsCount'));
    }
}
