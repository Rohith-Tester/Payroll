<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperienceLetter extends Model
{
    protected $table = 'experience_letter';

    protected $fillable = [
        'employee_id',
        'file_path',
        'issued_date',
        'issued_by',
    ];

    protected $casts = [
        'issued_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by', 'user_id');
    }
}
