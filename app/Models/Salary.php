<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee ;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salary'; 

    protected $fillable = ['employee_id' ,'ctc' ,'variable'];

    public function salary():HasOne
    {
        return $this->hasOne(Employee::class , 'employee_id') ;
    }

}
