<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    @if (Auth()->user()->isAdmin == 1)
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-20 mx-5 mt-20">
        @foreach ($users as $user)
            <div class="mt-6 bg-green-600 shadow-sm rounded-lg divide-y">

                <div class="p-6 flex space-x-2">

                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-white">{{ $user->name }}</span>
                                <img src="{{ asset('/storage/images/' . $user->image) }}" alt="post users profile picture"
                                    style="width: 80px; padding: 10px; margin: 0px; "></span>
                                @if (Auth()->user()->id != $user->id)
                                    @if ($user->isBlocked == 0)
                                        <a href="/users/{{ $user->id }}/block" class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600">Block</a>
                                    @elseif($user->isBlocked == 1)
                                        <a href="/users/{{ $user->id }}/block" class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600">Unblock</a>
                                    @endif
                                    @if ($user->isAdmin == 0)
                                        <a href="/users/{{ $user->id }}/admin" class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600">Give admin rights</a>
                                    @elseif($user->isAdmin == 1)
                                        <a href="/users/{{ $user->id }}/admin" class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600">Remove admin rights</a>
                                    @endif
                                @else
                                    <p class="text-white">This is you!</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @else
        @include('layouts.acces-denied')
    @endif
</x-app-layout>
