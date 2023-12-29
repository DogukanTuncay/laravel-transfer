@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            @if($message == "These credentials do not match our records.")
            <li>Böyle Bir Kullanıcı Yok</li>
            @else
            <li>{{ $message }}</li>

            @endif
        @endforeach
    </ul>
@endif
