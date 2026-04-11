<x-layouts.document-print
    pageTitle="Appointment letter"
    :backUrl="route('documents.joining-letters.index')"
>
    @include('documents.partials.letterhead', ['company' => $company])

    <h2 class="doc-title">Letter of appointment</h2>

    <div class="doc-body">
        <p class="doc-meta">
            <strong>Date:</strong> {{ $letter->issued_date?->format('F j, Y') ?? now()->format('F j, Y') }}<br>
            <strong>To:</strong> {{ $employee?->full_name }}<br>
            @if ($employee?->email)
                <strong>Email:</strong> {{ $employee->email }}
            @endif
        </p>

        <p>Dear {{ $employee?->full_name ?? 'Colleague' }},</p>

        <p>
            With reference to your application and subsequent discussions, we are pleased to appoint you to
            @if ($employee?->designation?->title)
                the position of <strong>{{ $employee->designation->title }}</strong>
            @else
                your assigned role
            @endif
            @if ($employee?->department?->name)
                within the <strong>{{ $employee->department->name }}</strong> department
            @endif
            at <strong>{{ $company['name'] ?? 'the organization' }}</strong>.
        </p>

        <p>
            Your date of joining / reporting shall be
            <strong>{{ $letter->joining_date?->format('F j, Y') }}</strong>.
            Please report to HR / your reporting manager on or before this date unless otherwise coordinated in writing.
        </p>

        <p>
            Your employment shall be governed by the applicable policies, code of conduct, and employment terms in force
            from time to time. Confidentiality, integrity, and compliance with statutory obligations are expected throughout
            your tenure.
        </p>

        <p>
            We welcome you to the team and look forward to your contributions.
        </p>

        <p>Yours faithfully,</p>

        <div class="doc-signature">
            <div class="doc-signature__line"></div>
            <p class="doc-signature__name">Authorized Signatory</p>
            <p class="doc-signature__role">Human Resources</p>
            <p class="doc-signature__role">{{ $company['name'] ?? '' }}</p>
        </div>
    </div>
</x-layouts.document-print>
