<x-layouts.app title="Dashboard">
    <p class="placeholder-copy" style="margin-bottom: 1.25rem;">
        Welcome{{ auth()->user()?->user_name ? ', ' . e(auth()->user()->user_name) : '' }}. Use the sidebar to open
        Employees, Attendance, Payroll, and Leaves.
    </p>
    <div class="app-stats">
        <div class="app-stat">
            <p class="app-stat__label">Employees</p>
            <p class="app-stat__value">{{ number_format($employeeCount) }}</p>
        </div>
        <div class="app-stat">
            <p class="app-stat__label">Departments</p>
            <p class="app-stat__value">{{ number_format($departmentCount) }}</p>
        </div>
        <div class="app-stat">
            <p class="app-stat__label">Attendance today</p>
            <p class="app-stat__value">{{ number_format($attendanceToday) }}</p>
        </div>
    </div>
    <div class="make_flex">
        <!-- for adding department  -->
        <div class="doc-page-head">
            <a class="doc-btn" href="{{ route('department.index') }}">Add Department</a>
        </div>

        <!-- for adding designations  -->
        <div class="doc-page-head">
            <a class="doc-btn" href="{{ route('dashboard') }}">Add Designation</a>
        </div>

    </div>
    <section class="app-panel">
        <h2 class="app-panel__head">Quick links</h2>
        <p class="placeholder-copy">
            <a href="{{ route('employees.index') }}" class="app-link">Employees</a>
            — directory with department.
            <a href="{{ route('attendance.index') }}" class="app-link">Attendance</a>
            — daily records.
        </p>
    </section>
</x-layouts.app>