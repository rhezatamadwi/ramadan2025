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
        $list_laporan_harian = null;
        $sudah_lapor_hari_ini = false;

        // get hari ini
        $hari_ini = $this->getHariIni();

        if($nama) {
            // get laporan harian
            $list_laporan_harian = $this->getListLaporanHarian();

            // apakah sudah lapor hari ini
            $sudah_lapor_hari_ini = $this->getIsSudahLaporHariIni($hari_ini->id);
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
            'list_laporan_harian' => $list_laporan_harian,
            'hari_ini' => $hari_ini,
            'list_jadwal_sholat' => $list_jadwal_sholat,
            'sudah_lapor_hari_ini' => $sudah_lapor_hari_ini
        ]);
    }
}
