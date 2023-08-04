<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <img class="w-12 h-12" src="{{asset(auth()->user()->image)}}" alt="">
                    <div class="flex flex-wrap gap-4">
                        @foreach ($posts as $post)
                        
                            <div class="m-2 p-4">
                                Images
                                <img class="w-64 h-64" src="{{asset($post->image)}}" alt="">
                            </div>                            
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
