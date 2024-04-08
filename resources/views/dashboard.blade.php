<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
        <h2>jouw posts</h2>

        @foreach (auth()->user()->posts->reverse() as $post)
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $post->user->name }}</span>
                                <small
                                    class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($post->created_at->eq($post->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }} </small>
                                @endunless
                            </div>
                            @if ($post->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('posts.edit', $post)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('posts.destroy', $post)"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $post->message }}</p>

                        @if (!$post->isReview == 1)
                            @foreach ($aanvragen as $aanvraag)
                                @if ($aanvraag->post_id == $post->id)
                                    @foreach ($users as $user)
                                        @if ($user->id == $aanvraag->user_id)
                                            <p>{{ $user->name }} wilt aanvragen</p>
                                            <a href="aanvraag/{{ $aanvraag->id }}/{{ $post->id }}/edit">ja</a>
                                            <a href="aanvraag/{{ $aanvraag->id }}/destroy">nee</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            @if ($post->Review == null)
                                <form method="POST" action="{{ url('aanvraag/' . $post->id . '/review') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <textarea name="Review" placeholder="{{ __('Schrijf je review?') }}"
                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('pet') }}</textarea>
                                    <x-primary-button>verstuur review</x-primary-button>
                                </form>
                            @else
                                {{ $post->Review }}
                            @endif
                        @endif
                    </div>
                </div>
        @endforeach
    </div>
    <h2>jouw aanvragen</h2>

    @foreach ($jouwAanvragen as $aanvraag)
        @foreach ($aanvraagPosts as $post)
            @if ($post->isReview == 0)
                @if ($post->id == $aanvraag->post_id)
                    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                        <div class="p-6 flex space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <div>

                                        <span class="text-gray-800">{{ $post->pet}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @endforeach
    </div>
</x-app-layout>
