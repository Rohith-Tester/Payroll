<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ExperienceLetter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceLetterController extends Controller
{
    public function index(): View
    {
        $letters = ExperienceLetter::query()
            ->with(['employee.department', 'issuer'])
            ->orderByDesc('issued_date')
            ->orderByDesc('id')
            ->paginate(15);

        return view('documents.experience-letters.index', compact('letters'));
    }

    public function create(): View
    {
        $employees = Employee::query()
            ->with(['department', 'designation'])
            ->orderBy('full_name')
            ->get();

        return view('documents.experience-letters.create', compact('employees'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'employee_id' => ['required', 'exists:employee,id'],
            'issued_date' => ['nullable', 'date'],
            'last_working_date' => ['nullable', 'date'],
        ]);

        $letter = ExperienceLetter::query()->create([
            'employee_id' => $data['employee_id'],
            'issued_date' => $data['issued_date'] ?? now(),
            'file_path' => null,
            'issued_by' => auth()->id(),
        ]);

        if (! empty($data['last_working_date'])) {
            $request->session()->put('experience_letter_lwd_'.$letter->id, $data['last_working_date']);
        }

        return redirect()
            ->route('documents.experience-letters.preview', $letter)
            ->with('success', 'Experience letter generated. Use Print to save or print.');
    }

    public function preview(ExperienceLetter $experienceLetter): View
    {
        $experienceLetter->load(['employee.department', 'employee.designation', 'issuer']);

        $lastWorkingDate = session('experience_letter_lwd_'.$experienceLetter->id);

        return view('documents.print.experience-letter', [
            'letter' => $experienceLetter,
            'employee' => $experienceLetter->employee,
            'lastWorkingDate' => $lastWorkingDate ? \Illuminate\Support\Carbon::parse($lastWorkingDate) : null,
            'issuer' => $experienceLetter->issuer,
            'company' => config('company'),
        ]);
    }
}
