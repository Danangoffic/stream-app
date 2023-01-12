@extends('member.layouts.template')
@section('title', $title)
@section('subtitle', $subtitle)
@section('subtitle-description', $subtitle_description)
@section('content')
    <!-- Subscription Stat -->
    <div class="flex items-center gap-3">
        <img src="{{ asset('user/assets/images/ic_subscription.svg') }}" alt="">
        <div class="flex flex-col gap-2">
            <div class="text-white text-[22px] font-semibold">
                {{ ucwords($userPremium->package->name) }} Package
            </div>
            <div class="flex items-center gap-[10px]">
                <div class="progress-bar w-[248px] h-[6px] bg-softpur rounded-full">
                    <div class="progress bg-[#22C58B] w-[113px] h-full rounded-full"></div>
                </div>
                <div class="text-stream-gray text-sm">
                    11 / 30 days
                </div>
            </div>
        </div>
    </div>
    <!-- /Subscription Stat -->

    <!-- Benefits -->
    <div class="flex flex-col gap-6 font-medium text-base text-white -mt-[10px] px-[18px]">
        <div class="flex gap-4 items-center">
            <img src="{{ asset('user/assets/images/ic_check-dark.svg') }}" alt="">
            <span>{{ $userPremium->package->max_users }} Users Limits</span>
        </div>
        <div class="flex gap-4 items-center">
            <img src="{{ asset('user/assets/images/ic_check-dark.svg') }}" alt="">
            <span>Up to @if ($userPremium->package->is_4k)
                    {{ __('4K') }}
                @else
                    {{ __('720 & 1080 full HD') }}
                @endif Quality</span>
        </div>
        <div class="flex gap-4 items-center">
            <img src="{{ asset('user/assets/images/ic_check-dark.svg') }}" alt="">
            <span>All Platforms Streaming</span>
        </div>
        <div class="flex gap-4 items-center">
            <img src="{{ asset('user/assets/images/ic_check-dark.svg') }}" alt="">
            <span>Downloadable</span>
        </div>
    </div>
    <!-- /Benefits -->

    <!-- Action Button -->
    <div class="flex flex-col gap-[14px] max-w-max">
        <form action="{{ route('member.transaction.store') }}" method="post">
            @csrf
            <input type="hidden" name="package_id" value="{{ $userPremium->package_id }}">
            <button type="submit"
                class="py-[13px] px-[58px] bg-[#5138ED] hover:bg-[#2e10ec] active:bg-[#2e10ec] rounded-full text-center">
                <span class="text-white font-semibold text-base">
                    Make a Renewal
                </span>
            </button>
        </form>
        <a href="{{ route('home.pricelist') }}"
            class="py-[13px] px-[58px] outline outline-1 hover:bg-gray-900 outline-stream-gray outline-offset-[-3px] rounded-full text-center">
            <span class="text-stream-gray font-normal text-base">
                Change Plan
            </span>
        </a>
    </div>
    <!-- /Action Button -->

    <!-- Stop Subscribe -->
    <div class="rounded-2xl bg-[#19152E] p-[30px] w-max">
        <div class="text-xl text-red-500 font-semibold">
            Danger Zone
        </div>
        <p class="text-base text-white leading-[30px] max-w-[500px] mt-3 mb-[30px]">
            If you wish to stop subscribe our movies please continue
            by clicking the button below. Make sure that you have read our
            terms & conditions beforehand.
        </p>
        <form action="{{ route('member.subscription.destroy', $userPremium->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-[19px] py-[13px] border border-[#8f0d0d] hover:bg-[#8f0d0d] active:bg-[#ff2a2a] rounded-full text-center">
                <span class="text-white font-semibold text-base">
                    Stop Subscribe
                </span>
            </button>
        </form>
    </div>
    <!-- /Stop Subscribe -->
@endsection
