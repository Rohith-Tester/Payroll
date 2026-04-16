<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferLetter extends Model
{
    protected $table = 'offer_letter';

    protected $fillable = [
        'employee_id',
        'offered_salary',
        'file_path',
        'issued_date',
        'accepted',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'accepted' => 'boolean',
        'offered_salary' => 'decimal:2',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
