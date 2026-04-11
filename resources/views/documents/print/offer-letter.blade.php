@php
    $role = $roleTitle ?? $employee?->designation?->title;
@endphp

<x-layouts.document-print
    pageTitle="Offer letter"
    :backUrl="route('documents.offer-letters.index')"
>
    @include('documents.partials.letterhead', ['company' => $company])

    <div class="doc-body">
        <p class="doc-meta">
            {{ $letter->issued_date?->format('F j, Y') }}<br>
        </p>

        <p>Dear {{ $employee?->full_name ?? 'Candidate' }},</p>

        <p>
            With reference to your application and the interviews you had with <strong>{{ $company['name'] }} </strong>, 
            we are pleased to offer you employment in our company on the following terms and conditions.
            



            @if ($role)
                of <strong>{{ $role }}</strong>
            @else
                discussed with you
            @endif
            @if ($employee?->department?->name)
                with <strong>{{ $company['name'] ?? 'the organization' }}</strong>, aligned to the
                <strong>{{ $employee->department->name }}</strong> function.yyyyyy
            @else
                with <strong>{{ $company['name'] ?? 'the organization' }}</strong>.
            @endif
        </p>

        @if ($letter->offered_salary !== null)
            <p>
                Your proposed annual cost-to-company / gross compensation is
                <strong>{{ number_format((float) $letter->offered_salary, 2) }}</strong>
                (figures subject to payroll policy and statutory deductions at the time of payment).
            </p>
        @endif

        <p>
            This offer is contingent upon successful completion of any background checks and compliance requirements
            applicable to your role. Your expected date of joining may be coordinated with HR; please treat this letter
            as confidential until formal onboarding steps are completed.
        </p>

        <p>
            We look forward to welcoming you to the team. Kindly confirm acceptance by replying to this communication
            or signing the duplicate copy where applicable.
        </p>

        <p>Sincerely,</p>

        <div class="doc-signature">
            <div class="doc-signature__line"></div>
            <p class="doc-signature__name">Authorized Signatory</p>
            <p class="doc-signature__role">Human Resources</p>
            <p class="doc-signature__role">{{ $company['name'] ?? '' }}</p>
        </div>
    </div>
</x-layouts.document-print>
