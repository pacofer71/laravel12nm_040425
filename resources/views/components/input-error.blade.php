@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 italic mt-1']) }}>***{{ $message }}</p>
@enderror
