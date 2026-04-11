<x-layouts.app title="New salary slip">
    <div class="doc-page-head">
        <p>Creates or updates a monthly salary row, then generates a printable slip.</p>
        <a class="doc-btn doc-btn--ghost" href="{{ route('documents.salary-slips.index') }}">Back</a>
    </div>

    <section class="app-panel">
        <form class="doc-form" method="POST" action="{{ route('documents.salary-slips.store') }}">
            @csrf
            <div>
                <label for="employee_id">Employee</label>
                <select id="employee_id" name="employee_id" required>
                    <option value="">Select employee</option>
                    @foreach ($employees as $e)
                        <option value="{{ $e->id }}" @selected(old('employee_id') == $e->id)>
                            {{ $e->full_name }}
                            @if ($e->employee_code)
                                ({{ $e->employee_code }})
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="month">Month</label>
                <input id="month" name="month" type="number" min="1" max="12" value="{{ old('month', now()->month) }}" required>
                @error('month')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="year">Year</label>
                <input id="year" name="year" type="number" min="2000" max="2100" value="{{ old('year', now()->year) }}" required>
                @error('year')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="working_days">Working days (optional)</label>
                <input id="working_days" name="working_days" type="number" min="0" value="{{ old('working_days') }}">
                @error('working_days')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="paid_days">Paid days (optional)</label>
                <input id="paid_days" name="paid_days" type="number" min="0" value="{{ old('paid_days') }}">
                @error('paid_days')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="gross_earning">Gross earnings</label>
                <input id="gross_earning" name="gross_earning" type="number" step="0.01" min="0" value="{{ old('gross_earning', '0') }}">
                @error('gross_earning')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="total_deduction">Total deductions</label>
                <input id="total_deduction" name="total_deduction" type="number" step="0.01" min="0" value="{{ old('total_deduction', '0') }}">
                @error('total_deduction')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="net_payable">Net payable</label>
                <input id="net_payable" name="net_payable" type="number" step="0.01" min="0" value="{{ old('net_payable', '0') }}" required>
                <p class="doc-form__hint">Required by payroll. Adjust to match your calculation.</p>
                @error('net_payable')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="doc-form__actions">
                <button class="doc-btn" type="submit">Generate preview</button>
            </div>
        </form>
    </section>
</x-layouts.app>
