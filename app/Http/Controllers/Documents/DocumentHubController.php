<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\ExperienceLetter;
use App\Models\JoiningLetter;
use App\Models\OfferLetter;
use App\Models\SalarySlip;
use Illuminate\View\View;

class DocumentHubController extends Controller
{
    public function index(): View
    {
        return view('documents.index', [
            'offerCount' => OfferLetter::query()->count(),
            'joiningCount' => JoiningLetter::query()->count(),
            'experienceCount' => ExperienceLetter::query()->count(),
            'salarySlipCount' => SalarySlip::query()->count(),
        ]);
    }
}
