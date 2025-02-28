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

        // get hari ini
        $hari_ini = DB::table('m_hari')->where('tanggal_masehi', date('Y-m-d'))->first();

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

            $laporan_harian_hari_ini = DB::table('laporan_harian')
                ->select(DB::raw('count(*) as jumlah'))
                ->where('id_user', auth()->user()->id)
                ->where('id_hari', $hari_ini->id)
                ->first();
        }

        $list_jadwal_sholat = [
            0 => [
                'waktu' => $hari_ini->imsak,
                'nama' => 'Imsak',
                'is' => time() >= strtotime($hari_ini->imsak) && time() < strtotime($hari_ini->subuh)
            ],
            1 => [
                'waktu' => $hari_ini->subuh,
                'nama' => 'Subuh',
                'is' => time() >= strtotime($hari_ini->subuh) && time() < strtotime($hari_ini->terbit)
            ],
            2 => [
                'waktu' => $hari_ini->terbit,
                'nama' => 'Terbit',
                'is' => time() >= strtotime($hari_ini->terbit) && time() < strtotime($hari_ini->dhuha)
            ],
            3 => [
                'waktu' => $hari_ini->dhuha,
                'nama' => 'Dhuha',
                'is' => time() >= strtotime($hari_ini->dhuha) && time() < strtotime($hari_ini->dzuhur)
            ],
            4 => [
                'waktu' => $hari_ini->dzuhur,
                'nama' => 'Dzuhur',
                'is' => time() >= strtotime($hari_ini->dzuhur) && time() < strtotime($hari_ini->ashar)
            ],
            5 => [
                'waktu' => $hari_ini->ashar,
                'nama' => 'Ashar',
                'is' => time() >= strtotime($hari_ini->ashar) && time() < strtotime($hari_ini->maghrib)
            ],
            6 => [
                'waktu' => $hari_ini->maghrib,
                'nama' => 'Maghrib',
                'is' => time() >= strtotime($hari_ini->maghrib) && time() < strtotime($hari_ini->isya)
            ],
            7 => [
                'waktu' => $hari_ini->isya,
                'nama' => 'Isya',
                'is' => time() >= strtotime($hari_ini->isya)
            ],
        ];
        
        return view('home', [
            'nama' => $nama,
            'laporan_harian' => $laporan_harian,
            'hari_ini' => $hari_ini,
            'list_jadwal_sholat' => $list_jadwal_sholat,
            'sudah_lapor_hari_ini' => isset($laporan_harian_hari_ini) && $laporan_harian_hari_ini->jumlah > 0
        ]);
    }
}
