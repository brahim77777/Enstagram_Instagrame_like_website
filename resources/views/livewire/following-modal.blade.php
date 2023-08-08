<div class="max-h-96 flex flex-col">
    <div class="flex w-full items-center border-b border-b-2 border-b-neutral-100 p-2">
        <h1 class="text-lg font-bold text-center pb-2 grow">{{ __('Following') }}</h1>
        <button wire:click="$emit('closeModal')"><i class='bx bx-x text-xl'></i></button>
    </div>
    <ul class="overflow-y-auto">
        @forelse($this->following_list as $following)
            <li class="flex flex-row w-full p-3 gap-2 items-center text-sm" wire:key="user-{{ $following->id }}">
                <div>
                    <img src="{{ $following->image }}" class="w-10 h-10 ltr:mr-2 rtl:ml-2 rounded-full border border-neutral-300">
                </div>
                <div class="flex flex-col grow rtl:text-right">
                    <div class="font-bold">
                        <a href="/{{ $following->username }}">{{ $following->username }}</a>
                    </div>
                    <div class="text-sm text-neutral-500">
                        {{ $following->name }}
                    </div>
                </div>
                @if(auth()->id() === $this->user->id)
                    <div>
                        <button class="border border-gray-500 px-2 py-1 rounded"
                                wire:click="unfollow({{$following->id}})">{{ __('Unfollow') }}</button>
                    </div>
                @endif
            </li>
        @empty
            <li class="w-full p-3 text-center">
                @if(auth()->id() === $this->user->id)
                {{ __('You are not following anyone.') }}
                @else
                {{ __('No Followings.') }}
                @endif

            </li>
        @endforelse
    </ul>
</div>