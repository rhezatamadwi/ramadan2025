@extends('layouts.layout')

@section('content')
    <div class="bg-white text-[16px] leading-[24px] dark:bg-[#161615] dark:text-[#EDEDEC] shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
        <div class="bg-gray-100 py-4 px-4">
            <h2 class="text-xl font-semibold text-gray-800">Hamba Allah Teraktif</h2>
        </div>
        <ul class="divide-y divide-gray-200">
            @foreach ($list_leaderboard as $leaderboard)
                <li class="flex items-center py-4 px-6">
                    <span class="text-gray-700 text-lg font-medium mr-4">{{ $loop->index + 1 }}.</span>
                    <img class="w-12 h-12 rounded-full object-cover mr-4" src="https://randomuser.me/api/portraits/lego/1.jpg" alt="User avatar">
                    <div class="flex-1 mr-4">
                        <h3 class="text-lg font-medium">{{ $leaderboard->name }}</h3>
                        <p class="text-base">Total Skor: {{ $leaderboard->total_score }}</p>
                    </div>

                    <a class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-center text-white bg-[#007dd9] hover:bg-[#005bb5] focus:ring-4 focus:outline-none focus:ring-[#007dd9]/50 rounded-lg shadow-[0px_1px_2px_0px_rgba(0,0,0,0.05),0px_1px_3px_0px_rgba(0,0,0,0.1)] dark:bg-[#007dd9] dark:hover:bg-[#005bb5] dark:focus:ring-[#007dd9]/40" href="{{ route('leaderboard.show', $leaderboard->id) }}">Lihat Detail</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
