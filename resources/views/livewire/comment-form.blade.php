
        <form wire:submit.prevent="store" >
            <div class="flex flex-row">

            <textarea wire:model.defer="body" name="body"  placeholder="{{ __('Add a comment...') }}"
            class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
            <button 
                    class="ltr:ml-5 rtl:mr-5 border-none bg-white text-blue-500">{{ __('Post') }}</button>
            </div>
        </form>

