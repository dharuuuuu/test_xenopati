<x-layout>
    <x-slot:title>Employees</x-slot:title>

    <div class="container">
        <div class="d-flex mb-2 justify-content-between">
            <form class="d-flex gap-2" method="get">
                <input type="text" class="form-control w-auto" placeholder="Cari employee" name="search"
                    value="{{ request()->search }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>
            <a href="/employees/create" class="btn btn-dark">Tambah</a>
        </div>

        <div class="card overflow-hidden">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Picture</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $key => $employee)
                        <tr>
                            <td>{{ $employees->firstItem() + $key }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>
                                <img src="{{ Storage::url($employee->user_picture) }}" alt="{{ $employee->name }}"
                                    class="w-thumbnail img-thumbnail">
                            </td>

                            <td align="right">
                                <a style="margin: 5px 0" href="{{ route('employees.show', ['employee' => $employee->id]) }}" class="btn btn-sm btn-primary">Show</a> <br>

                                <a style="margin: 5px 0" href="{{ route('employees.edit', ['employee' => $employee->id]) }}" class="btn btn-sm btn-primary">Edit</a> <br>

                                <form action="{{ route('employees.destroy', ['employee' => $employee->id]) }}" method="POST" class="d-inline" id="delete-form-{{ $employee->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $employee->id }})">Hapus</button>
                                </form>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="mt-10 mb-10 px-4">
                                {{ $employees->links() }}
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
