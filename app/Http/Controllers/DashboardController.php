<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'employeeCount' => Employee::query()->count(),
            'departmentCount' => Department::query()->count(),
            'attendanceToday' => Attendance::query()->whereDate('date', today())->count(),
        ]);
    }
}
