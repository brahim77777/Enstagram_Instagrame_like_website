<div>
    @if ($status == 'pending')
        <span
            class="w-30 cursor-pointer bg-gray-400 text-white text-sm font-bold py-1 px-3 text-center rounded">{{ __('Pending') }}</span>        
    @else
        <button wire:click="{{$status}}"
                class="{{$classes}} w-30 cursor-pointer text-sm font-bold py-1 px-3 text-center rounded">
            {{ __($status) }}
        </button>
    @endif
</div>