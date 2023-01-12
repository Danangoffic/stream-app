<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream | {{ $title }}</title>

    @include('member.includes.style')

    {{-- <script src="assets/script/tailwind-config.js"></script> --}}
</head>

<body class="bg-stream-dark">

    <div class="relative">
        <div class="hidden lg:block fixed">
            <img src="{{ asset('user/assets/images/banner.png') }}" class="max-h-screen" alt="stream" />
        </div>
    </div>
    <div class="grid md:grid-cols-12 font-poppins relative pb-20">

        <!-- Ornament -->
        <span class="fixed -z-10 top-0">
            <img src="{{ asset('user/assets/images/pricing_ornament.svg') }}" class="h-screen w-screen"
                alt="stream" />
        </span>
        <!-- ./ -->

        <div class="col-span-12 col-start-1 lg:col-start-2 xl:col-start-4">
            <div class="px-5 lg:px-[60px] pt-[30px] relative">
                <!-- Logo & User Avatar -->
                <div class=" flex flex-row justify-between items-center relative">
                    <a href="{{ route('home') }}" class="block">
                        <img src="{{ asset('user/assets/images/stream.svg') }}" alt="stream" />
                    </a>

                    <!-- user avatar -->
                    @auth
                        <div class="collapsible-dropdown flex flex-col gap-2 relative">
                            <a href="#"
                                class="outline outline-2 outline-stream-gray p-[6px] rounded-full w-[60px] dropdown-button"
                                data-target="#dropdown-stream">
                                <img src="{{ asset('user/assets/images/photo.png') }}"
                                    class="rounded-full object-cover w-full" alt="stream" />
                            </a>
                            <div class="bg-white rounded-2xl text-stream-dark font-medium flex flex-col gap-1 absolute z-[999] right-0 top-[80px] min-w-[180px] hidden overflow-hidden"
                                id="dropdown-stream">
                                <a href="{{ route('member.dashboard') }}"
                                    class="transition-all hover:bg-sky-100 p-4">Watch</a>
                                <a href="#!" class="transition-all hover:bg-sky-100 p-4">Settings</a>
                                <a href="{{ route('member.logout') }}" class="transition-all hover:bg-sky-100 p-4">Sign
                                    Out</a>
                            </div>
                        </div>
                    @endauth
                </div>

                <div class="pt-[85px] flex flex-col items-center gap-5">
                    <p class="text-sky-300 text-base font-semibold">
                        {!! $subtitle !!}
                    </p>
                    <div class="font-bold text-white text-4xl lg:text-[45px] text-center capitalize leading-snug">
                        {!! $subtitle_description !!}
                    </div>

                    <!-- Card Content -->
                    <div class="mt-[70px] flex justify-center gap-[40px] flex-wrap">
                        <!-- Card -->
                        @foreach ($packages as $pack)
                            <div
                                class="pricing-card hover:ring-2 @if ($loop->first) hover:ring-gray-800 @else hover:ring-indigo-800 @endif">
                                <p class="text-stream-dark font-medium text-base">
                                    {!! $pack->name !!}
                                </p>
                                <div class="text-3xl text-stream-dark font-semibold my-1">
                                    Rp {{ number_format($pack->price, 0, '.', ',') }}
                                </div>
                                <p class="text-sm text-stream-gray">
                                    @if ($pack->max_days <= 30)
                                        /bulan
                                    @else
                                        {!! '/' . $pack->max_days . ' hari' !!}
                                    @endif
                                </p>
                                <hr class="my-[30px]">

                                <!-- item benefits -->
                                <div class="flex flex-col gap-6">
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits">
                                            {{ $pack->max_users }} Users Limits
                                        </span>
                                        <img src="{{ asset('user/assets/images/ic_check.svg') }}" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits">
                                            @if ($pack->is_4k)
                                                {{ __('4K') }}
                                            @else
                                                {{ __('720 & 1080 full HD') }}
                                            @endif
                                        </span>
                                        <img src="{{ asset('user/assets/images/ic_check.svg') }}" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits">
                                            All Devices Streaming
                                        </span>
                                        <img src="{{ asset('user/assets/images/ic_check.svg') }}" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    @if ($pack->is_download)
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="li-benefits">
                                                Downloadable
                                            </span>
                                            <img src="{{ asset('user/assets/images/ic_check.svg') }}" alt="stream" />
                                        </div>
                                    @endif
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits">
                                            {{ $pack->max_days }} Days
                                        </span>
                                        <img src="{{ asset('user/assets/images/ic_check.svg') }}" alt="stream" />
                                    </div>
                                </div>
                                <form action="{{ route('member.transaction.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="package_id" value="{{ $pack->id }}">
                                    @if ($loop->first)
                                        <button type="submit"
                                            class="mt-10 w-full py-3 block bg-gray-600 border-gray-800 border hover:bg-gray-800 rounded-full text-center"><span
                                                class="text-white text-base font-semibold">{{ __('Subscribe Now') }}</span></button>
                                    @else
                                        <button type="submit"
                                            class="mt-10 w-full py-3 block bg-indigo-600 hover:bg-indigo-800 rounded-full text-center"><span
                                                class="text-white text-base font-semibold">{{ __('Subscribe Now') }}</span></button>
                                    @endif
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('member.includes.script')
</body>

</html>
