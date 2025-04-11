<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Edit Check-In/Out Info</h6>
                    </div>
                    <div class="card-body">
                        <x-alert-status/>
                        @if($message)
                            <div class="alert alert-{{ $message['type'] }}">
                                {{ $message['content'] }}
                            </div>
                        @endif

                        <form action="{{ route('check_in_out.preview') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="user_id" class="form-select" required>
                                        <option value="" disabled selected>Choose User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="date" class="form-control" value="{{ isset($checkInOut) ? \Carbon\Carbon::parse($checkInOut->date)->format('Y-m-d') : request('date') }}" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">View</button>
                                </div>
                            </div>
                        </form>

                        @if($checkInOut)
                            <form action="{{ route('check_in_out.change') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $checkInOut->user_id }}">
                                <input type="hidden" name="date" value="{{ $checkInOut->date }}">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Check In {{ $checkInOut->check_in }}</label>
                                        <input type="time" name="check_in" class="form-control" value="{{ $checkInOut->check_in ? \Carbon\Carbon::parse($checkInOut->check_in)->format('H:i') : '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Check Out</label>
                                        <input type="time" name="check_out" class="form-control" value="{{ $checkInOut->check_out ? \Carbon\Carbon::parse($checkInOut->check_out)->format('H:i') : '' }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">In Lack Time (minutes)</label>
                                        <input type="number" name="in_lack_time" class="form-control" value="{{ $checkInOut->in_lack_time }}" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Out Lack Time (minutes)</label>
                                        <input type="number" name="out_lack_time" class="form-control" value="{{ $checkInOut->out_lack_time }}" min="0">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Working Time (hours)(A)</label>
                                        <input type="number" name="working_time" class="form-control" value="{{ $checkInOut->working_time }}" step="0.1" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Over Time (hours)(B)</label>
                                        <input type="number" name="over_time" class="form-control" value="{{ $checkInOut->over_time }}" step="0.1" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Official Working Hours (A+B)</label>
                                        <input type="number" name="official_working_hours" class="form-control" value="{{ $checkInOut->official_working_hours }}" step="0.1" min="0">
                                    </div>
                                </div>

{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label">Paid Leave (hours)</label>--}}
{{--                                        <input type="number" name="paid_leave" class="form-control" value="{{ $checkInOut->paid_leave }}" step="0.1" min="0">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label">Unpaid Leave (hours)</label>--}}
{{--                                        <input type="number" name="unpaid_leave" class="form-control" value="{{ $checkInOut->unpaid_leave }}" step="0.1" min="0">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.menubar')
</x-app-layout>
