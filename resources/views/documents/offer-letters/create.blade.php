<x-layouts.app title="New offer letter">
    <div class="doc-page-head">
        <p>Create an offer letter, then preview and print. Salary annex pulls from the employee’s latest salary structure; optional lines override or add components.</p>
        <a class="doc-btn doc-btn--ghost" href="{{ route('documents.offer-letters.index') }}">Back</a>
    </div>

    <section class="app-panel">
        <form class="doc-form doc-form--wide" method="POST" action="{{ route('documents.offer-letters.store') }}">
            @csrf
            <h3 class="doc-form-section-title">Letter</h3>
            <div class="doc-form-grid">
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
                    <label for="issued_date">Issue date</label>
                    <input id="issued_date" name="issued_date" type="date" value="{{ old('issued_date', now()->toDateString()) }}" required>
                    @error('issued_date')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="compensation_line">Compensation line (optional)</label>
                    <input id="compensation_line" name="compensation_line" type="text" value="{{ old('compensation_line') }}" placeholder="e.g. Rs 1036 per month + Retirals">
                    @error('compensation_line')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="offered_salary">Monthly amount (optional fallback)</label>
                    <input id="offered_salary" name="offered_salary" type="number" step="0.01" min="0" value="{{ old('offered_salary') }}">
                    <p class="doc-form__hint">Used if compensation line is empty.</p>
                    @error('offered_salary')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="signatory_name">Signatory name (optional)</label>
                    <input id="signatory_name" name="signatory_name" type="text" value="{{ old('signatory_name') }}" placeholder="Defaults from company config">
                    @error('signatory_name')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <h3 class="doc-form-section-title">Annex — extra components (optional)</h3>
            <p class="doc-form__hint" style="margin-bottom: 1rem;">Basic, HRA, gross, CTC come from <code>salary_structure</code> for the selected employee. Enter amounts below only if you need them on the annex.</p>
            <div class="doc-form-grid">
                <div>
                    <label for="conveyance">Conveyance</label>
                    <input id="conveyance" name="conveyance" type="number" step="0.01" min="0" value="{{ old('conveyance') }}">
                    @error('conveyance')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="vehicle_maintenance">Vehicle maintenance</label>
                    <input id="vehicle_maintenance" name="vehicle_maintenance" type="number" step="0.01" min="0" value="{{ old('vehicle_maintenance') }}">
                    @error('vehicle_maintenance')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="production_incentive">Production incentive</label>
                    <input id="production_incentive" name="production_incentive" type="number" step="0.01" min="0" value="{{ old('production_incentive') }}">
                    @error('production_incentive')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="pf_esi">PF + ESI (optional)</label>
                    <input id="pf_esi" name="pf_esi" type="number" step="0.01" min="0" value="{{ old('pf_esi') }}">
                    <p class="doc-form__hint">If empty and CTC is set on salary structure, remainder after gross is used.</p>
                    @error('pf_esi')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="doc-form__actions">
                <button class="doc-btn" type="submit">Generate preview</button>
            </div>
        </form>
    </section>
</x-layouts.app>
