<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmpSalary;
use App\Models\EmpPresence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EmpSalary::join('employees', 'employees.id', '=', 'emp_salaries.employee_id')->select('emp_salaries.*', 'employees.name');

        if ($request->search) {
            $query->where('employees.name', 'like', "%{$request->search}%");
        }

        $salaries = $query->orderBy('emp_salaries.id', 'desc')->paginate(10);

        return view('app.salary.index', [
            'salaries' => $salaries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::query()->orderBy('id', 'desc')->get();

        return view('app.salary.create', [
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id|unique:emp_salaries,employee_id,NULL,id,month,' . $request->month . ',year,' . $request->year, 'month' => 'required|integer|min:1|max:12',
            'basic_salary' => 'required|numeric|min:0',
            'loan' => 'required|numeric|min:0',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1945|max:' . date('Y'),
        ]);
    
        $salary = new EmpSalary();
        $salary->employee_id = $request->employee_id;
        $salary->basic_salary = $request->basic_salary;
        $salary->loan = $request->loan;
        $salary->month = $request->month;
        $salary->year = $request->year;
        $salary->save();

        return redirect()->route('salaries.index')->with('success', 'Employee berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmpSalary $salary)
    {
        return view('app.salary.show', [
            'salary' => $salary,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmpSalary $salary)
    {
        $employees = Employee::query()->orderBy('id', 'desc')->get();

        return view('app.salary.edit', [
            'salary' => $salary,
            'employees' => $employees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmpSalary $salary)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id|unique:emp_salaries,employee_id,' . $salary->id . ',id,month,' . $request->month . ',year,' . $request->year,
            'basic_salary' => 'required|numeric|min:0',
            'loan' => 'required|numeric|min:0',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1945|max:' . date('Y'),
        ]);

        $salary->employee_id = $request->employee_id;
        $salary->basic_salary = $request->basic_salary;
        $salary->loan = $request->loan;
        $salary->month = $request->month;
        $salary->year = $request->year;
        $salary->save();

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmpSalary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus');
    }
}
