@php($title = 'Edit post')
<x-create-edit-form :title="$title">
    <form action="/p/{{$post->slug}}/update" method="post" class="w-full" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <input  class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl" name="image" id="file_input" type="file" >
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG, or GIF.</p>




        <textarea name="description" id="description" cols="30" rows="5" class="mt-10 w-full border border-gray-200 rounded-xl" placeholder="{{__("Write a description")}}">{{$post->description}}</textarea>
        <x-primary-button class="mt-4">{{__("Edit Post")}}</x-primary-button>

    </form>
</x-create-edit-form>