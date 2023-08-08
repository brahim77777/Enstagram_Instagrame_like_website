<x-app-layout>
    <div class="card p-10">
        {{-- Title --}}
        <h1 class="text-3xl mb-10">{{__($title)}}</h1>

        {{-- Errors --}}
        @if($errors->any())
            <div class="w-full bg-red-500 text-white p-5 mb-5 rounded-xl">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>      
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
            {{$slot}}

    </div>
</x-app-layout>