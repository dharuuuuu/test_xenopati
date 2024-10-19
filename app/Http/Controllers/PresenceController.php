<?php

namespace App\Http\Controllers;

use App\Models\EmpPresence;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EmpPresence::join('employees', 'employees.id', '=', 'emp_presences.employee_id')->select('emp_presences.*', 'employees.name');

        if ($request->search) {
            $query->where('employees.name', 'like', "%{$request->search}%");
        }

        $presences = $query->orderBy('emp_presences.id', 'desc')->paginate(10);

        return view('app.presence.index', [
            'presences' => $presences,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::query()->orderBy('id', 'desc')->get();

        return view('app.presence.create', [
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id', 
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'required|date_format:H:i|after:check_in',
        ]);

        $today = Carbon::today()->format('Y-m-d');

        // Menggabungkan tanggal dengan input waktu
        $checkIn = Carbon::createFromFormat('Y-m-d H:i', $today . ' ' . $request->check_in)->format('Y-m-d H:i:s');
        $checkOut = Carbon::createFromFormat('Y-m-d H:i', $today . ' ' . $request->check_out)->format('Y-m-d H:i:s');

        $emp_presence = new EmpPresence();
        $emp_presence->employee_id = $request->employee_id;
        $emp_presence->check_in = $checkIn;
        $emp_presence->check_out = $checkOut;

        $emp_presence->late_in = $this->calculateLateIn($checkIn);
        $emp_presence->early_out = $this->calculateEarlyOut($checkOut);

        $emp_presence->save();

        return redirect()->route('presences.index')->with('success', 'Presence berhasil ditambahkan');
    }

    private function calculateLateIn($checkIn)
    {
        $startOfWork = Carbon::parse('08:00:00');
        $checkInTime = Carbon::parse($checkIn);

        return $checkInTime->diffInSeconds($startOfWork, false);
    }

    private function calculateEarlyOut($checkOut)
    {
        $endOfWork = Carbon::parse('17:00:00');
        $checkOutTime = Carbon::parse($checkOut);

        if ($checkOutTime->lessThan($endOfWork)) {
            return -$checkOutTime->diffInSeconds($endOfWork, false);
        }

        return 0;
    }


    /**
     * Display the specified resource.
     */
    public function show(EmpPresence $presence)
    {
        return view('app.presence.show', [
            'presence' => $presence,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmpPresence $presence)
    {
        $employees = Employee::query()->orderBy('id', 'desc')->get();

        return view('app.presence.edit', [
            'presence' => $presence,
            'employees' => $employees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmpPresence $presence)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id', 
            'check_in' => 'required|date_format:Y-m-d\TH:i',
            'check_out' => 'required|date_format:Y-m-d\TH:i|after:check_in',
        ]);

        $checkIn = Carbon::createFromFormat('Y-m-d\TH:i', $request->check_in)->format('Y-m-d H:i:s');
        $checkOut = Carbon::createFromFormat('Y-m-d\TH:i', $request->check_out)->format('Y-m-d H:i:s');

        $presence->employee_id = $request->employee_id;
        $presence->check_in = $checkIn;
        $presence->check_out = $checkOut;

        $presence->late_in = $this->calculateLateIn($checkIn);
        $presence->early_out = $this->calculateEarlyOut($checkOut);

        $presence->save();

        return redirect()->route('presences.index')->with('success', 'Presence berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmpPresence $presence)
    {
        $presence->delete();

        return redirect()->route('presences.index')->with('success', 'Presence berhasil dihapus');
    }
}
