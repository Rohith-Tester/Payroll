@php
    $isEdit = $mode === 'edit';
    $title = $isEdit ? 'Edit employee' : 'Add employee';
    $action = $isEdit ? route('employees.update', $employee) : route('employees.store');
@endphp

<x-layouts.app :title="$title">
    <div class="doc-page-head">
        <p>{{ $isEdit ? 'Update profile, department, and salary structure.' : 'Create an employee and their current salary structure.' }}</p>
        <a class="doc-btn doc-btn--ghost" href="{{ route('employees.index') }}">Back to list</a>
    </div>

    <section class="app-panel">
        <form class="doc-form doc-form--wide" method="POST" action="{{ $action }}">
            @csrf
            @if ($isEdit)
                @method('PUT')
            @endif

            <h3 class="doc-form-section-title">Employee details</h3>

            <div class="doc-form-grid">
                <div>
                    <label for="employee_code">Employee code <span class="doc-req">*</span></label>
                    <input id="employee_code" name="employee_code" type="text" required
                        value="{{ old('employee_code', $employee->employee_code) }}">
                    @error('employee_code')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="full_name">Full name <span class="doc-req">*</span></label>
                    <input id="full_name" name="full_name" type="text" required
                        value="{{ old('full_name', $employee->full_name) }}">
                    @error('full_name')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email">Email <span class="doc-req">*</span></label>
                    <input id="email" name="email" type="email" required
                        value="{{ old('email', $employee->email) }}">
                    @error('email')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone">Phone <span class="doc-req">*</span></label>
                    <input id="phone" name="phone" type="number" required
                        value="{{ old('phone', $employee->phone) }}">
                    @error('phone')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="dob">Date of birth</label>
                    <input id="dob" name="dob" type="date"
                        value="{{ old('dob', $employee->dob?->format('Y-m-d')) }}">
                    @error('dob')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">—</option>
                        @foreach (['M' => 'Male', 'F' => 'Female', 'O' => 'Other'] as $k => $label)
                            <option value="{{ $k }}" @selected(old('gender', $employee->gender) === $k)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="department_id">Department</label>
                    <select id="department_id" name="department_id">
                        <option value="">— Select —</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}" @selected((string) old('department_id', $employee->department_id) === (string) $dept->id)>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="designation_id">Designation</label>
                    <select id="designation_id" name="designation_id">
                        <option value="">— Select —</option>
                        @foreach ($designations as $d)
                            <option value="{{ $d->id }}" @selected((string) old('designation_id', $employee->designation_id) === (string) $d->id)>
                                {{ $d->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('designation_id')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status">Status</label>
                    <input id="status" name="status" type="text" placeholder="e.g. Active, Probation"
                        value="{{ old('status', $employee->status) }}">
                    @error('status')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="joining_date">Joining date</label>
                    <input id="joining_date" name="joining_date" type="date"
                        value="{{ old('joining_date', $employee->joining_date?->format('Y-m-d')) }}">
                    @error('joining_date')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="probation_end_date">Probation end</label>
                    <input id="probation_end_date" name="probation_end_date" type="date"
                        value="{{ old('probation_end_date', $employee->probation_end_date?->format('Y-m-d')) }}">
                    @error('probation_end_date')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="reporting_manager_id">Reporting manager</label>
                    <select id="reporting_manager_id" name="reporting_manager_id">
                        <option value="">— None —</option>
                        @foreach ($managers as $m)
                            <option value="{{ $m->id }}" @selected((string) old('reporting_manager_id', $employee->reporting_manager_id) === (string) $m->id)>
                                {{ $m->full_name }} @if ($m->employee_code) ({{ $m->employee_code }}) @endif
                            </option>
                        @endforeach
                    </select>
                    @error('reporting_manager_id')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <h3 class="doc-form-section-title">Salary structure</h3>
            <p class="doc-form__hint" style="margin-bottom: 1rem;">
                Mapped to <code>salary_structure</code>. Leave gross/net blank to use basic + HRA (gross) and same as net for now.
            </p>

            <div class="doc-form-grid">
                <div>
                    <label for="basic">Basic <span class="doc-req">*</span></label>
                    <input id="basic" name="basic" type="number" step="0.01" min="0" required
                        value="{{ old('basic', $salary->basic) }}">
                    @error('basic')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="hra">HRA</label>
                    <input id="hra" name="hra" type="number" step="0.01" min="0"
                        value="{{ old('hra', $salary->hra) }}">
                    @error('hra')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gross">Gross</label>
                    <input id="gross" name="gross" type="number" step="0.01" min="0"
                        value="{{ old('gross', $salary->gross) }}" placeholder="Auto: basic + HRA">
                    @error('gross')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="net">Net</label>
                    <input id="net" name="net" type="number" step="0.01" min="0"
                        value="{{ old('net', $salary->net) }}" placeholder="Auto: gross if empty">
                    @error('net')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="ctc">CTC (annual)</label>
                    <input id="ctc" name="ctc" type="number" step="0.01" min="0"
                        value="{{ old('ctc', $salary->ctc) }}">
                    @error('ctc')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="effective_from">Effective from <span class="doc-req">*</span></label>
                    <input id="effective_from" name="effective_from" type="date" required
                        value="{{ old('effective_from', $salary->effective_from?->format('Y-m-d') ?? now()->startOfMonth()->toDateString()) }}">
                    @error('effective_from')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="doc-form__actions">
                <button class="doc-btn" type="submit">{{ $isEdit ? 'Save changes' : 'Create employee' }}</button>
            </div>
        </form>
    </section>
</x-layouts.app>
