<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    
    <div class="relative flex justify-center items-center min-h-screen bg-center">
        
        <img src="{{asset('/storage/images/background.jpg')}}" class="w-full h-full object-cover absolute top-0 left-0 z-0 opacity-50" alt="background image">
        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div>
        
        <p class="text-white z-10 font-bold text-2xl lg:text-9xl text-center">PassenOpJeDier.nl</p>

        @if (Route::has('login'))
            <div class="fixed top-0     right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600 ">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600 ">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md bg-white object-center px-4 py-2 font-semibold text-green-600 ">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

</body>

</html>