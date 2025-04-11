<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Project Member Management</h6>
                    </div>
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="updateToast" class="toast align-items-center bg-success-subtle" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body text-warning-emphasis">
                                    Updated successfully
                                </div>
                                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
{{--                            <form action="{{ route('team-user.update') }}" method="POST">--}}
{{--                                @csrf--}}
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Project Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <select name="users[{{ $user->id }}][project_name]" class="form-select team-select">
                                                    <option value="">Selected Project</option>
                                                    @foreach($projects as $project)
                                                        <option value="{{ $project->id }}"
                                                            {{ isset($projectUsers[$user->id]) && $projectUsers[$user->id]->project_id == $project->id ? 'selected' : '' }}>
                                                            {{ $project->project_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
{{--                                <button type="submit" class="btn btn-primary">Save Changes</button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
    <script>
        $(document).ready(function() {
            $('.team-select, .role-select').on('change', function() {
                const $row = $(this).closest('tr');
                const userId = $(this).attr('name').match(/\[(\d+)\]/)[1];
                const teamName = $row.find('.team-select').val();
                const role = $row.find('.role-select').val();
                const updateToast = document.getElementById('updateToast')
                const toast = new bootstrap.Toast(updateToast, {
                    delay: 3000
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('project-user.update') }}",
                    method: 'POST',
                    data: {
                        {{--_token: "{{ csrf_token() }}",--}}
                        user_id: userId,
                        project_id: teamName,
                        // role: role
                    },
                    success: function(response) {
                        // Hiển thị thông báo thành công
                        if (response.success) {
                            refreshToken();
                            toast.show();
                        }
                    },
                    error: function(xhr) {
                        // toast.error('Error updating data');
                        alert('Error updating data');
                        location.reload(true);
                    }
                });
            });
        });
        function refreshToken() {
            $.get('/refresh-csrf').done(function(data){
                $('meta[name="csrf-token"]').attr('content', data);
                $('input[name="_token"]').val(data);
            });
        }
    </script>
</x-app-layout>
