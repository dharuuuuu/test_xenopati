<x-layout>
    <x-slot:title>Detail Presence</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Kolom Kiri (Detail Presensi) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Pegawai</label>
                                    <input type="text" class="form-control" id="name" value="{{ $presence->employee->name }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="check_in" class="form-label">Check In</label>
                                    <input type="text" class="form-control" id="check_in" value="{{ $presence->check_in }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="check_out" class="form-label">Check Out</label>
                                    <input type="text" class="form-control" id="check_out" value="{{ $presence->check_out }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="late_in" class="form-label">Keterlambatan (Late In)</label>
                                    <input type="text" class="form-control" id="late_in" value="{{ $presence->late_in }} detik" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="early_out" class="form-label">Pulang Cepat (Early Out)</label>
                                    <input type="text" class="form-control" id="early_out" value="{{ $presence->early_out }} detik" readonly>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Created At</label>
                                    <input type="text" class="form-control" id="created_at" value="{{ $presence->created_at }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="updated_at" class="form-label">Updated At</label>
                                    <input type="text" class="form-control" id="updated_at" value="{{ $presence->updated_at }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('presences.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
