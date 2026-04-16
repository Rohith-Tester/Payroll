<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\OfferLetter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Department ;
use App\Models\Designation;

class OfferLetterController extends Controller
{
    private const SESSION_PREFIX = 'offer_letter_extra_';

    public function index(): View
    {
        $letters = OfferLetter::query()
            ->with(['employee.department', 'employee.designation'])
            ->orderByDesc('issued_date')
            ->orderByDesc('id')
            ->paginate(15);

        return view('documents.offer-letters.index', compact('letters'));
    }

    public function create(): View
    {
        $employees = Employee::query()
            ->with(['department', 'designation', 'latestSalaryStructure'])
            ->orderBy('full_name')
            ->get();

        $designations = Designation::all();
        return view('documents.offer-letters.create', compact('employees' , 'designations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'employee_id' => ['required', 'exists:employee,id'],
            'offered_salary' => ['nullable', 'numeric', 'min:0'],
            'issued_date' => ['required', 'date'],
            'compensation_line' => ['nullable', 'string', 'max:500'],
            'conveyance' => ['nullable', 'numeric', 'min:0'],
            'vehicle_maintenance' => ['nullable', 'numeric', 'min:0'],
            'production_incentive' => ['nullable', 'numeric', 'min:0'],
            'pf_esi' => ['nullable', 'numeric', 'min:0'],
            'signatory_name' => ['nullable', 'string', 'max:120'],
        ]);

      
        $letter = OfferLetter::query()->create([
            'employee_id' => $data['employee_id'],
            'offered_salary' => $data['offered_salary'] ?? null,
            'file_path' => '',
            'issued_date' => $data['issued_date'],
            'accepted' => false,
        ]);

        $request->session()->put(self::SESSION_PREFIX.$letter->id, [
            'compensation_line' => $data['compensation_line'] ?? null,
            'conveyance' => $data['conveyance'] ?? null,
            'vehicle_maintenance' => $data['vehicle_maintenance'] ?? null,
            'production_incentive' => $data['production_incentive'] ?? null,
            'pf_esi' => $data['pf_esi'] ?? null,
            'signatory_name' => $data['signatory_name'] ?? null,
        ]);

        return redirect()
            ->route('documents.offer-letters.preview', $letter)
            ->with('success', 'Offer letter generated. Use Print to save or print.');
    }

    public function preview(OfferLetter $offerLetter): View
    {
        $offerLetter->load(['employee.department', 'employee.designation', 'employee.latestSalaryStructure']);

        $extra = session(self::SESSION_PREFIX.$offerLetter->id, []);
        $employee = $offerLetter->employee;
        $salary = $employee?->latestSalaryStructure;

        $roleTitle = $extra['role_title'] ?? null;
        $compensationLine = $extra['compensation_line'] ?? null;
        $signatoryName = $extra['signatory_name'] ?? config('company.signatory_name');

        $basic = (float) ($salary?->basic ?? 0);
        $hra = (float) ($salary?->hra ?? 0);
        $conveyance = (float) ($extra['conveyance'] ?? 0);
        $vehicleMaint = (float) ($extra['vehicle_maintenance'] ?? 0);
        $prodIncentive = (float) ($extra['production_incentive'] ?? 0);

        $sumComponents = $basic + $hra + $conveyance + $vehicleMaint + $prodIncentive;
        $grossFromSalary = $salary ? (float) $salary->gross : 0.0;
        // Prefer sum of annex line items when present; otherwise use gross from salary_structure
        $grossPay = $sumComponents > 0
            ? round($sumComponents, 2)
            : ($grossFromSalary > 0 ? $grossFromSalary : 0.0);

        $pfEsi = isset($extra['pf_esi']) && $extra['pf_esi'] !== '' && $extra['pf_esi'] !== null
            ? (float) $extra['pf_esi']
            : null;

        $ctc = $salary && $salary->ctc !== null ? (float) $salary->ctc : null;
        if ($pfEsi === null && $ctc !== null && $ctc >= $grossPay) {
            $pfEsi = round($ctc - $grossPay, 2);
        }
        if ($pfEsi === null) {
            $pfEsi = 0.0;
        }

        $totalCtc = $ctc !== null ? $ctc : round($grossPay + $pfEsi, 2);

        if ($compensationLine === null && $offerLetter->offered_salary !== null) {
            $compensationLine = 'Rs '.number_format((float) $offerLetter->offered_salary, 0).' per month + Retirals';
        }

        $footerLine = config('company.footer_address')
            ?? trim(implode(', ', array_filter([
                config('company.name'),
                config('company.address_line1'),
                config('company.address_line2'),
            ])));

        return view('documents.print.offer-letter', [
            'letter' => $offerLetter,
            'employee' => $employee,
            'roleTitle' => $roleTitle,
            'company' => config('company'),
            'compensationLine' => $compensationLine,
            'signatoryName' => $signatoryName,
            'footerLine' => $footerLine,
            'annex' => [
                'basic' => $basic,
                'hra' => $hra,
                'conveyance' => $conveyance,
                'vehicle_maintenance' => $vehicleMaint,
                'production_incentive' => $prodIncentive,
                'gross_pay' => $grossPay,
                'pf_esi' => $pfEsi,
                'total_ctc' => $totalCtc,
            ],
        ]);
    }


    public function delete($id){
        OfferLetter::find($id)?->delete();
        return back();
    }
}
