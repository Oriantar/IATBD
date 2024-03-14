<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
@if(Auth()->user()->isAdmin == 1)
@foreach ($users as $user)
<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    
        <div class="p-6 flex space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>                   
                        <span class="text-gray-800">{{ $user->name }}</span>
                        <img src="{{asset('/storage/images/'.$user->image)}}" alt="post users profile picture" style="width: 80px; padding: 10px; margin: 0px; "></span>
                        @if($user->isBlocked == 0)
                        <a href="/users/{{$user->id}}/block">block</a>
                        @elseif($user->isBlocked == 1)
                        <a href="/users/{{$user->id}}/block">unblock</a>
                        @endif
                        @if($user->isAdmin == 0)
                        <a href="/users/{{$user->id}}/admin">Geef admin rechten</a>
                        @elseif($user->isAdmin == 1)
                        <a href="/users/{{$user->id}}/admin">Pak admin rechten af</a>
                        @endif
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