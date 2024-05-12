<!-- mood-meter.blade.php -->

@props(['mood'])

@php
    $moodPercent = min(max($mood, 0), 100);
@endphp


<div class="relative rounded-xl overflow-auto px-4 py-2">

    <div class="relative h-[3.625rem]">
        <div class="h-12 flex flex-col items-center absolute top-0 left-[{{ $moodPercent }}%] -ml-4">
            <span class="ml-[24px] absolute top-0 text-5xl">{{ getEmoji($mood) }}</span>🤔
        </div>
    </div>
    <div class="h-10 rounded-lg bg-gradient-to-r from-rose-600 to-lime-600"></div>

</div>



