<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        $nama = auth()->user()->name ?? null;
        $laporan_harian = null;

        if($nama) {
            // get laporan harian
            $laporan_harian = LaporanHarian::select(
                'laporan_harian.*',
                'm_hari.tanggal_hijriyah',
                'm_hari.tanggal_masehi'
            )
            ->join('m_hari', 'laporan_harian.id_hari', '=', 'm_hari.id')
            ->where('id_user', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        }

        return view('home', [
            'nama' => $nama,
            'laporan_harian' => $laporan_harian
        ]);
    }
}
