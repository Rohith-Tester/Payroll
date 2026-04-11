<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LeaveController extends Controller
{
    public function index(): View
    {
        return view('leaves.index');
    }
}
