<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream | {{ $title }}</title>

    @include('member.includes.style')
</head>

<body class="bg-stream-dark">

    <div class="font-poppins flex relative pt-20 px-3 h-screen">

        <!-- Ornament -->
        <span class="fixed -z-10 top-0 left-0">
            <img src="{{ asset('user/assets/images/success_ellipse_green.svg') }}" alt="stream" />
        </span>
        <span class="fixed -z-10 bottom-0 right-0">
            <img src="{{ asset('user/assets/images/success_ellipse_red.svg') }}" alt="stream" />
        </span>
        <!-- ./ -->

        <div class="flex flex-col items-center m-auto pb-20 mx-auto my-auto">
            <img src="{{ asset('user/assets/images/success_page_illustration.png') }}" class="w-[610px] max-w-full"
                alt="stream" width="610" />
            <div class="text-white text-2xl font-semibold text-center mt-8">
                Payment Finish
            </div>
            <p class="text-stream-gray text-base text-center leading-[30px] mb-10 mt-3">
                Time to enjoy yourself to watch great <br class="hidden md:block"> movies from around the world
            </p>
            <div class="mt-16">
                <a href="{{ route('member.dashboard') }}"
                    class="py-4 px-8 text-center rounded-full bg-indigo-600 hover:bg-indigo-800">
                    <span class="text-white font-semibold text-base">
                        Watch Now
                    </span>
                </a>
            </div>
        </div>

    </div>

    @include('member.includes.script')
</body>

</html>
