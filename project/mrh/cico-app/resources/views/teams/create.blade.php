<x-app-layout>
    <script>
        $(document).ready(function() {
            $('#teamsForm').on('submit', function() {
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
                        <h6 class="mb-0">Create New Team</h6>
                    </div>
                    <div class="card-body">
                        <x-input-error :messages="$errors->all()" class="mt-2" />
                        <form id="teamsForm" method="POST" action="{{ route('teams.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="team_name" class="form-label">Team Name</label>
                                <input class="form-control @error('team_name') is-invalid @enderror" id="team_name" name="team_name" required />
                            </div>

                            <div class="mb-3">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                                <a href="{{ route('teams.index') }}" class="btn btn-secondary">Cancel</a>
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
