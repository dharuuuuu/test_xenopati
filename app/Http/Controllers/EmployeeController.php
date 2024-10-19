<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $employees = $query->orderBy('id', 'desc')->paginate(10);

        return view('app.employee.index', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:employees,email',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:25',
            'user_picture' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'password' => 'required|string|min:8|max:255', 
        ]);
    
        $employee = new employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->password = Hash::make($request->password);
        $employee->user_picture = Storage::disk('public')->put('employees', $request->user_picture);
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('app.employee.show', [
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('app.employee.edit', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:employees,email,' . $employee->id,
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:25',
            'user_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'password' => 'nullable|string|min:8|max:255', 
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;

        if ($request->password) {
            $employee->password = Hash::make($request->password);
        }

        if ($request->hasFile('user_picture')) {
            if ($employee->user_picture && Storage::disk('public')->exists($employee->user_picture)) {
                Storage::disk('public')->delete($employee->user_picture);
            }

            $employee->user_picture = Storage::disk('public')->put('employees', $request->user_picture);
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->presences()->delete();
        $employee->salaries()->delete();

        if ($employee->user_picture) {
            Storage::disk('public')->delete($employee->user_picture);
        }

        $employee->delete();

        return redirect()->route('employees.index');
    }
}
