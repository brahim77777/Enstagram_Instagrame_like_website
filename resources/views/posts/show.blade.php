<x-app-layout>
    <div class="h-screen md:flex md:flex-row">

        {{-- Left Side --}}
        <div class="flex h-full items-center overflow-hidden bg-black md:w-7/12">
            <img class="h-auto w-full" src="{{asset($post->image)}}" alt="{{ $post->description }}">
        </div>

        {{-- Right Side --}}
        <div class="flex w-full flex-col bg-white md:w-5/12">

            {{-- Top --}}
            <div class="border-b-2">
                <div class="flex items-center gap-4 p-5">
                    <img src="{{ asset($post->owner->image) }}" alt="{{ $post->owner->username }}"
                         class="ltr:mr-5 rtl:ml-5 h-10 w-10 rounded-full">
                    <div class="grow">
                        <a href="/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                    </div>
                    {{-- @if ($post->owner->id === auth()->id()) --}}
                    @if(auth()->id() === $post->owner->id)
                        <a  href="/p/{{$post->slug}}/edit"><i class='text-xl hover:text-2xl hover:shadow hover:bg-gray-100 w-12 hover:border rounded-lg

                            -xl text-center bx bxs-edit-alt'></i></a>
                        <form action="/p/{{ $post->slug }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" >
                                <i class='bx bx-message-square-x text-red-600  ltr:ml-2 rtl:mr-2 text-xl hover:text-2xl hover:shadow hover:bg-gray-100 w-12 hover:border rounded-lg

                                -xl text-center'></i>
                            </button>
                        </form>
                    @else
                        <livewire:follow-button :userId="$post->owner->id" classes="bg-blue-400 w-32 h-8 px-10 text-white" wire:click="$emit('toggleFollow')" />

                    @endif

                    </div>
            </div>

            {{-- Middle --}}
            <div class="flex flex-col  grow overflow-y-auto">
                <div class="flex gap-4 items-start p-5">
                    <box-icon type='solid' name='edit-alt'></box-icon>
                    <img src="{{ asset($post->owner->image) }}" class="ltr:mr-5 rtl:ml-5 h-10 w-10 rounded-full">
                    <div>
                        <a href="{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                        {{ $post->description }}
                    </div>
                    
                </div>

                {{-- Comments --}}
                <div>
                <livewire:comments :post="$post" />
                </div>

                {{-- Likes and Actions --}}
            </div>
            <div class="border-t py-3 px-3">
                <livewire:like :post="$post" />

            </div>

            <div class="border-t p-5">
                <livewire:comment-form :post="$post" />
            </div>
        </div>

    </div>
    </div>
</x-app-layout>