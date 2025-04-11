<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">User List</h6>
                        <a href="{{ route('register') }}" class="btn btn-primary">Create New User</a>
                    </div>

                    <div class="card-body">
                        <x-alert-status/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Join Date</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($forms as $form)
                                    <tr>
                                        <td>{{ ($forms->currentPage() - 1) * $forms->perPage() + $loop->iteration }}</td>
                                        <td>{{ $form->id }}</td>
                                        <td>{{ $form->name }}</td>
                                        <td>{{ $form->email }}</td>
                                        <td>{{ isset($form->join_date) ? \Carbon\Carbon::parse($form->join_date)->format('Y-m-d') : "-" }}</td>
                                        <td>{{ config('roles.get_label')($form->role) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('user.edit', $form->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                                <form action="{{ route('user.destroy', $form->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $forms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
