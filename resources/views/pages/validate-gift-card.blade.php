{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Validate gift card') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--            <div class="flex flex-col items-center gap-4 mb-6">--}}
{{--                @if($giftCard->is_valid)--}}
{{--                    <div class="rounded-md bg-green-500 p-3 text-xs text-white">--}}
{{--                        {{ __('Is valid') }}--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="rounded-md bg-rose-500 p-3 text-xs text-white">--}}
{{--                        {{ __('Is invalid') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

<x-filament-panels::page>
    @if($record->is_valid)
        <div class="rounded-md bg-green-500 p-3 text-xs text-white">
            {{ __('Is valid') }}
        </div>
    @else
        <div class="rounded-md bg-rose-500 p-3 text-xs text-white">
            {{ __('Is invalid') }}
        </div>
    @endif
</x-filament-panels::page>
