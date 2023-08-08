<div class="max-h-96 flex flex-col">
    <ul class="overflow-y-auto ">
        @forelse($this->followers_list as $pending)
            <li class="flex flex-row w-full p-3 gap-2 items-center text-xs lg:text-sm " wire:key="user-{{ $pending->id }}">
                <div>
                    <img src="{{ $pending->image }}" class="w-10 h-10 ltr:mr-2 rtl:ml-2 rounded-full border border-neutral-300">
                </div>
                <div class="flex flex-col grow rtl:text-right">
                    <div class="font-bold">
                        <a href="/{{ $pending->username }}">{{ $pending->username }}</a>
                    </div>
                    <div class="text-neutral-500">
                        {{ $pending->name }}
                    </div>
                </div>
                    <div>
                        <button class="bg-blue-500 border border-blue-500 text-white px-2 py-1 rounded"
                        wire:click="acceptFollowRequest({{$pending->id}})">{{ __('Accept') }}</button>

                        <button class="border border-gray-500 px-2 py-1 rounded"
                                wire:click="removeFollowRequest({{$pending->id}})">{{ __('Remove') }}</button>
                    </div>
            </li>
        @empty
            <li class="w-full p-3 text-center">
                {{ __('You Have no Follow Requests.') }}
            </li>
        @endforelse
    </ul>
</div>