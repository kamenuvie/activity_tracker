@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-nss-green-600 text-sm font-medium leading-5 text-nss-green-700 focus:outline-none focus:border-nss-green-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-nss-green-700 hover:border-nss-green-300 focus:outline-none focus:text-nss-green-700 focus:border-nss-green-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
