<x-layout>
    <x-slot:title>Presences</x-slot:title>

    <div class="container">
        <div class="d-flex mb-2 justify-content-between">
            <form class="d-flex gap-2" method="get">
                <input type="text" class="form-control w-auto" placeholder="Cari employee" name="search"
                    value="{{ request()->search }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>
            <a href="/presences/create" class="btn btn-dark">Tambah</a>
        </div>

        <div class="card overflow-hidden">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Check in</th>
                        <th scope="col">Check out</th>
                        <th scope="col">Late in</th>
                        <th scope="col">Early out</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presences as $key => $presence)
                        <tr>
                            <td>{{ $presences->firstItem() + $key }}</td>
                            <td>{{ $presence->employee->name }}</td>
                            <td>{{ $presence->check_in }}</td>
                            <td>{{ $presence->check_out }}</td>
                            <td>{{ $presence->late_in }}</td>
                            <td>{{ $presence->early_out }}</td>

                            <td align="right">
                                <a style="margin: 5px 0" href="{{ route('presences.show', ['presence' => $presence->id]) }}" class="btn btn-sm btn-primary">Show</a> <br>

                                <a style="margin: 5px 0" href="{{ route('presences.edit', ['presence' => $presence->id]) }}" class="btn btn-sm btn-primary">Edit</a> <br>

                                <form action="{{ route('presences.destroy', ['presence' => $presence->id]) }}" method="POST" class="d-inline" id="delete-form-{{ $presence->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $presence->id }})">Hapus</button>
                                </form>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No presences found.</td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="mt-10 mb-10 px-4">
                                {{ $presences->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(employeeId) {
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
                    document.getElementById('delete-form-' + employeeId).submit();
                }
            });
        }
    </script>    
</x-layout>
