@extends('layouts.appskill')

@section('content')
    <div style="margin-top: 90px;"></div>
    <div class="col-md-12">
        <div class="container min-vh-100 mt-5 mb-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="border-color: #0d6efd;">
                        <h4 class="card-header text-center">{{ ($user && Auth::id() != $user->id)? $user->name : 'Your skill' }}</h4>
                        <section class="card-body">
                            <header class="mb-4">
                                <table class="table table-bordered">
                                    <thead class="fw-bold table-light text-center">
                                    <tr>
                                        <td>Skill Value</td>
                                        <td>Meaning (Tiếng Việt)</td>
                                        <td>Meaning (日本語)</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(config('skill.values', []) as $value => $infos)
                                        <tr>
                                            <td class="text-center" style="background: {{ '#' . $infos[0] }}">{{ $value }}</td>
                                            <td style="background: {{ '#' . $infos[0] }}">{{ $infos[2] }}</td>
                                            <td style="background: {{ '#' . $infos[0] }}">{{ $infos[1] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </header>

                            <form method="post" action="{{ route('skill-user.processEdit', ['user_id' => $user?->id??null]) }}">
                                @csrf
                                <table class="table table-bordered">
                                    <tbody>
                                    @foreach($skill_categories as $skill_category)
                                        @if(count($skill_category->items) > 0)
                                            <tr class="align-middle fw-bold table-light">
                                                <td colspan="2">{{ $skill_category->name }}</td>
                                            </tr>
                                            @foreach($skill_category->items as $skill_item)
                                                <tr class="align-middle">
                                                    <td class="col col-1 ps-3"><label>{{ $skill_item->name }}</label></td>
                                                    <td class="col col-1">
                                                        <input type="number" min="0" max="5" name="item-{{ $skill_item->id }}" value="{{ $skill_item_values[$skill_item->id]??0 }}"
                                                               required class="form-control @error('item-' . $skill_item->id) is-invalid @enderror">
                                                        @error('item-' . $skill_item->id)
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <a href="{{ route('skill-user.show') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.menubar')
@endsection
