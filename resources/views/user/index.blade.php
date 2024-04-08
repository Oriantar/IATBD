<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$user->name}}
        </h2>
    </x-slot>
    @if (Auth()->user()->id == $user->id)
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            <form action="{{url('user/'. $user->id . '/upload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="media">
                <input class="" type="submit" value="Upload">
            </form>
        </div>
    </div>
    @endif
    @foreach($images as $image)
        @if($image->isVideo == 0)
        <img src="{{asset('/storage/images/profile/' . $image->media)}}" alt="foto" height="800" width="800">
        @else
        <video height="800" width="800" controls>
            <source src="{{asset('/storage/images/profile/' . $image->media)}}">
            Your browser does not support the video tag.
          </video>
        @endif
    
    @endforeach
</x-app-layout>
