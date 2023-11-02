<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private DashboardService $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    public function index()
    {
        $roleId = session('role_id');
        return view('pages.dashboard');
    }
}
