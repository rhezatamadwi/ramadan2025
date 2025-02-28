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

        // get hari ini
        $hari_ini = DB::table('m_hari')->where('tanggal_masehi', date('Y-m-d'))->first();

        $is_isya = time() >= strtotime($hari_ini->isya);
        $is_maghrib = time() >= strtotime($hari_ini->maghrib) && time() < strtotime($hari_ini->isya);
        $is_ashar = time() >= strtotime($hari_ini->ashar) && time() < strtotime($hari_ini->maghrib);
        $is_dzuhur = time() >= strtotime($hari_ini->dzuhur) && time() < strtotime($hari_ini->ashar);
        $is_dhuha = time() >= strtotime($hari_ini->dhuha) && time() < strtotime($hari_ini->dzuhur);
        $is_terbit = time() >= strtotime($hari_ini->terbit) && time() < strtotime($hari_ini->dhuha);
        $is_subuh = time() >= strtotime($hari_ini->subuh) && time() < strtotime($hari_ini->terbit);
        $is_imsak = time() >= strtotime($hari_ini->imsak) && time() < strtotime($hari_ini->subuh);
        
        return view('home', [
            'nama' => $nama,
            'laporan_harian' => $laporan_harian,
            'hari_ini' => $hari_ini,
            'is_isya' => $is_isya,
            'is_maghrib' => $is_maghrib,
            'is_ashar' => $is_ashar,
            'is_dzuhur' => $is_dzuhur,
            'is_dhuha' => $is_dhuha,
            'is_terbit' => $is_terbit,
            'is_subuh' => $is_subuh,
            'is_imsak' => $is_imsak
        ]);
    }
}
