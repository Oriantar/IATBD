<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2>Filter</h2>

        <form>
            @csrf
            <input type="search" class="form-control" placeholder="Find pet here" name="search">
            <select name="species" id="species">
                <option value="All">All</option>
                @foreach ($species as $kind)
                    <option value="{{ $kind->kind }}">{{ $kind->kind }}</option>
                @endforeach

            </select>
            <input type="text" class="form-control" placeholder="Amount" name="bedrag">
            <x-primary-button class="mt-4">submit</x-primary-button>
        </form>




    </div>

    <x-create-post :species="$species" />

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-20 mx-5 mt-20">
        @foreach ($posts as $post)
            @unless ($post->isReview == 1)
                <x-post :post="$post" :aanvragen="$aanvragen" />
            @endunless
        @endforeach


    </div>
    </div>

</x-app-layout>
