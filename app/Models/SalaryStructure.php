<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryStructure extends Model
{
    protected $table = 'salary_structure';

    protected $fillable = [
        'employee_id',
        'basic',
        'hra',
        'gross',
        'net',
        'effective_from',
        'ctc',
    ];

    protected $casts = [
        'effective_from' => 'date',
        'basic' => 'decimal:2',
        'hra' => 'decimal:2',
        'gross' => 'decimal:2',
        'net' => 'decimal:2',
        'ctc' => 'decimal:2',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
