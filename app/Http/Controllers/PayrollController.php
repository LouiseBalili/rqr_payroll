<?php

namespace App\Http\Controllers;

use App\Models\CashAdvance;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = Payroll::with('employees.user', 'employees.cashAdvance', 'employees.position')->get();
        return inertia('Payroll/index',[
            'payrolls' => $payrolls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employee::with('user', 'cashAdvance', 'position')->get();

        return inertia('Payroll/create', [
            'employee' => $employee,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'emp_id' => 'required',
            'payrollStart' => 'required|date',
            'payrollEnd' => 'required|date',
            'daysWorked' => 'required|numeric',
            'overtimeHours' => 'required|numeric',
            'overtimeAmount' => 'required|numeric',
        ]);

        $employee = Employee::with('user', 'cashAdvance', 'deduction', 'position')
        ->where('id', $fields['emp_id'])
        ->first();

        $cashAdvances = CashAdvance::where('emp_id', $employee->id)
            ->whereBetween('requestDate', [$fields['payrollStart'], $fields['payrollEnd']])
            ->get();

        $deductions = Deduction::where('emp_id', $employee->id)
            ->whereBetween('deductionDate', [$fields['payrollStart'], $fields['payrollEnd']])
            ->get();

        $totalCashAdvanceAmount = $cashAdvances->sum('amount');
        $totalDeductionsAmount = $deductions->sum('deductionAmount');

        $fields['cashAdvance'] = $totalCashAdvanceAmount;
        $fields['deductions'] = $totalDeductionsAmount;
        $fields['totalDeductions'] = $totalCashAdvanceAmount + $totalDeductionsAmount;
        $fields['netAmount'] = (($fields['daysWorked'] * $employee->position->amount) +
                          $fields['overtimeAmount']) -
                          $fields['totalDeductions'];

        Payroll::create($fields);

        return redirect('/payrolls')->with('message', 'Payroll added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        $payroll->load('employees.user', 'employees.cashAdvance', 'employees.deduction', 'employees.position');

        // dd($payroll->payrollStart, $payroll->payrollEnd);

        $filteredCashAdvance = $payroll->employees->cashAdvance->filter(function ($cashAdvance) use ($payroll) {
            return $cashAdvance->requestDate >= $payroll->payrollStart && $cashAdvance->requestDate <= $payroll->payrollEnd;
        })->map(function ($cashAdvance) {
            return [
                'requestDate' => $cashAdvance->requestDate,
                'amount' => $cashAdvance->amount,
                'status' => $cashAdvance->status,
            ];
        });

        $filteredDeduction = $payroll->employees->deduction->filter(function ($deduction) use ($payroll) {
            return $deduction->deductionDate >= $payroll->payrollStart && $deduction->deductionDate <= $payroll->payrollEnd;
        })->map(function ($deduction) {
            return [
                'deductionDate' => $deduction->deductionDate,
                'deductionAmount' => $deduction->deductionAmount,
                'deductionType' => $deduction->deductionType,
            ];
        });

        $payroll->employees->cashAdvance = $filteredCashAdvance;
        $payroll->employees->deduction = $filteredDeduction;

        return inertia('Payroll/show', [
            'payroll' => $payroll,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}
