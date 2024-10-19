<x-layout>
    <x-slot:title>Salary Calculations</x-slot:title>

    @php
        // Fungsi untuk mendapatkan nama bulan
        function getMonthName($monthNumber) {
            $months = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ];
            return $months[$monthNumber] ?? 'Invalid Month';
        }
    @endphp

    <div class="container">
        <form class="d-flex gap-2 mb-4" method="get">
            <select class="form-select flex-grow-1" name="month">
                <option value="">Pilih Bulan</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request()->month == $i ? 'selected' : '' }}>
                        {{ getMonthName($i) }}
                    </option>
                @endfor
            </select>
            <input type="number" class="form-control flex-grow-1" placeholder="Tahun" name="year" min="1945" max="{{ date('Y') }}" value="{{ request()->year }}">
            <button type="submit" class="btn btn-dark">Hitung</button>
        </form>

        @if(request()->month && request()->year)
            <div class="card overflow-hidden">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Periode</th>
                            <th scope="col">Pegawai</th>
                            <th scope="col">Gaji Pokok</th>
                            <th scope="col">Bonus</th>
                            <th scope="col">BPJS</th>
                            <th scope="col">JP</th>
                            <th scope="col">Cicilan</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($salary_calculations as $key => $salary_calculation)
                            <tr>
                                <td>{{ $salary_calculations->firstItem() + $key }}</td>
                                <td>{{ getMonthName($salary_calculation->month) }} {{ $salary_calculation->year }}</td>
                                <td>{{ $salary_calculation->employee->name }}</td>
                                <td>Rp {{ number_format($salary_calculation->basic_salary, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($salary_calculation->bonus, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($salary_calculation->bpjs, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($salary_calculation->jp, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($salary_calculation->loan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($salary_calculation->total_salary, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data gaji untuk periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="10">
                                <div class="mt-10 mb-10 px-4">
                                    {{ $salary_calculations->links() }}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endif
    </div>
</x-layout>
