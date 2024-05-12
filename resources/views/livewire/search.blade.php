<div>
    <div class="mt-30 ext-slate-900 dark:text-white text-base font-medium tracking-tight">
        @include('partial.home-intro')
        <form wire:submit="search"
              class="lg:flex gap-3 w-120 mx-auto align-center flex">
            <input type="search"
                   id="phone-input"
                   wire:model="form.phone"
                   class="w-full h-13 sm:h-20 text-2xl sm:text-5xl px-4 rounded-lg block  mt-2 w-full placeholder-gray-400/70 dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300 "
                   placeholder="{{ __('Search') }}" required>
            <div>
                @error('form.phone') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="shrink-0 w-12 !h-12 !px-0 btn btn-pink self-center">
                <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
                    <path
                        d="M50.339 47.364 37.963 34.492a20.927 20.927 0 0 0 4.925-13.497C42.888 9.419 33.47 0 21.893 0 10.317 0 .898 9.419.898 20.995S10.317 41.99 21.893 41.99a20.77 20.77 0 0 0 12.029-3.8l12.47 12.97c.521.542 1.222.84 1.973.84.711 0 1.386-.271 1.898-.764a2.742 2.742 0 0 0 .076-3.872ZM21.893 5.477c8.557 0 15.518 6.961 15.518 15.518s-6.96 15.518-15.518 15.518c-8.556 0-15.518-6.961-15.518-15.518S13.337 5.477 21.893 5.477Z"/>
                </svg>
            </button>
        </form>
    </div>
    @if ($validatedPhone)
        <livewire:general-info :$validatedPhone/>
        <livewire:comment :$validatedPhone/>
    @endif
</div>
