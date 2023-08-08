<div class="grow" >
    @foreach ($post->comments as $comment)
        <div class="flex items-start px-5 py-2">
            <img src="{{ asset($comment->user->image) }}" alt="" class="h-100 ltr:mr-5 rtl:ml-5 w-10 rounded-full">
            <div class="flex flex-col">
                <div>
                    <a href="/{{ $comment->user->username }}" class="font-bold">{{ $comment->user->username }}</a>
                    {{ $comment->body }}
                </div>
                <div class="mt-1 text-sm font-bold text-gray-400">
                    {{ $comment->created_at->diffForHumans(null, true, true) }}
                </div>
            </div>
        </div>
    @endforeach
</div>