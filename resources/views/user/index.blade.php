<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$user->name}}
        </h2>
    </x-slot>
    <div class="mx-20 bg-green-600 rounded-md px-2 my-10">
    @if (Auth()->user()->id == $user->id)
    <div class="p-4 sm:p-8 bg-green-600 shadow sm:rounded-lg">
        <div class="max-w-xl">
            <form action="{{url('user/'. $user->id . '/upload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="media">
                <button class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600">Upload</button> 
            </form>
        </div>
    </div>
    @endif
</div>
<div class="mx-20 gap-20 grid grid-cols-2 rounded-md px-2">
    @foreach($images as $image)
        @if($image->isVideo == 0)
        <img src="{{asset('/storage/images/profile/' . $image->media)}}" alt="foto" height="800"
        width="800" class="border border-green-500 rounded-md">
        @else
        <video  controls class="border border-green-500 rounded-md">
            <source src="{{asset('/storage/images/profile/' . $image->media)}}">
            Your browser does not support the video tag.
          </video>
        @endif
    
    @endforeach
</x-app-layout>
