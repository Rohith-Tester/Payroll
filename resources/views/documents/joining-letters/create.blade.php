<x-layouts.app title="New appointment letter">
    <div class="doc-page-head">
        <p>Confirm appointment and joining details, then preview and print.</p>
        <a class="doc-btn doc-btn--ghost" href="{{ route('documents.joining-letters.index') }}">Back</a>
    </div>

    <section class="app-panel">
        <form class="doc-form" method="POST" action="{{ route('documents.joining-letters.store') }}">
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
                <label for="joining_date">Joining / reporting date</label>
                <input id="joining_date" name="joining_date" type="date" value="{{ old('joining_date') }}" required>
                @error('joining_date')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="issued_date">Letter date (optional)</label>
                <input id="issued_date" name="issued_date" type="date" value="{{ old('issued_date', now()->toDateString()) }}">
                @error('issued_date')
                    <p class="doc-form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="doc-form__actions">
                <button class="doc-btn" type="submit">Generate preview</button>
            </div>
        </form>
    </section>
</x-layouts.app>
