<button
{{ $attributes->merge(['class' => 'inline-block rounded border border-current px-8 py-3 text-sm font-medium text-indigo-600 transition hover:scale-110 hover:shadow-xl focus:outline-none focus:ring active:text-indigo-500']) }}>
 {{ $slot }}
</button>
