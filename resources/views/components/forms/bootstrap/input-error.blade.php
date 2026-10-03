@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'fw-bold text-danger']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
