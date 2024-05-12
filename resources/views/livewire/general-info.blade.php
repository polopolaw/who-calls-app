<div>
    <div class="rounded-xl border-2 border-gray-100 bg-white my-10 p-5">
        <p>{{ __('Country') }}: <a href="#">{{ $this->validatedPhone?->region_code }}</p></a>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">

        <div class="h-32 rounded-lg bg-gray-200 flex justify-center">
            <div class="self-auto self-center">
                <div class="text-3xl text-center">{{ $this->visits }}</div>
                <div class="text-sm text-gray-500">{{ __('Last search this month') }}</div>
            </div>
        </div>
        <div class="h-32 rounded-lg bg-gray-200 flex justify-center">
            <div class="self-auto self-center">
                <div class="text-3xl text-center flex gap-2">
                    <div class="self-center text-sm text-gray-500">{{ __('Positive comments') }}: </div>
                    <div>{{ $this->positiveComments }}</div>
                </div>
                <div class="text-3xl text-center flex gap-2">
                    <div class="self-center text-sm text-gray-500">{{ __('Neutral comments') }}: </div>
                    <div>{{ $this->neutralComments }}</div>
                </div>
                <div class="text-3xl text-center flex gap-2">
                    <div class="self-center text-sm text-gray-500">{{ __('Negative comments') }}: </div>
                    <div>{{ $this->negativeComments }}</div>
                </div>
            </div>
        </div>
        <div class="h-32 rounded-lg bg-gray-200  d-flex">
            <x-elements.mood-meter class="self-auto self-center" :mood="$mood"/>
        </div>
    </div>
</div>

