@props(['label', 'field', 'orderBy' => null, 'orderType' => null])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between cursor-pointer hover:scale-105 transition-transform duration-300']) }}
    wire:click="$dispatch('setOrderBy', { field: '{{ $field }}' })">
    <span class="flex-auto">
        {{ $label }}
    </span>

    @if ($orderBy === $field)
        @if ($orderType === 'ASC')
            <x-icons.asc />
        @else
            <x-icons.desc />
        @endif
    @else
        <x-icons.sort />
    @endif
</div>
