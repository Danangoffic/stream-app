<nav class="container py-5 relative">
    <div class="flex flex-col w-full lg:flex-row lg:items-center">
        <!-- Logo & Toggler Button here -->
        <div class="flex items-center justify-between lg:hidden">
            <!-- LOGO -->
            <a href="{{ route('home') }}">
                <img src="{{ asset('user/assets/images/stream.svg') }}" alt="stream" />
            </a>
            <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
            <div>
                <button class="p-1 outline-none mobile-menu-button" data-target="#navigation">
                    <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="hidden w-full lg:block" id="navigation">
            <div class="flex flex-col items-baseline lg:justify-between mt-6 lg:flex-row lg:items-center lg:mt-0">
                <div class="flex flex-col w-full font-normal lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                    <a href="#!" class="nav-link-item">Genre</a>
                    <a href="#!" class="nav-link-item">Featured</a>
                    <a href="{{ route('home.pricelist') }}" class="nav-link-item">Pricing</a>
                </div>
                <a href="{{ route('home') }}" class="hidden lg:block -ml-36">
                    <img src="{{ asset('user/assets/images/stream.svg') }}" alt="stream" />
                </a>
                @auth
                    <div class="flex items-center gap-[26px]">
                        <span class="text-white text-base">{{ __('Welcome,') }}&nbsp;{{ auth()->user()->name }}</span>
                        <!-- user avatar -->
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
                    </div>
                @endauth
                @guest
                    <div class="flex flex-col w-full font-normal lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                        <a href="{{ route('member.login') }}"
                            class="px-8 py-3 mt-3 text-center outline outline-2 outline-stream-gray rounded-3xl lg:mt-0">
                            <span class="text-base text-normal text-stream-gray">Sign In</span>
                        </a>
                    </div>
                @endguest

            </div>
        </div>
    </div>
</nav>
