@props(['messages'])

{{--@if ($messages)--}}
{{--    <ul {{ $attributes->merge(['class' => 'small text-danger mb-2']) }}>--}}
{{--        @foreach ((array) $messages as $message)--}}
{{--            <li>{{ $message }}</li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--@endif--}}
@if ($messages)
    @foreach ((array) $messages as $message)
        <div {{ $attributes->merge(['class' => 'text-warning d-block']) }}>
            {{ $message }}
        </div>
    @endforeach
@endif
