<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <textarea
                name="pet"
                placeholder="{{ __('What is the name of your pet?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('pet') }}</textarea>
            <textarea
                name="message"
                placeholder="{{ __('Biography') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <input type="text" name="bedrag" placeholder="0.00" class="block w-full border-gray-100 focus:border-indigo-100 focus:ring focus:ring-indigo-50 focus:ring-opacity-50 rounded-md shadow-sm">
            <div class="date-picker flex justify- justify-center space-x-2 my-4">
                <input type="date" id="starthuur" name="starthuur" placeholder="Start Date" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white">
                <input type="date" id="eindhuur" name="eindhuur" placeholder="End Date" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white">
            </div>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('posts') }}</x-primary-button>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($posts as $post)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                            <span class="text-gray-800">{{ $post->pet }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                                <span class="text-gray-800">{{ $post->user->name }}</span>
                                @unless ($post->created_at->eq($post->updated_at))
                                <small class="text-sm text-gray-600"> &middot; {{__('edited')}} </small>
                            @endunless
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $post->message }}</p>
                        <p class="mt-2 text-lg text-gray-900">&euro;{{ number_format($post->bedrag, 2, ',' ,'.')}}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ \Carbon\Carbon::parse($post->starthuur)->format('j F Y') }}&middot;{{ \Carbon\Carbon::parse($post->eindhuur)->format('j F Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>