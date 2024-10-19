<x-layout>
    <x-slot:title>Detail Gaji</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Gaji</h5>
                        <div class="row">
                            <!-- Kolom Kiri (Detail Gaji) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="employee_name" class="form-label">Nama Pegawai</label>
                                    <input type="text" class="form-control" id="employee_name" value="{{ $salary->employee->name }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="month" class="form-label">Bulan</label>
                                    <input type="text" class="form-control" id="month" value="{{ date('F', mktime(0, 0, 0, $salary->month, 1)) }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="year" class="form-label">Tahun</label>
                                    <input type="text" class="form-control" id="year" value="{{ $salary->year }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="basic_salary" class="form-label">Gaji Pokok</label>
                                    <input type="text" class="form-control" id="basic_salary" value="Rp {{ number_format($salary->basic_salary, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="loan" class="form-label">Pinjaman</label>
                                    <input type="text" class="form-control" id="loan" value="Rp {{ number_format($salary->loan, 0, ',', '.') }}" readonly>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Dibuat Pada</label>
                                    <input type="text" class="form-control" id="created_at" value="{{ $salary->created_at }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="updated_at" class="form-label">Diperbarui Pada</label>
                                    <input type="text" class="form-control" id="updated_at" value="{{ $salary->updated_at }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('salaries.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
