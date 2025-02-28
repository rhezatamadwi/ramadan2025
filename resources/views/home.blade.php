@extends('layouts.layout')

@section('content')
    <div class="text-[16px] leading-[24px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
        <h1 class="mb-1 font-bold">Assalamualaikum {{ $nama ?? '' }}</h1>
        <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">Hari ini <span class="text-[#007dd9] dark:text-[#007dd9] font-medium">{{ $hari_ini->tanggal_hijriyah }}</span> / {{ date('j F Y', strtotime($hari_ini->tanggal_masehi)) }}</p>
        
        <h1 class="mb-1 mt-7 font-bold">Waktu Sholat DKI Jakarta</h1>
        <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">Waktu sekarang: <span id="time"></span> WIB</p>
        <ul class="flex flex-col mb-4 lg:mb-6">
            @foreach ($list_jadwal_sholat as $jadwal)
                <li class="flex items-center gap-4 py-2 relative before:border-l before:border-[#e3e3e0] dark:before:border-[#3E3E3A] before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute">
                    <span class="relative py-1 bg-white dark:bg-[#161615]">
                        <span class="flex items-center justify-center rounded-full bg-[#FDFDFC] dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border @if($jadwal['is']) border-[#007dd9] @else dark:border-[#3E3E3A] border-[#e3e3e0] @endif">
                            <span class="rounded-full @if($jadwal['is']) bg-[#007dd9] @else bg-[#dbdbd7] dark:bg-[#3E3E3A] @endif w-1.5 h-1.5"></span>
                        </span>
                    </span>
                    <span class="@if($jadwal['is'])font-bold @endif">
                        {{ $jadwal['nama'] }}<span class="inline-flex items-center space-x-1 @if($jadwal['is'])font-bold @else font-medium @endif text-[#007dd9] dark:text-[#007dd9] ml-1">{{ $jadwal['waktu'] }}</span> WIB
                    </span>
                </li>
            @endforeach
        </ul>
        <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">Follow Instagram <a target="_blank" href="https://instagram.com/lifeatlpdp" class="text-[#007dd9] dark:text-[#007dd9] font-medium">@lifeatlpdp</a></p>
    
        <!-- <div class="flex items-center gap-2">
            <a href="https://lpdp.kemenkeu.go.id/" target="_blank" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-center text-white bg-[#007dd9] hover:bg-[#005bb5] focus:ring-4 focus:outline-none focus:ring-[#007dd9]/50 rounded-lg shadow-[0px_1px_2px_0px_rgba(0,0,0,0.05),0px_1px_3px_0px_rgba(0,0,0,0.1)] dark:bg-[#007dd9] dark:hover:bg-[#005bb5] dark:focus:ring-[#007dd9]/40">Website</a>
            <a href="https://lpdp.kemenkeu.go.id/faq/" target="_blank" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-center text-white bg-[#007dd9] hover:bg-[#005bb5] focus:ring-4 focus:outline-none focus:ring-[#007dd9]/50 rounded-lg shadow-[0px_1px_2px_0px_rgba(0,0,0,0.05),0px_1px_3px_0px_rgba(0,0,0,0.1)] dark:bg-[#007dd9] dark:hover:bg-[#005bb5] dark:focus:ring-[#007dd9]/40">FAQ</a>
        </div> -->
    </div>
    <!-- <div class="bg-[#fff2f2] dark:bg-[#FFFFFF] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden">
        <img src="{{ asset('images/lpdp-ramadan.png') }}" alt="LPDP Ramadan" class="w-full h-full object-cover">
    </div> -->
@endsection
