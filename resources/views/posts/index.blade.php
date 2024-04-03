<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <textarea name="pet" placeholder="{{ __('What is the name of your pet?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('pet') }}</textarea>
            <textarea name="message" placeholder="{{ __('Biography') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
            <input type="text" name="bedrag" placeholder="0.00"
                class="block w-full border-gray-100 focus:border-indigo-100 focus:ring focus:ring-indigo-50 focus:ring-opacity-50 rounded-md shadow-sm">
            <div class="date-picker flex justify- justify-center space-x-2 my-4">
                <input Blocked type="date" id="starthuur" name="starthuur" placeholder="Start Date" required
                    class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white">
                <input type="date" id="eindhuur" name="eindhuur" placeholder="End Date" required
                    class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white">
            </div>
            <div>
                <select name="species" id="species">
                    @foreach ($species as $kind)
                        <option value="{{ $kind->kind }}">{{ $kind->kind }}</option>
                    @endforeach
                </select>
                <input type="file" name="image" accept="jpg,png,gif,svg">
            </div>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('posts') }}</x-primary-button>
        </form>

        @foreach ($posts as $post)
            @unless ($post->isReview == 1)
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
                                    <span class="text-gray-800">{{ $post->pet }}</span>
                                    <small
                                        class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                                    <span class="text-gray-800">{{ $post->user->name }}</span>
                                    <img src="{{ asset('/storage/images/' . $post->user->image) }}"
                                        alt="post users profile picture"
                                        style="width: 80px; padding: 10px; margin: 0px; "></span>
                                    @unless ($post->created_at->eq($post->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }} </small>
                                    @endunless
                                </div>
                                @if (auth()->user()->isAdmin == 1)
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
                            <p class="mt-2 text-lg text-gray-900">&euro;{{ number_format($post->bedrag, 2, ',', '.') }}</p>
                            <p class="mt-4 text-lg text-gray-900">
                                {{ \Carbon\Carbon::parse($post->starthuur)->format('j F Y') }}&middot;{{ \Carbon\Carbon::parse($post->eindhuur)->format('j F Y') }}
                            </p>
                            <p>{{ $post->species }}</p>
                            @unless ($post->image == null)
                                <img src="{{ asset('/storage/images/posts/' . $post->image) }}" alt="foto huisdier">
                            @endunless
                            @unless (Auth()->user()->id === $post->user_id)
                                @if ($aanvragen->isEmpty())
                                    <a href="/aanvraag/{{ $post->id }}">Aanvragen</a>
                                @else
                                    @php $heeftAangevraagd = false; @endphp
                                    @foreach ($aanvragen as $aanvraag)
                                        @if ($aanvraag->post_id === $post->id)
                                            @php $heeftAangevraagd = true; @endphp
                                            je hebt al aangevraagd
                                        @break
                                    @endif
                                @endforeach
                                @unless ($heeftAangevraagd)
                                    <a href="/aanvraag/{{ $post->id }}">Aanvragen</a>
                                @endunless
                            @endif
                        @endunless

                    </div>
                </div>

            </div>
        @endunless
    @endforeach
</div>
</x-app-layout>
