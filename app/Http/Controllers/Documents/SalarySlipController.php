<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\MonthlySalary;
use App\Models\SalarySlip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalarySlipController extends Controller
{
    public function index(): View
    {
        $slips = SalarySlip::query()
            ->with(['monthlySalary.employee.department'])
            ->orderByDesc('generated_at')
            ->orderByDesc('id')
            ->paginate(15);

        return view('documents.salary-slips.index', compact('slips'));
    }

    public function create(): View
    {
        $employees = Employee::query()
            ->with(['department', 'designation'])
            ->orderBy('full_name')
            ->get();

        return view('documents.salary-slips.create', compact('employees'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'employee_id' => ['required', 'exists:employee,id'],
            'month' => ['required', 'integer', 'min:1', 'max:12'],
            'year' => ['required', 'integer', 'min:2000', 'max:2100'],
            'working_days' => ['nullable', 'integer', 'min:0'],
            'paid_days' => ['nullable', 'integer', 'min:0'],
            'gross_earning' => ['nullable', 'numeric', 'min:0'],
            'total_deduction' => ['nullable', 'numeric', 'min:0'],
            'net_payable' => ['required', 'numeric', 'min:0'],
        ]);

        $monthly = MonthlySalary::query()->updateOrCreate(
            [
                'employee_id' => $data['employee_id'],
                'month' => $data['month'],
                'year' => $data['year'],
            ],
            [
                'working_days' => $data['working_days'] ?? null,
                'paid_days' => $data['paid_days'] ?? null,
                'gross_earning' => $data['gross_earning'] ?? 0,
                'total_deduction' => $data['total_deduction'] ?? 0,
                'net_payable' => $data['net_payable'],
                'payment_status' => 0,
            ]
        );

        $slip = SalarySlip::query()->create([
            'monthly_salary_id' => $monthly->id,
            'generated_at' => now(),
            'file_path' => null,
            'is_emailed' => false,
        ]);

        return redirect()
            ->route('documents.salary-slips.preview', $slip)
            ->with('success', 'Salary slip generated. Use Print to save or print.');
    }

    public function preview(SalarySlip $salarySlip): View
    {
        $salarySlip->load(['monthlySalary.employee.department', 'monthlySalary.employee.designation']);

        $row = $salarySlip->monthlySalary;
        $employee = $row?->employee;

        return view('documents.print.salary-slip', [
            'slip' => $salarySlip,
            'monthlySalary' => $row,
            'employee' => $employee,
            'company' => config('company'),
        ]);
    }
}
