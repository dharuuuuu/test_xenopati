<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmpSalary;
use App\Models\EmpPresence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SalaryCalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EmpSalary::join('employees', 'employees.id', '=', 'emp_salaries.employee_id')
                            ->select('emp_salaries.*', 'employees.name');

        // Jika ada pencarian berdasarkan bulan dan tahun
        if ($request->month && $request->year) {
            $query->where('emp_salaries.month', $request->month)
                ->where('emp_salaries.year', $request->year);
        }

        // Mengambil data gaji dari query
        $salary_calculations = $query->orderBy('emp_salaries.id', 'desc')->paginate(10);

        // Perhitungan bonus berdasarkan presensi hanya jika ada gaji yang ditemukan
        foreach ($salary_calculations as $salary) {
            // Ambil semua presensi untuk employee yang sama pada bulan dan tahun yang sesuai
            $presences = EmpPresence::where('employee_id', $salary->employee_id)
                ->whereMonth('check_in', $salary->month) 
                ->whereYear('check_in', $salary->year)
                ->get();
            
            $total_late_in = 300;
            $totalEarlyOut = 0;
            foreach ($presences as $presence) {
                $totalEarlyOut += $presence->early_out;

                if ($presence->late_in < -300) {
                    $total_late_in += $presence->late_in;
                }
            }

            // Hitung denda keterlambatan (late_in)
            if ($total_late_in <= 0) {
                $lateInPenaltyPerSecond = 5000 / 60;
                $total_late_in = $total_late_in * $lateInPenaltyPerSecond;
            } else {
                $total_late_in = 0;
            }

            // Hitung denda pulang cepat (early_out)
            $earlyOutPenaltyPerSecond = 5000 / 60;
            $totalEarlyOut = $totalEarlyOut * $earlyOutPenaltyPerSecond;

            // Hitung bonus
            $bonus = $total_late_in + $totalEarlyOut;

            // Hitung total gaji
            $total_salary = ($salary->basic_salary + $bonus) - ($salary->bpjs + $salary->jp + $salary->loan);

            $bpjs = $salary->basic_salary * 0.02; // 2% dari gaji pokok
            $jp = $salary->basic_salary * 0.01;    // 1% dari gaji pokok

            $salary->bonus = $bonus;
            $salary->bpjs = $bpjs;
            $salary->jp = $jp;
            $salary->bonus =  $bonus;
            $salary->total_salary = $total_salary;
            $salary->save(); 
        }

        return view('app.salary_calculation.index', [
            'salary_calculations' => $salary_calculations,
        ]);
    }
}
