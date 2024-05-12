@php use Illuminate\Support\Carbon;use Illuminate\Support\Facades\Vite; @endphp
<div wire:poll>
    @foreach($comments as $comment)
        <article class="rounded-xl border-2 border-gray-100 bg-white my-10">
            <div class="flex items-start gap-4 p-4 sm:p-6 lg:p-8">
                <img
                    alt=""
                    src="{{ Vite::image($comment->avatar) }}"
                    class="size-14 rounded-lg object-cover"
                />
                <div>
                    <h3 class="font-medium sm:text-md">
                        <span class="hover:underline"> {{ $comment->name }} </span>
                    </h3>

                    <p class="line-clamp-2 text-sm text-gray-700">
                        {{ $comment->content }}
                    </p>

                    <div class="mt-2 sm:flex sm:items-center sm:gap-2">
                        @if ($comment->user)
                            <div class="flex items-center gap-1 text-gray-500">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
                                    />
                                </svg>

                                <p class="text-xs">{{ $comment->user->comments_count }}</p>
                            </div>

                            <span class="hidden sm:block" aria-hidden="true">&middot;</span>
                        @endif
                        <p class="hidden sm:block sm:text-xs sm:text-gray-500">
                            {{__('Posted at')}}
                            <span
                                class="font-medium underline hover:text-gray-700"> {{ Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->locale(app()->currentLocale())->isoFormat('Do MMMM YYYY, HH:mm') }} </span>
                        </p>
                        <span>{{ __('Reaction') }} {{ $comment->emoji }}</span>
                    </div>


                </div>
            </div>

            <div class="flex justify-end">
                <strong
                    class="{{ $comment->feedback_type->tailwindClass() }}
                    -mb-[2px] -me-[2px] inline-flex items-center gap-1 rounded-ee-xl rounded-ss-xl px-3 py-1.5 text-white"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                        />
                    </svg>

                    <span class="text-[10px] font-medium sm:text-xs">{{ $comment->feedback_type->humanName() }}</span>
                </strong>
            </div>
        </article>
    @endforeach
    <div class="flex justify-center my-5">
        @if($comments->hasMorePages())
            <x-elements.button.button wire:click.prevent="loadMore">{{ __('Load more') }}</x-elements.button.button>
        @endif
    </div>

    <livewire:comment-form :$validatedPhone/>
</div>
