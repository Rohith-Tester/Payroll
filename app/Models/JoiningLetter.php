<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JoiningLetter extends Model
{
    protected $table = 'joining_letter';

    protected $fillable = [
        'employee_id',
        'joining_date',
        'file_path',
        'issued_date',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'issued_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
