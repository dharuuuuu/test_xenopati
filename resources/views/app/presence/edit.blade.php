<x-layout>
    <x-slot:title>Edit Presence</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('presences.update', ['presence' => $presence->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="employee_id" class="form-label">Nama Karyawan</label>
                                        <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ $employee->id === $presence->employee_id ? 'selected' : '' }}>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="check_in" class="form-label">Check In</label>
                                        <input type="datetime-local" class="form-control @error('check_in') is-invalid @enderror"
                                            id="check_in" name="check_in"
                                            value="{{ old('check_in', \Carbon\Carbon::parse($presence->check_in)->format('Y-m-d\TH:i')) }}">
                                        @error('check_in')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="check_out" class="form-label">Check Out</label>
                                        <input type="datetime-local" class="form-control @error('check_out') is-invalid @enderror"
                                            id="check_out" name="check_out"
                                            value="{{ old('check_out', \Carbon\Carbon::parse($presence->check_out)->format('Y-m-d\TH:i')) }}">
                                        @error('check_out')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('presences.index') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
