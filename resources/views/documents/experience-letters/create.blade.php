<x-layouts.app title="New experience letter">
    <div class="doc-page-head">
        <p>Issue a service certificate. Issuer is the signed-in user.</p>
        <a class="doc-btn doc-btn--ghost" href="{{ route('documents.experience-letters.index') }}">Back</a>
    </div>

    <section class="app-panel">
        <form class="doc-form" method="POST" action="{{ route('documents.experience-letters.store') }}">
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
                <label for="issued_date">Issue date (optional)</label>
                <input id="issued_date" name="issued_date" type="date" value="{{ old('issued_date', now()->toDateString()) }}">
                @error('issued_date')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="last_working_date">Last working day (optional)</label>
                <input id="last_working_date" name="last_working_date" type="date" value="{{ old('last_working_date') }}">
                <p class="doc-form__hint">Shown on the certificate if provided.</p>
                @error('last_working_date')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="doc-form__actions">
                <button class="doc-btn" type="submit">Generate preview</button>
            </div>
        </form>
    </section>
</x-layouts.app>
