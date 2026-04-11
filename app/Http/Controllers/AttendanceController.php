<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $records = Attendance::query()
            ->with('employee')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(25);

        return view('attendance.index', compact('records'));
    }
}
