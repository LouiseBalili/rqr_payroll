<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{
    use HasFactory;

    protected $fillable =['emp_id', 'requestDate', 'amount', 'status'];

    public function employees(){
        return $this->belongsTo(Employee::class ,'emp_id');
    }

}
