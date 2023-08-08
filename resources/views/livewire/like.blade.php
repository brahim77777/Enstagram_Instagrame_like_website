<div class="flex items-center gap-4">
    @if($liked)
    <i wire:click="like" class='hover:text-rose-400 text-rose-600 cursor-pointer  text-2xl bx bxs-heart'  ></i>
    @else
    <i wire:click="like"  class='hover:text-gray-200  cursor-pointer  text-2xl bx bx-heart'></i>
    @endif
    <div>
    @if($this->post->likes()->count() > 0 )
        <strong>{{__("Liked By")}} <span class="text-sm text-sky-600">{{$this->post->likes()->first()->username }}</span> </strong>
    @if($this->post->likes()->count() > 1)
        <strong>{{__("and")}} <span class="text-sm text-sky-600">{{$this->post->likes()->count()-1}}</span> {{__("others")}} </strong>
    @endif
    @endif
    </div>

</div>
