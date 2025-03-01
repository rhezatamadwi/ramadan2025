@extends('layouts.layout')

@section('content')
    <div class="bg-white text-[16px] leading-[24px] dark:bg-[#161615] dark:text-[#EDEDEC] shadow-md rounded-md overflow-hidden max-w-3xl mx-auto mt-16">
        <div class="bg-gray-100 py-4 px-4">
            <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }} <span class="inline-flex items-center rounded bg-green-50 px-2 py-1 mx-2 text-sm font-medium text-green-700 ring-1 ring-green-600/10 ring-inset">Total Skor: {{ $total_skor }}</span></h2>
        </div>
        <div class="px-6 divide-y divide-gray-200">
            <div class="border-b border-slate-200">
                @foreach ($list_laporan_harian as $laporan)
                    <button onclick="toggleAccordion({{ $loop->index }})" class="w-full flex justify-between items-center py-5 text-slate-800">
                        <!-- accordion title -->
                        <span class="flex justify-between text-lg font-bold dark:text-[#EDEDEC]">
                            {!! $laporan->tanggal_hijriyah . ' / ' . $laporan->getFormattedDate() !!}

                            <!-- label datang bulan -->
                            @if ($laporan->is_haid)
                                <span class="inline-flex items-center rounded bg-red-50 px-2 py-1 mx-2 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset">Datang Bulan</span>
                            @endif

                            <!-- skor -->
                            <span class="inline-flex items-center rounded bg-green-50 px-2 py-1 mx-2 text-xs font-medium text-green-700 ring-1 ring-green-600/10 ring-inset">Skor Harian: {{ $laporan->total }}</span>
                        </span>
                        <span id="icon-{{ $loop->index }}" class="text-slate-800 transition-transform duration-300 dark:text-[#EDEDEC]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M11.78 9.78a.75.75 0 0 1-1.06 0L8 7.06 5.28 9.78a.75.75 0 0 1-1.06-1.06l3.25-3.25a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                    <!-- accordion content -->
                    <div id="content-{{ $loop->index }}" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="pb-5 text-sm text-slate-500">
                            <table class="table-auto w-full">
                                @foreach ($laporan->getListAttributesFilled() as $attribute)
                                    <tr>
                                        <td class="px-4 py-2 border-b border-gray-200">
                                            {{ $laporan->getAttributeLabel($attribute) }}
                                        </td>
                                        <td class="px-4 py-2 border-b border-gray-200">
                                            {!! $laporan->getFormattedAttribute($attribute) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
