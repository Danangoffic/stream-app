{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
@vite('resources/css/app.css')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
</style>
{{-- <script src="{{ asset('user/assets/script/tailwind-config.js') }}"></script> --}}
<style type="text/tailwindcss">
    @layer components {
        .nav-link-item {
            @apply py-3 font-normal text-stream-gray transition-all cursor-pointer lg: py-0 hover:text-white;
        }
    }

    .frame-video {
        @apply rounded-[28px];
        filter: drop-shadow(0px 32px 52px rgba(140, 135, 162, 0.18))
    }
</style>
