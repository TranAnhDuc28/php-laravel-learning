<x-app-layout>
    <script>
        $(document).ready(function() {
            $('#projectsForm').on('submit', function() {
                $(this).find('button[type="submit"]').prop('disabled', true);
                return true;
            });
        });
    </script>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-color: #0d6efd;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Edit Project Name</h6>
                    </div>
                    <div class="card-body">
                        <x-input-error :messages="$errors->all()" class="mt-2" />
                        <form id="projectsForm" method="POST" action="{{ route('projects.update', $projects) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="project_name" class="form-label">Project Name</label>
                                <input class="form-control @error('project_name') is-invalid @enderror" value="{{$projects->project_name}}" id="project_name" name="project_name" required />
                            </div>

                            <div class="mb-3">
                                <label for="manager_id" class="form-label">Project Manager</label>
                                <select class="form-select @error('user_id') is-invalid @enderror"
                                        id="manager_id"
                                        name="user_id"
                                        required>
                                    <option value="" disabled selected>Select Manager</option>
                                    @foreach($managers as $manager)
                                        <option value="{{ $manager->user_id }}"
                                            {{ $projects->user_id == $manager->user_id ? 'selected' : '' }}>
                                            {{ $manager->user->name ?? 'Unknown Manager' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Update</button>
                                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
