<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    @if (Auth()->user()->isAdmin == 1)
        @foreach ($users as $user)
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

                <div class="p-6 flex space-x-2">

                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $user->name }}</span>
                                <img src="{{ asset('/storage/images/' . $user->image) }}" alt="post users profile picture"
                                    style="width: 80px; padding: 10px; margin: 0px; "></span>
                                @unless (Auth()->user()->id == $user->id)
                                    @if ($user->isBlocked == 0)
                                        <a href="/users/{{ $user->id }}/block">block</a>
                                    @elseif($user->isBlocked == 1)
                                        <a href="/users/{{ $user->id }}/block">unblock</a>
                                    @endif
                                    @if ($user->isAdmin == 0)
                                        <a href="/users/{{ $user->id }}/admin">Geef admin rechten</a>
                                    @elseif($user->isAdmin == 1)
                                        <a href="/users/{{ $user->id }}/admin">Pak admin rechten af</a>
                                    @endif
                                @endunless
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        @include('layouts.acces-denied')
    @endif
</x-app-layout>
