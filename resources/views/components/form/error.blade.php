@props(['field'])

@error($field)
    <div {{ $attributes->merge(['class' => 'text-red-500 text-sm mt-1']) }}>
        {{ $message }}
    </div>
@enderror
