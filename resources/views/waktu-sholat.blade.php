@extends('layouts.layout')

@section('content')
    <div class="text-[16px] leading-[24px] flex-1 p-6 pb-12 lg:p-10 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
        <h1 class="mb-1 font-bold">Waktu Sholat DKI Jakarta Ramadan 1446H</h1>
        <p class="text-[#706f6c] dark:text-[#A1A09A]">Waktu sekarang: <span id="time"></span> WIB</p>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-[#161615] border-collapse mt-8 text-xs lg:text-sm">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-800">
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Tanggal</th>
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Imsak</th>
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Subuh</th>
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Terbit</th>
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Dhuha</th>
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Dzuhur</th>
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Ashar</th>
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Maghrib</th>
                <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left font-semibold">Isya</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_jadwal_sholat as $jadwal)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 @if($jadwal->tanggal_masehi == date('Y-m-d')) font-bold @elseif($jadwal->tanggal_masehi < date('Y-m-d')) text-[#bbbbbb] dark:text-[#505050] @endif">
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">{{ $jadwal->tanggal_hijriyah . ' / ' . $jadwal->getFormattedDate() }}</td>
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 @if($jadwal->tanggal_masehi == date('Y-m-d') && $is_imsak) text-[#007dd9] breathing-text @endif">{{ $jadwal->imsak }}</td>
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 @if($jadwal->tanggal_masehi == date('Y-m-d') && $is_subuh) text-[#007dd9] breathing-text @endif">{{ $jadwal->subuh }}</td>
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 @if($jadwal->tanggal_masehi == date('Y-m-d') && $is_terbit) text-[#007dd9] breathing-text @endif">{{ $jadwal->terbit }}</td>
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 @if($jadwal->tanggal_masehi == date('Y-m-d') && $is_dhuha) text-[#007dd9] breathing-text @endif">{{ $jadwal->dhuha }}</td>
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 @if($jadwal->tanggal_masehi == date('Y-m-d') && $is_dzuhur) text-[#007dd9] breathing-text @endif">{{ $jadwal->dzuhur }}</td>
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 @if($jadwal->tanggal_masehi == date('Y-m-d') && $is_ashar) text-[#007dd9] breathing-text @endif">{{ $jadwal->ashar }}</td>
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 @if($jadwal->tanggal_masehi == date('Y-m-d') && $is_maghrib) text-[#007dd9] breathing-text @endif">{{ $jadwal->maghrib }}</td>
                    <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 @if($jadwal->tanggal_masehi == date('Y-m-d') && $is_isya) text-[#007dd9] breathing-text @endif">{{ $jadwal->isya }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection
