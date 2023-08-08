<div>
    <li class="flex flex-col md:flex-row text-center">
        <div class="ltr:md:mr-1 rtl:md:ml-1 font-bold md:font-normal">
            {{ $this->count }} &nbsp;
        </div>
        <button wire:click="$emit('openModal' , 'following-modal' , {{json_encode(['userId'=> $this->userId])}})"
                class='text-neutral-500 md:text-black'>
            {{ __('following') }}</button>
    </li>
</div>