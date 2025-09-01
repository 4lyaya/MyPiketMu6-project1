<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('guru');
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $teacherId = Auth::id(); // id user yang login
        $stats = $this->dashboardService->getGuruStats($teacherId);

        return view('teacher.dashboard', compact('stats'));
    }
}
