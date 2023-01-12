<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream | @yield('title')</title>

    @stack('before-style')
    @include('includes.style')
    @stack('after-style')

</head>

<body>

    <header class="text-white bg-stream-dark font-poppins select-none h-full relative">
        <img src="{{ asset('user/assets/images/green_radial.svg') }}" class="absolute" alt="stream" />
        <img src="{{ asset('user/assets/images/red_radial.svg') }}" class="absolute right-0" alt="stream" />

        @include('layouts.nav')

        @yield('content')

    </header>

    @stack('before-script')
    @include('includes.script')
    @stack('after-script')

</body>

</html>
