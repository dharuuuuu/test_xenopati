<x-layout>
    <x-slot:title>Salaries</x-slot:title>

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
        <div class="d-flex mb-2 justify-content-between">
            <form class="d-flex gap-2" method="get">
                <input type="text" class="form-control w-auto" placeholder="Cari employee" name="search"
                    value="{{ request()->search }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>
            <a href="/salaries/create" class="btn btn-dark">Tambah</a>
        </div>

        <div class="card overflow-hidden">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Name</th>
                        <th scope="col">Basic Salary</th>
                        <th scope="col">Loan</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salaries as $key => $salary)
                        <tr>
                            <td>{{ $salaries->firstItem() + $key }}</td>
                            <td>{{ getMonthName($salary->month) }} {{ $salary->year }}</td>
                            <td>{{ $salary->employee->name }}</td>
                            <td>Rp {{ number_format($salary->basic_salary, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->loan, 0, ',', '.') }}</td>

                            <td align="right">
                                <a style="margin: 5px 0" href="{{ route('salaries.show', ['salary' => $salary->id]) }}" class="btn btn-sm btn-primary">Show</a> <br>

                                <a style="margin: 5px 0" href="{{ route('salaries.edit', ['salary' => $salary->id]) }}" class="btn btn-sm btn-primary">Edit</a> <br>

                                <form action="{{ route('salaries.destroy', ['salary' => $salary->id]) }}" method="POST" class="d-inline" id="delete-form-{{ $salary->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $salary->id }})">Hapus</button>
                                </form>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No salaries found.</td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="mt-10 mb-10 px-4">
                                {{ $salaries->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(salaryId) {
            // Menampilkan SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user klik "Ya", submit form
                    document.getElementById('delete-form-' + salaryId).submit();
                }
            });
        }
    </script>
</x-layout>
