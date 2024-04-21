<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-center mt-5">
        <h2 class="rounded-md text-white object-center px-4 py-2 font-semibold bg-green-800">Your Posts</h2>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-20 mx-5 mt-20">
        @foreach (auth()->user()->posts->reverse() as $post)
            <x-dash :post="$post" :aanvragen="$aanvragen" :users="$users" />
        @endforeach
    </div>

    <div class="flex justify-center mt-5">
        <h2 class="rounded-md text-white object-center px-4 py-2 font-semibold bg-green-800">Your Requests</h2>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-20 mx-5 mt-20">
        @foreach ($jouwAanvragen as $aanvraag)
            @foreach ($aanvraagPosts as $post)
                @if ($post->id == $aanvraag->post_id)
                    <x-dashja :post="$post" :aanvraag="$aanvraag" />
                    
                @endif
            @endforeach
        @endforeach
    </div>

</x-app-layout>
