<div class="doc-letter-footer">
    <p>Please sign and return the copy of this letter in token of your acceptance, if the terms and conditions
        specified above and enclosed are acceptable to you.</p>

    <p>We welcome you to Magneto Dynamics and look forward to your contribution to the success and growth of the
        Company For Magneto Dynamics</p>
    <!-- signature of director -->
    <div class="doc-signature">
        <img src="{{ asset('images/director_sign.png') }}" alt="" width="100" height="50">
        <p class="doc-signature__name">{{ $company['director'] }}</p>
    </div>
    <P>I agree to the above terms and conditions and will be joining on:    </P>
    <div class="doc-signature">

        <div class="emp_signature">
            <p class="doc-signature__name">[ {{ $employee?->full_name }}]</p>
            <div class="confirm_date_of_joining">
                <span>confirmed Date Of Joining</span>
                <br>
                <span>{{ $employee?->joining_date->format('d-m-y') }}</span>
            </div>
        </div>

    </div>
    <div class="doc_footer_line"></div>
    <p>
        {{ $company['name'] . $company['address_line1'] . $company['address_line2']}}
    </p>
</div>