<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlySalary extends Model
{
    protected $table = 'monthly_salary';

    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'working_days',
        'paid_days',
        'gross_earning',
        'total_deduction',
        'net_payable',
        'payment_status',
    ];

    protected $casts = [
        'gross_earning' => 'decimal:2',
        'total_deduction' => 'decimal:2',
        'net_payable' => 'decimal:2',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function salarySlips(): HasMany
    {
        return $this->hasMany(SalarySlip::class, 'monthly_salary_id');
    }
}
