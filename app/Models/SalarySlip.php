<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalarySlip extends Model
{
    protected $table = 'salary_slip';

    protected $fillable = [
        'monthly_salary_id',
        'generated_at',
        'file_path',
        'is_emailed',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'is_emailed' => 'boolean',
    ];

    public function monthlySalary(): BelongsTo
    {
        return $this->belongsTo(MonthlySalary::class, 'monthly_salary_id');
    }
}
