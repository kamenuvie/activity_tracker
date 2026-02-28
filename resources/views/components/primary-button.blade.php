<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-nss-green-600 to-nss-green-700 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:from-nss-green-700 hover:to-nss-green-800 focus:outline-none focus:ring-2 focus:ring-nss-green-500 focus:ring-offset-2 active:from-nss-green-800 active:to-nss-green-900 transition ease-in-out duration-150 shadow-md hover:shadow-lg']) }}>
    {{ $slot }}
</button>
