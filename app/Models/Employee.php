<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    protected $table = 'employee';

    protected $fillable = [
        'employee_code',
        'full_name',
        'dob',
        'gender',
        'phone',
        'email',
        'joining_date',
        'department_id',
        'status',
        'reporting_manager_id',
        'probation_end_date',
        'designation_id',
    ];

    protected $casts = [
        'dob' => 'date',
        'joining_date' => 'date',
        'probation_end_date' => 'date',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function offerLetters()
    {
        return $this->hasMany(OfferLetter::class, 'employee_id');
    }

    public function joiningLetters()
    {
        return $this->hasMany(JoiningLetter::class, 'employee_id');
    }

    public function experienceLetters()
    {
        return $this->hasMany(ExperienceLetter::class, 'employee_id');
    }

    public function salaryStructures(): HasOne
    {
        return $this->hasOne(SalaryStructure::class, 'employee_id');
    }

    /**
     * Latest salary row by effective date (for display / editing).
     */
    public function latestSalaryStructure(): HasOne
    {
        return $this->hasOne(SalaryStructure::class, 'employee_id');
    }

    public function salary(): HasOne
    {
        return $this->hasOne(Salary::class, 'employee_id');
    }

    public function reportingManager(): BelongsTo
    {
        return $this->belongsTo(self::class, 'reporting_manager_id');
    }
}
