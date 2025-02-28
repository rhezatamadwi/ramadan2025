<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    //
    public function getListLaporanHarian() {
        $laporan_harian = LaporanHarian::select(
            'laporan_harian.*',
            'm_hari.tanggal_hijriyah',
            'm_hari.tanggal_masehi'
        )
        ->join('m_hari', 'laporan_harian.id_hari', '=', 'm_hari.id')
        ->where('id_user', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return $laporan_harian;
    }

    public function getHariIni(): object|null {
        return DB::table('m_hari')->where('tanggal_masehi', date('Y-m-d'))->first();
    }

    public function getIsSudahLaporHariIni(int $id_hari) {
        $laporan_harian_hari_ini = DB::table('laporan_harian')
                ->select(DB::raw('count(*) as jumlah'))
                ->where('id_user', auth()->user()->id)
                ->where('id_hari', $id_hari)
                ->first();

        return $laporan_harian_hari_ini->jumlah > 0;
    }
}
