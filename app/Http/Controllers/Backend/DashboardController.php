<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('backend/dashboard/Index');
    }

    public function redirectToIndex()
    {
        return to_route('backend.dashboard.index');
    }
}
