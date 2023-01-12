<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream | {{ $title }}</title>

    @include('member.includes.style')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.10.2/video-js.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/assets/css/videojs.css') }}">
</head>

<body>

    <section class="mx-auto w-screen relative watching-page font-poppins" id="stream">
        <video-js id="stream-video" class="overflow-hidden h-screen w-screen">
            <source src="{{ $movie->movie }}" type="video/mp4" />
            <p class="vjs-no-js text-twmdark">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
        </video-js>

        <!-- Button back to dashboard -->
        <div class="absolute top-5 left-5 z-20">
            <a href="{{ route('member.dashboard') }}">
                <img src="{{ asset('user/assets/images/ic_arrow-left.svg') }}" class="transition-all btn-back w-[46px]"
                    alt="stream" />
            </a>
        </div>

        <!-- Video Title -->
        <div class="absolute title-video top-7 left-1/2 -translate-x-1/2 max-w-[310px] md:max-w-[620px] text-center">
            <span class="font-medium text-2xl transition-all text-white drop-shadow-md select-none">
                Details Screen Part Final
            </span>
        </div>
    </section>

    @include('member.includes.script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.10.2/video.min.js"></script>

    <script>
        // videojs data-setup
        videojs('stream-video', {
            controls: true,
            autoplay: true,
            preload: 'auto',
            poster: "{{ asset('user/assets/images/poster.png') }}",
            disablePictureInPicture: true,
            noUTitleAttributes: true
        });

        var lastTimeMouseMoved = "";
        $(document).mousemove(function(e) {
            $('.btn-back').css({
                "opacity": "1",
                "transition": "all .3s"
            })
            $('.title-video').css({
                "opacity": "1",
                "transition": "all .3s"
            })
            $('.vjs-control-bar').css({
                "opacity": "1",
                "transition": "all .3s"
            })
            lastTimeMouseMoved = new Date().getTime();
            setTimeout(function() {
                var currentTime = new Date().getTime();
                if (currentTime - lastTimeMouseMoved > 800) {
                    $('.btn-back').css("opacity", "0")
                    $('.title-video').css("opacity", "0")
                    $('.vjs-control-bar').css("opacity", "0")
                }
            }, 800)
        });
    </script>
</body>

</html>
