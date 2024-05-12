@php use App\Enums\FeedbackType; @endphp
<div x-show="! $wire.submitted" x-data="comment_form" class="my-20 dark:bg-slate-800 ring-1 dark:ring-0 bg-white p-5 ">
    <x-elements.heading.h3 class="text-center">
        {{ __('Place a comment') }}
    </x-elements.heading.h3>
    <form wire:submit="save">
        <input wire:model="form.phone" type="hidden" name="phone">
        <div class="mb-5">
            <input wire:model="form.name"
                   type="text" placeholder="{{ __('Name') }}"
                   class="border border-gray-200 block mt-2 w-full placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300 dark:placeholder-gray-500 rounded-lg  bg-white px-5 py-2.5 text-gray-700 dark:bg-gray-900"/>
            <div>
                @error('form.name') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>


        <div
            class="overflow-hidden rounded-lg border border-gray-200"
        >
    <textarea
        wire:model="form.content"
        id="Comment"
        class="placeholder-gray-400/70 px-5 py-2.5 w-full resize-none border-none align-top focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:focus:ring-opacity-0 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300 text-gray-700"
        rows="4"
        maxlength="500"
        placeholder="{{ __('Enter a comment about the call') }}"
    ></textarea>
            <div>
                @error('form.content') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center justify-end gap-2 bg-white dark:bg-gray-900 p-3">
                <x-elements.button.button type="submit"> {{ __('Comment') }}</x-elements.button.button>
            </div>
        </div>
        <div>
            <div class="relative my-10">
                <input
                    @input="handleMoodChange"
                    x-model="value"
                    id="labels-range-input"
                    type="range"
                    min="0"
                    max="4"
                    step="1"
                    class="w-full h-3 bg-gray-200 rounded-lg appearance-none cursor-pointer range-lg dark:bg-gray-700">
                <span class="text-3xl text-gray-500 dark:text-gray-400 absolute start-0 -bottom-9">😡</span>
                <span
                    class="text-3xl text-gray-500 dark:text-gray-400 absolute start-1/4 -translate-x-1/2 -bottom-9">😠</span>
                <span
                    class="text-3xl text-gray-500 dark:text-gray-400 absolute start-1/2 -translate-x-1/2 -bottom-9">😐</span>
                <span
                    class="text-3xl text-gray-500 dark:text-gray-400 absolute start-3/4 -translate-x-1/2 -bottom-9">😊</span>
                <span class="text-3xl text-gray-500 dark:text-gray-400 absolute end-0 -bottom-9">😄</span>

            </div>
            <input type="hidden" x-model="selectedEmoji">
            <div class="flex space-x-2 justify-center">
                <template x-for="(emoji_group, outerIndex) in emojis">
                    <div>
                        <template x-for="(emoji, innerIndex) in emoji_group">
                                <span
                                    x-on:click="selectEmoji(innerIndex)"
                                    x-text="emoji"
                                    x-bind:class="{ 'hidden': value != outerIndex, 'opacity-100': emoji == selectedEmoji, 'opacity-30':  emoji != selectedEmoji}"
                                    class="text-5xl cursor-pointer hover:opacity-100 rounded-full"
                                >
                                </span>
                        </template>
                    </div>
                </template>
            </div>


        </div>
    </form>
</div>
@script
<script>
    Alpine.data('comment_form', () => {
        $wire.form.feedback_type = '{{ FeedbackType::NEUTRAL }}';
        $wire.form.emoji = '😐';
        return {
            value: 2,
            selectedEmoji: '😒',
            emojis: [
                ['😡', '🤬', '😵', '🤡', '💩', '☠️', '🖕'],
                ['🫨', '☹️', '😟', '😤', '😾'],
                ['🤔', '😒', '😐', '😶'],
                ['🙂', '😌', '🙃', '🤙'],
                ['😍', '🥰', '👌', '👍', '🫦', '🫶'],
            ],
            selectEmoji(index) {
                this.selectedEmoji = this.emojis[this.value][index];
                $wire.form.emoji = this.selectedEmoji;
            },

            handleMoodChange(event) {
                this.selectedEmoji = this.emojis[this.value][(Math.floor(Math.random() * this.emojis[this.value].length))]
                console.log(this.value);
                if (this.value < 1) {
                    $wire.form.feedback_type = '{{ FeedbackType::NEGATIVE }}';
                }

                if (this.value == 2) {
                    $wire.form.feedback_type = '{{ FeedbackType::NEUTRAL }}';
                }

                if (this.value > 2) {
                    $wire.form.feedback_type = '{{ FeedbackType::USEFUL }}';
                }

            }
        }
    });

</script>
@endscript
