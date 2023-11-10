<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable =['emp_id', 'deductionType', 'deductionAmount', 'deductionDate'];

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}
