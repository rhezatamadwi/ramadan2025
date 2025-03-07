<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LeaderboardController extends Controller
{
    //
    public function index()
    {
        Gate::authorize('view-leaderboard');
        
        // list leaderboard
        $list_leaderboard = LaporanHarian::select(
            'users.id',
            'users.name',
            DB::raw('SUM(laporan_harian.total) AS total_score')
        )
        ->join('users', 'users.id', '=', second: 'laporan_harian.id_user')
        ->where('laporan_harian.id_hari', '>=', 8) // dihitung mulai dari 3 Ramadan
        ->groupBy('users.id')
        ->orderBy('total_score', 'desc')
        ->get();

        return view('leaderboard.index', [
            'list_leaderboard' => $list_leaderboard,
        ]);
    }

    public function show($id) {
        Gate::authorize('view-leaderboard');

        // get user
        $user = DB::table('users')->where('id', $id)->first();

        // get total skor
        $total_skor = DB::table('laporan_harian')
            ->select(DB::raw('SUM(total) as total'))
            ->where('id_user', $id)
            ->first();
        $total_skor = $total_skor->total;

        // get list laporan harian
        $list_laporan_harian = LaporanHarian::select(
            'laporan_harian.*',
            'm_hari.tanggal_hijriyah',
            'm_hari.tanggal_masehi'
        )
        ->join('m_hari', 'laporan_harian.id_hari', '=', 'm_hari.id')
        ->where('id_user', $id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('leaderboard.show', [
            'user' => $user,
            'total_skor' => $total_skor,
            'list_laporan_harian' => $list_laporan_harian,
        ]);
    }
}
