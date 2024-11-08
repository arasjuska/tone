<x-filament-panels::page>
    @if($record->is_valid)
        <x-filament::badge color="success">
            {{ __('Is valid') }}
        </x-filament::badge>
    @else
        <x-filament::badge color="danger">
            {{ __('Is invalid') }}
        </x-filament::badge>
    @endif

    @if($record->is_valid)
        <x-filament::button color="danger" wire:click="invalidateGiftCard">
            {{ __('Make gift card invalid') }}
        </x-filament::button>
    @endif
</x-filament-panels::page>
