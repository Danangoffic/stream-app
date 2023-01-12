<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream | Register Account</title>

    @include('includes.style')
</head>

<body class="bg-stream-dark">

    <div class="relative">
        <div class="hidden lg:block fixed">
            <img src="{{ asset('user/assets/images/banner.png') }}" class="max-h-screen" alt="stream" />
        </div>
    </div>

    <div class="grid md:grid-cols-12 font-poppins relative pb-20 pt-8 mx-auto max-w-screen overflow-hidden">

        <!-- Ornament -->
        <span class="fixed -z-10 top-0">
            <img src="{{ asset('user/assets/images/pricing_ornament.svg') }}" class="h-screen w-screen"
                alt="stream" />
        </span>
        <!-- ./ -->

        <div class="col-span-12 col-start-1 lg:col-start-2 xl:col-start-4">
            <div class="pt-[30px] relative">
                <!-- Logo -->
                <div class=" flex flex-row justify-center items-center">
                    <a href="/index.html" class="block">
                        <img src="{{ asset('user/assets/images/stream.svg') }}" alt="stream" />
                    </a>
                </div>

                <div class="pt-[85px] flex flex-col items-center gap-5 px-3">
                    <p class="text-sky-300 text-base font-semibold">
                        START SIGN UP
                    </p>
                    <div class="font-bold text-white text-4xl lg:text-[45px] text-center capitalize leading-snug">
                        Explore Movies
                    </div>

                    <!-- Form login -->
                    <section class="w-11/12 max-w-[460px]">
                        <form action="{{ route('member.store') }}" method="POST"
                            class="mt-[70px] flex flex-col bg-white p-[30px] rounded-2xl gap-6">
                            @csrf
                            <div class="form-input flex flex-col gap-3">
                                <label for="name" class="text-base font-medium text-stream-dark">Name</label>
                                <input type="text" name="name" id="name"
                                    class="rounded-full py-3 pr-3 pl-6 text-stream-dark placeholder:text-stream-gray placeholder:font-normal font-medium outline outline-stream-gray outline-1 text-base focus:outline-indigo-600 input-stream"
                                    placeholder="Your complete name" value="{{ old('name') }}" />
                                @error('name')
                                    <span class="text-red-600 my-0 py-0">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-input flex flex-col gap-3">
                                <label for="email" class="text-base font-medium text-stream-dark">Email
                                    Address</label>
                                <input type="email" id="email" name="email"
                                    class="rounded-full py-3 pr-3 pl-6 text-stream-dark placeholder:text-stream-gray placeholder:font-normal font-medium outline outline-stream-gray outline-1 text-base focus:outline-indigo-600 input-stream"
                                    placeholder="Your email address" value="{{ old('email') }}" />
                                @error('email')
                                    <span class="text-red-600 my-0 py-0">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-input flex flex-col gap-3">
                                <label for="phone_number" class="text-base font-medium text-stream-dark">Phone
                                    Number</label>
                                <input type="number" id="phone_number" name="phone_number"
                                    class="rounded-full py-3 pr-3 pl-6 text-stream-dark placeholder:text-stream-gray placeholder:font-normal font-medium outline outline-stream-gray outline-1 text-base focus:outline-indigo-600 input-stream"
                                    placeholder="Your phone number" value="{{ old('phone_number') }}" />
                                @error('phone_number')
                                    <span class="text-red-600 my-0 py-0">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-input flex flex-col gap-3">
                                <label for="password" class="text-base font-medium text-stream-dark">Password</label>
                                <input type="password" name="password" id="password"
                                    class="rounded-full py-3 pr-3 pl-6 text-stream-dark placeholder:text-stream-gray placeholder:font-normal font-medium outline-stream-gray outline outline-1 text-base focus:outline-indigo-600 input-stream"
                                    placeholder="Your password" />
                                @error('password')
                                    <span class="text-red-600 my-0 py-0">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            {{-- <a href="pricing.html" class="bg-indigo-600 rounded-full py-3 mt-4 text-center">
                                <span class="font-semibold text-white text-base">Continue</span>
                            </a> --}}
                            <button type="submit" class="bg-indigo-600 rounded-full py-3 mt-4 text-center">
                                <span class="font-semibold text-white text-base">Continue</span>
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @include('includes.script')
</body>

</html>
