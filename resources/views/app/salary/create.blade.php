<x-layout>
    <x-slot:title>Tambah Salary</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('salaries.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employee_id" class="form-label">Employee</label>
                                        <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                                            <option value="">Pilih Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="month" class="form-label">Bulan</label>
                                        <select class="form-select @error('month') is-invalid @enderror" id="month" name="month">
                                            <option value="">Pilih Bulan</option>
                                            @for($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ old('month') == $i ? 'selected' : '' }}>
                                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('month')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="year" class="form-label">Tahun</label>
                                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="Masukkan tahun" name="year" value="{{ old('year') }}">
                                        @error('year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="basic_salary" class="form-label">Gaji Pokok</label>
                                        <input type="number" class="form-control @error('basic_salary') is-invalid @enderror" id="basic_salary" placeholder="Masukkan gaji pokok" name="basic_salary" value="{{ old('basic_salary') }}">
                                        @error('basic_salary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="loan" class="form-label">Pinjaman</label>
                                        <input type="number" class="form-control @error('loan') is-invalid @enderror" id="loan" placeholder="Masukkan pinjaman" name="loan" value="{{ old('loan') }}">
                                        @error('loan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
