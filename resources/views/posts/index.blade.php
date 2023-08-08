<x-app-layout>
<div class="flex flex-row max-w-3xl gap-8 mx-auto">
    {{-- Left Side --}}
    {{-- {{dd($posts)}} --}}

        <livewire:post-list  />


    {{-- Right Side --}}
    <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
        <div class="flex flex-row text-sm gap-2">
            <div class="mr-5">
                <a href="/{{auth()->user()->username}}">
                    <img src="{{asset(auth()->user()->image)}}" alt="{{auth()->user()->username}}" class="border border-gray-300 rounded-full h-12 w-12">
                </a>
            </div>
            <div class="flex flex-col">
                <a href="/{{auth()->user()->username}}" class="font-bold">{{auth()->user()->username}}</a>
                <div class="text-gray-500 text-sm">{{auth()->user()->name}}</div>
            </div>
        </div>
        <div class="mt-5">
            <h3 class="text-gray-500 font-bold">{{__('Suggestions For You')}}</h3>
            <ul>
                @foreach ($suggested_users as $user)
                    <li class="flex my-5 text-sm justify-items-center">
                        <div class="mr-5">
                            <a href="/{{$user->username}}">
                                <img src="{{asset($user->image)}}" alt="{{$user->username}}" class="rounded-full h-9 w-9 border border-gray-300">
                            </a>
                        </div>
                        <div class="flex flex-col grow">
                            <div class="flex gap-2">
                                <a href="/{{$user->username}}" class="font-bold">{{$user->username}}</a>
                                @if(auth()->user()->is_follower($user->id) == 'follower')
                                    <span class="bg-gray-200 px-2 rounded-lg  text-gray-400">Follower</span>
                                @endif
                            </div>
                            <div class="text-gray-500 text-sm">
                                {{$user->name}}  
                            </div>

                        </div>

                        <livewire:follow-button :userId="$user->id" :wire:key="'user-'.$user->id" classes="text-blue-500"  />

                        
                    </li>
                    
                @endforeach
    
            </ul>
    
        </div>
    </div>

</div>

</x-app-layout>