@php
    $role = $roleTitle ?? $employee?->designation?->title;
@endphp

<x-layouts.document-print pageTitle="Offer letter" :backUrl="route('documents.offer-letters.index')">
    @include('documents.partials.letterhead', ['company' => $company])

    <div class="doc-body">
        <p class="doc-meta">
            {{ $letter->issued_date?->format('j-F-Y') }}<br>
        </p>

        <p>Dear {{ $employee?->gender == 'M' ? 'Mr.' : 'Mrs.'}} {{ Str::title($employee?->full_name) ?? 'Candidate' }}</p>

        <p>
            With reference to your application and the interviews you had with <strong>{{ $company['name'] }} </strong>,
            we are pleased to offer you employment in our company on the following terms and conditions.

        <table id="terms_conditions">
            <tr>
                <td>1.Designation</td>
                <td>:</td>
                <td>{{ $employee?->designation?->title }}</td>
            </tr>
            <tr>
                <td>2.Department</td>
                <td>:</td>
                <td>{{ $employee?->department?->name }}</td>
            </tr>
            <tr>
                <td>3.Date Of Joining</td>
                <td>:</td>
                <td>{{ $employee?->joining_date->format('d-m-y') }} ( {{ $employee?->joining_date->format('l') }})</td>
            </tr>
            <tr>
                <td>4.Compensation</td>
                <td>:</td>
                <td>{{ $employee?->joining_date }}</td>
            </tr>
            <tr>
                <td>5:Probation</td>
                <td>:</td>
                <td>First six months from the date of joining will be treated as probation period.
                    During this period, no increments will apply</td>
            </tr>
            <tr>
                <td>6.Confirmation</td>
                <td>:</td>
                <td>After completion of six months, we will evaluate your performance and decide whether to retain your
                    services. Unless the employment is confirmed
                    in writing at the end of the probation period, it should be considered terminated. </td>
            </tr>
            <tr>
                <td>7.House Of work</td>
                <td>:</td>
                <td>9.00am to 6.15pm (with weekly off as per company policy)</td>
            </tr>
            <tr>
                <td>8.Notice Of termination</td>
                <td>:</td>
                <td>During the probation period, your service can be terminated by either side by giving two day’s
                    written notice. Upon confirmation, one month’s written notice is required from either side. If you
                    are already on an assignment and if your presence in the assignment is necessary as assessed by the
                    management, the management
                    reserves the right to require you to work till the assignment is complete.</td>
            </tr>
            <tr>
                <td>9.Leave Policy</td>
                <td>:</td>
                <td>As per the rules of the company, you can avail 6 days casual & 6 days sick leave per year.</td>
            </tr>
        </table>
        <div class="page-break"></div>
    </div>

    @include('documents.partials.letterfooter' , ['company' => $company])
</x-layouts.document-print>