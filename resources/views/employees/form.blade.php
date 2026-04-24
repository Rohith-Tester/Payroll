@php
    $isEdit = $mode === 'edit';
    $title = $isEdit ? 'Edit employee' : 'Add employee';
    $action = $isEdit ? route('employees.update', $employee) : route('employees.store');
@endphp

<x-layouts.app :title="$title">
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
                    <input id="email" name="email" type="email" required value="{{ old('email', $employee->email) }}">
                    @error('email')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone">Phone <span class="doc-req">*</span></label>
                    <input id="phone" name="phone" type="number" required value="{{ old('phone', $employee->phone) }}">
                    @error('phone')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="dob">Date of birth</label>
                    <input id="dob" name="dob" type="date" value="{{ old('dob', $employee->dob?->format('Y-m-d')) }}">
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
                    <select name="status" id="status">
                        <option value="null">—</option>
                        <option value="Confirmed" {{ old('status' , $employee->status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Probation" {{ old('status' , $employee->status) == 'Probation' ? 'selected' : '' }}>Probation</option>
                        <option value="Resigned" {{ old('status' , $employee->status) == 'Resigned' ? 'selected' : '' }}>Resigned</option>
                    </select>
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


            <div class="doc-form-grid">
                <div>
                    <label for="fixed">Fixed<span class="doc-req">*</span></label>
                    <input id="fixed" name="fixed" type="number" step="0.01" min="0"
                        value="{{ old('fixed', $salary?->ctc) }}">
                    @error('fixed')
                        <p class="doc-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="variable">Variable<span class="doc-req">*</span></label>
                    <input id="variable" name="variable" type="number" step="0.01" min="0" required
                        value="{{ old('variable', $salary?->variable) }}">
                    @error('variable')
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