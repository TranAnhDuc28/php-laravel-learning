<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Member Management</h6>
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
                                        <th>Team Name</th>
                                        <th>Role</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <select name="users[{{ $user->id }}][team_name]" class="form-select team-select">
                                                    <option value="">Not Selected</option>
                                                    @foreach($teams as $team)
                                                        <option value="{{ $team->id }}"
                                                            {{ isset($teamUsers[$user->id]) && $teamUsers[$user->id]->team_id == $team->id ? 'selected' : '' }}>
                                                            {{ $team->team_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="users[{{ $user->id }}][role]" class="form-select role-select">
                                                    @foreach(config('teams.get_select_options')() as $value => $label)
                                                        <option value="{{ $value == 0 ? "" : $value }}"
                                                            {{ isset($teamUsers[$user->id]) && $teamUsers[$user->id]->role === $value ? 'selected' : '' }}>
                                                            {{ $label }}
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
                    url: "{{ route('team-user.update') }}",
                    method: 'POST',
                    data: {
                        {{--_token: "{{ csrf_token() }}",--}}
                        user_id: userId,
                        team_id: teamName,
                        role: role
                    },
                    success: function(response) {
                        // Hiển thị thông báo thành công
                        if (response.success) {
                            // toast.success('Updated successfully');
                            // alert('Updated successfully');
                            refreshToken();
                            // location.reload(true);
                            toast.show();
                        }
                    },
                    error: function(xhr) {
                        // toast.error('Error updating data');
                        alert('Error updating data');
                        // updateToast.classList.remove('text-bg-success');
                        // updateToast.classList.add('text-bg-danger');
                        // updateToast.querySelector('.toast-body').textContent = 'Error updating data';
                        // toast.show();
                        location.reload(true);
                        // },
                        // complete: function() {
                        //     // Enable lại selects sau khi hoàn thành
                        //     $selects.prop('disabled', false);
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
