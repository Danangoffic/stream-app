@extends('layouts.template')
@section('title', 'Home')
@section('content')
    <section class="py-[100px] flex flex-col items-center gap-5 px-3 relative">
        <p class="text-sky-300 text-base font-semibold">
            START YOUR DAY
        </p>
        <div class="font-bold text-white text-4xl lg:text-[45px] text-center capitalize leading-snug">
            Get more inspired <br class="hidden md:block" /> watching great movies
        </div>
        <p class="text-base text-stream-gray text-center leading-7">
            Everything you need to entertain yourself and <br class="hidden lg:block" />
            your family from anywhere you are
        </p>
        <a href="{{ route('member.register') }}" class="mt-5 rounded-full bg-indigo-600 text-center py-3 px-11">
            <span class="text-white font-semibold text-base">Get Started</span>
        </a>
    </section>

    <section class="px-4 relative max-w-[950px] overflow-hidden mx-auto" id="stream">
        <!-- modal button & modal background -->
        <div class="w-full relative flex">
            <img src="{{ asset('user/assets/images/temp_img.png') }}" class="object-cover rounded-[50px]" alt="stream" />
            <button
                class="absolute z-10 top-[50%] left-[50%] -mt-[25px] -ml-[25px] md:-mt-[44px] md:-ml-[44px]
                    cursor-pointer"
                id="stream-preview">
                <img src="{{ asset('user/assets/images/ic_play.svg') }}" class="w-8/12 md:w-full" alt="stream" />
            </button>
        </div>
    </section>


    <!-- Modal video -->
    <section class="relative">
        <div class="max-w-screen hidden h-full mx-auto bg-black bg-opacity-70 fixed z-30 inset-0" id="openStream">
        </div>
        <video-js
            class="frame-video overflow-hidden hidden fixed h-[405px] max-h-max max-w-full w-[720px] top-[25%] -translate-y-[25%] left-1/2 -translate-x-1/2 z-50"
            id="stream-video">
            <source src="https://d33kv075lir7n3.cloudfront.net/Details+Screen+Part+Final.mp4" type="video/mp4" />
            <p class="vjs-no-js text-twmdark">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
        </video-js>
    </section>

    <!-- Brand partner -->
    <section
        class="brands pb-[100px] pt-[50px] flex flex-wrap justify-center items-center gap-x-[70px] gap-y-10 px-2
            relative">
        <img src="{{ asset('user/assets/images/logo-apple-tv.svg') }}" alt="stream" />
        <img src="{{ asset('user/assets/images/logo-ipad-apple.svg') }}" alt="stream" />
        <img src="{{ asset('user/assets/images/logo-android-wordmark.svg') }}" alt="stream" />
        <img src="{{ asset('user/assets/images/logo-youtube-tv.svg') }}" alt="stream" />
    </section>
@endsection
@push('after-style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.10.2/video-js.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/assets/css/videojs.css') }}">
@endpush
@push('after-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.10.2/video.min.js"></script>

    <script>
        // videojs data-setup
        videojs('stream-video', {
            controls: true,
            autoplay: false,
            preload: 'auto',
            poster: "{{ asset('user/assets/images/poster.png') }}",
            disablePictureInPicture: true,
            noUITitleAttributes: true
        });

        // Open modal
        $("#stream-preview").click(function() {
            $("#openStream").removeClass('hidden')
            $("#stream-video").removeClass('hidden')
            $('body').addClass('overflow-y-hidden')
        })

        // Close modal
        $("#openStream").click(function() {
            $("#stream-video").addClass('hidden')
            $('body').removeClass('overflow-y-hidden')
            $("#openStream").addClass('hidden')
            $("#openStream").addClass('vjs-paused').removeClass('vjs-playing')
        })
    </script>
@endpush
