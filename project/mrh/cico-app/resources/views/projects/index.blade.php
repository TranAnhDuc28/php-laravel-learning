<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Projects Management</h6>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary">Create New Project</a>
                    </div>

                    <div class="card-body">
                        <x-alert-status/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Project ID</th>
                                    <th>Project Name</th>
                                    <th>Manager</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($forms as $form)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $form->id }}</td>
                                        <td>{{ $form->project_name }}</td>
                                        <td>{{ $form->user->name }}</td>
                                        <td>
                                            <a href="{{ route('projects.edit', $form) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('projects.destroy', $form) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

{{--                        {{ $forms->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
