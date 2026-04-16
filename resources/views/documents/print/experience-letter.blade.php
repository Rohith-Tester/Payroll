@php
    $issuerName = $issuer?->user_name ?? $issuer?->email ?? 'Authorized Signatory';
@endphp

<x-layouts.document-print
    pageTitle="Experience letter"
    :backUrl="route('documents.experience-letters.index')"
>
    @include('documents.partials.letterhead', ['company' => $company])

    <h2 class="doc-title">Experience / service certificate</h2>

    <div class="doc-body">
        <p class="doc-meta">
            <strong>Date:</strong> {{ $letter->issued_date?->format('F j, Y') ?? now()->format('F j, Y') }}<br>
            <strong>Subject:</strong> Experience certificate — {{ $employee?->full_name }}
        </p>

        <p>To whom it may concern,</p>

        <p>
            This is to certify that <strong>{{ $employee?->full_name }}</strong>
            @if ($employee?->employee_code)
                (Employee code: {{ $employee->employee_code }})
            @endif
            was employed with <strong>{{ $company['name'] ?? 'the organization' }}</strong>
            @if ($employee?->department?->name)
                as part of the <strong>{{ $employee->department->name }}</strong> function
            @endif
            @if ($employee?->designation?->title)
                in the capacity of <strong>{{ $employee->designation->title }}</strong>
            @endif
            .
        </p>

        <p>
            @if ($employee?->joining_date)
                Their association with us commenced on <strong>{{ $employee->joining_date->format('F j, Y') }}</strong>.
            @endif
            @if ($lastWorkingDate)
                Their last working day with the organization was <strong>{{ $lastWorkingDate->format('F j, Y') }}</strong>.
            @endif
        </p>

        <p>
            During their tenure, their responsibilities included contributing to team objectives, adhering to company
            policies, and maintaining professional conduct. We wish them success in their future endeavours.
        </p>

        <p>
            This certificate is issued upon request without financial liability to the company, except as may be
            required under applicable law.
        </p>

        <p>Sincerely,</p>

        <div class="doc-signature">
            <div class="doc-signature__line"></div>
            <p class="doc-signature__name">{{ $issuerName }}</p>
            <p class="doc-signature__role">Human Resources / Authorized Signatory</p>
            <p class="doc-signature__role">{{ $company['name'] ?? '' }}</p>
        </div>
    </div>
</x-layouts.document-print>
