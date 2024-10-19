<x-layout>
    <x-slot:title>Detail Employee</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Kolom Kiri (Detail Karyawan) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" value="{{ $employee->name }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ $employee->email }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" value="{{ $employee->address }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone" value="{{ $employee->phone }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Created At</label>
                                    <input type="text" class="form-control" id="created_at" value="{{ $employee->created_at }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="updated_at" class="form-label">Updated At</label>
                                    <input type="text" class="form-control" id="updated_at" value="{{ $employee->updated_at }}" readonly>
                                </div>
                            </div>

                            <!-- Kolom Kanan (Detail Lainnya) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_picture" class="form-label">Gambar</label>
                                    @if ($employee->user_picture)
                                        <img src="{{ Storage::url($employee->user_picture) }}" class="img-thumbnail" alt="{{ $employee->name }}">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('employees.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
