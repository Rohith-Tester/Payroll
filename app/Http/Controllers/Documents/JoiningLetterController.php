<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\JoiningLetter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JoiningLetterController extends Controller
{
    public function index(): View
    {
        $letters = JoiningLetter::query()
            ->with(['employee.department', 'employee.designation'])
            ->orderByDesc('issued_date')
            ->orderByDesc('id')
            ->paginate(15);

        return view('documents.joining-letters.index', compact('letters'));
    }

    public function create(): View
    {
        $employees = Employee::query()
            ->with(['department', 'designation'])
            ->orderBy('full_name')
            ->get();

        return view('documents.joining-letters.create', compact('employees'));
    }

    public function store($id): RedirectResponse
    {
        
        $employee = Employee::find($id)->first();
        $letter = JoiningLetter::query()->create([
            'employee_id' => $employee->id,
            'joining_date' => $employee->joining_date,
            'issued_date' => date('Y-m-d'),
            'salary' => $employee?->salary?->ctc ,
            'file_path' => '',
        ]);

        return redirect()
            ->route('documents.joining-letters.preview', $letter)
            ->with('success', 'Appointment letter generated. Use Print to save or print.');
    }

    public function preview(JoiningLetter $joiningLetter): View
    {
        $joiningLetter->load(['employee.department', 'employee.designation']);

        return view('documents.print.joining-letter', [
            'letter' => $joiningLetter,
            'employee' => $joiningLetter->employee,
            'company' => config('company'),
        ]);
    }
}
