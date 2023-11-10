<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable =['emp_id', 'payrollStart', 'payrollEnd', 'daysWorked', 'overtimeHours', 'overtimeAmount', 'cashAdvance', 'deductions', 'totalDeductions', 'netAmount'];

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}
