<div class="card">
    <div class="card-header">
        <img src="{{asset($post->owner->image)}}" alt="" class="w-9 h-9 mr-3 rounded-full ">
        <a href="/{{$post->owner->username }}" class="font-bold">{{$post->owner->username}}</a>
    </div>
    <div class="card-body" >
        <div class="max-h-[35rem] overflow-hidden">
            <a href="/p/{{$post->slug}}"><img src="{{asset($post->image)}}" class="h-auto w-full object-cover" alt="{{$post->description}}">
            </a>
        </div>
        <div class="p-3 flex gap-4">
            <livewire:like :post="$post"/>
            <a href="/p/{{$post->slug}}" ><i class='bx bxs-comment-detail text-2xl hover:text-gray-200'></i></a>
        </div>
        <div class="p-3">
            <a href="/{{$post->owner->username}}" class="font-bold mr-1">{{$post->owner->username}}</a>
            {{$post->description}}
        </div>

        @if($post->comments->count() > 0)
            <a href="/p/{{$post->slug}}" class="p-3 font-bold text-sm text-gray-500">
                {{__("View all ".$post->comments->count().' comments')}}
            </a>
        @endif
        <div class="p-3 text-gray-400 uppercase text-xs">
            {{$post->created_at->diffForHumans()}}
        </div>

    </div>
    
    <div class="card-footer ">

                <livewire:comment-form :post="$post" />
    </div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
</div>