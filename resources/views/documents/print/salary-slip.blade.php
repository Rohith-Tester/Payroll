@php
    $ms = $monthlySalary;
    $period = $ms ? \Carbon\Carbon::create((int) $ms->year, (int) $ms->month, 1)->format('F Y') : '—';
@endphp

<x-layouts.document-print
    pageTitle="Salary slip"
    :backUrl="route('documents.salary-slips.index')"
>
    @include('documents.partials.letterhead', ['company' => $company])

    <h2 class="doc-title">Salary statement</h2>

    <div class="doc-body">
        <p class="doc-meta">
            <strong>Pay period:</strong> {{ $period }}<br>
            <strong>Generated:</strong> {{ $slip->generated_at?->format('F j, Y \a\t H:i') ?? now()->format('F j, Y \a\t H:i') }}
        </p>

        <p class="doc-meta">
            <strong>Employee:</strong> {{ $employee?->full_name }}<br>
            @if ($employee?->employee_code)
                <strong>Code:</strong> {{ $employee->employee_code }}<br>
            @endif
            @if ($employee?->department?->name)
                <strong>Department:</strong> {{ $employee->department->name }}<br>
            @endif
            @if ($employee?->designation?->title)
                <strong>Designation:</strong> {{ $employee->designation->title }}
            @endif
        </p>

        <table class="doc-slip-table">
            <tbody>
                <tr>
                    <th scope="row">Working days</th>
                    <td>{{ $ms?->working_days ?? '—' }}</td>
                </tr>
                <tr>
                    <th scope="row">Paid days</th>
                    <td>{{ $ms?->paid_days ?? '—' }}</td>
                </tr>
                <tr>
                    <th scope="row">Gross earnings</th>
                    <td>{{ $ms ? number_format((float) $ms->gross_earning, 2) : '—' }}</td>
                </tr>
                <tr>
                    <th scope="row">Total deductions</th>
                    <td>{{ $ms ? number_format((float) $ms->total_deduction, 2) : '—' }}</td>
                </tr>
            </tbody>
        </table>

        <p class="doc-slip-total">
            Net pay (credit): {{ $ms ? number_format((float) $ms->net_payable, 2) : '—' }}
        </p>

        <p style="font-size: 0.85rem; color: var(--doc-muted); margin-top: 1.25rem;">
            This is a system-generated statement for informational purposes. Discrepancies, if any, should be escalated to
            Payroll within the stipulated window. Amounts are subject to statutory deductions and company policy.
        </p>

        <div class="doc-signature" style="margin-top: 2rem;">
            <div class="doc-signature__line"></div>
            <p class="doc-signature__name">Payroll / HR</p>
            <p class="doc-signature__role">{{ $company['name'] ?? '' }}</p>
        </div>
    </div>
</x-layouts.document-print>
