<x-layouts.app title="HR Documents">
    <p class="doc-hub-intro">
        Generate professional letters and payslips for employees. After saving, open the preview and use
        <strong>Print / Save as PDF</strong> for a clean export. Company letterhead values come from
        <code>config/company.php</code> and your <code>.env</code>.
    </p>

    <div class="doc-hub-grid">
        <a class="doc-hub-card" href="{{ route('documents.offer-letters.index') }}">
            <h2 class="doc-hub-card__label">Offer letter</h2>
            <p class="doc-hub-card__desc">Formal job offer with role, compensation, and issue date.</p>
            <p class="doc-hub-card__meta">{{ $offerCount }} saved</p>
        </a>
        <a class="doc-hub-card" href="{{ route('documents.joining-letters.index') }}">
            <h2 class="doc-hub-card__label">Appointment letter</h2>
            <p class="doc-hub-card__desc">Joining / appointment confirmation with reporting and start date.</p>
            <p class="doc-hub-card__meta">{{ $joiningCount }} saved</p>
        </a>
        <a class="doc-hub-card" href="{{ route('documents.experience-letters.index') }}">
            <h2 class="doc-hub-card__label">Experience letter</h2>
            <p class="doc-hub-card__desc">Service certificate for departing employees with tenure summary.</p>
            <p class="doc-hub-card__meta">{{ $experienceCount }} saved</p>
        </a>
        <a class="doc-hub-card" href="{{ route('documents.salary-slips.index') }}">
            <h2 class="doc-hub-card__label">Salary slip</h2>
            <p class="doc-hub-card__desc">Monthly payslip linked to payroll totals for the selected period.</p>
            <p class="doc-hub-card__meta">{{ $salarySlipCount }} saved</p>
        </a>
    </div>
</x-layouts.app>
