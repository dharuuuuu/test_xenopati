<x-layout>
    <x-slot:title>Tambah Presence</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('presences.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="employee_id" class="form-label">Name</label>
                                        <select name="employee_id" id="employee_id" class="form-control">
                                            @forelse ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @empty
                                                <option>Belum ada employee</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="check_in" class="form-label">Check In</label>
                                        <input type="time" class="form-control @error('check_in') is-invalid @enderror"
                                            id="check_in" placeholder="Masukkan waktu check in" value="{{ old('check_in') }}"
                                            name="check_in">
                                        @error('check_in')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="check_out" class="form-label">Check Out</label>
                                        <input type="time" class="form-control @error('check_out') is-invalid @enderror"
                                            id="check_out" placeholder="Masukkan waktu check out" value="{{ old('check_out') }}"
                                            name="check_out">
                                        @error('check_out')
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
