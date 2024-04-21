<div class="max-w-2xl overflow-hidden rounded-lg border-2 border-white bg-green-600 shadow-md">
    @if (auth()->user()->isAdmin == 1)
        <x-dropdown>
            <x-slot name="trigger">
                <button class="absolute top-5 right-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </button>
            </x-slot>
            <x-slot name="content">
                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                    @csrf
                    @method('delete')
                    <x-dropdown-link :href="route('posts.destroy', $post)" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Delete') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    @endif

    @php
        if ($post->image == null) {
            $image = asset('/storage/images/posts/default.jpg');
        } else {
            $image = asset('/storage/images/posts/' . $post->image);
        }
    @endphp
    <img class="h-64 w-full object-cover" src="{{ $image }}
    " alt="pet" />

    <div class="p-6">
        <div>
            <span class="text-xs font-medium uppercase text-gray-500">{{ $post->species }}</span>
            <div class="flex justify-between">
                <a href="/pet/{{ $post->id }}"
                    class="mt-2 block transform text-xl font-semibold text-white transition-colors duration-300 hover:text-green-800 hover:underline dark:text-white"
                    tabindex="0" role="link">{{ $post->pet }}</a>
                <span class="mr-20 mt-2 block text-xl font-semibold text-white">€{{ $post->bedrag }}</span>
            </div>
            <p class="mt-2 text-sm text-gray-100">{{ $post->message }}</p>

        </div>

        <div class="mt-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img class="h-10 rounded-full border-2 border-gray-600 object-cover"
                        src="{{ asset('/storage/images/' . $post->user->image) }}" alt="post users profile picture" />
                    <a href="/user/{{ $post->user_id }}" class="mr-20 font-semibold text-white" tabindex="0"
                        role="link">{{ $post->user->name }}</a>
                </div>
                <span class="text-xl font-semibold text-white">{{ $post->starthuur }} - {{ $post->eindhuur }}</span>
            </div>

            <div class="mt-5 flex w-full justify-center">
                @unless (Auth()->user()->id === $post->user_id)
                    @if ($aanvragen->isEmpty())
                        <a href="/aanvraag/{{ $post->id }}">Aanvragen</a>
                    @else
                        @php $heeftAangevraagd = false; @endphp
                        @foreach ($aanvragen as $aanvraag)
                            @if ($aanvraag->post_id === $post->id)
                                @php $heeftAangevraagd = true; @endphp
                                <p class="text-white font-semibold">Je hebt al aangevraagd!</p>
                            @break
                        @endif
                    @endforeach
                    @unless ($heeftAangevraagd)
                        <a class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600 "
                            href="/aanvraag/{{ $post->id }}">Aanvragen</a>
                    @endunless
                @endif
            @endunless
        </div>
    </div>
</div>
</div>
