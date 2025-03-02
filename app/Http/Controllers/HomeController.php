<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use App\Models\MHari;
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

    public function waktuSholat() {
        $from = date('2025-03-01');
        $to = date('2025-03-31');

        $list_jadwal_sholat = MHari::whereBetween('tanggal_masehi', [$from, $to])->get();

        // get hari ini
        $hari_ini = $this->getHariIni();

        $is_imsak = time() >= strtotime($hari_ini->imsak) && time() < strtotime($hari_ini->subuh);
        $is_subuh = time() >= strtotime($hari_ini->subuh) && time() < strtotime($hari_ini->terbit);
        $is_terbit = time() >= strtotime($hari_ini->terbit) && time() < strtotime($hari_ini->dhuha);
        $is_dhuha = time() >= strtotime($hari_ini->dhuha) && time() < strtotime($hari_ini->dzuhur);
        $is_dzuhur = time() >= strtotime($hari_ini->dzuhur) && time() < strtotime($hari_ini->ashar);
        $is_ashar = time() >= strtotime($hari_ini->ashar) && time() < strtotime($hari_ini->maghrib);
        $is_maghrib = time() >= strtotime($hari_ini->maghrib) && time() < strtotime($hari_ini->isya);
        $is_isya = time() >= strtotime($hari_ini->isya);

        $list_laporan_harian = null;
        $sudah_lapor_hari_ini = false;
        if(auth()->user()) {
            // get laporan harian
            $list_laporan_harian = $this->getListLaporanHarian();

            // apakah sudah lapor hari ini
            $sudah_lapor_hari_ini = $this->getIsSudahLaporHariIni($hari_ini->id);
        }
        
        return view('waktu-sholat', [
            'list_jadwal_sholat' => $list_jadwal_sholat,
            'hari_ini' => $hari_ini,
            'is_imsak' => $is_imsak,
            'is_subuh' => $is_subuh,
            'is_terbit' => $is_terbit,
            'is_dhuha' => $is_dhuha,
            'is_dzuhur' => $is_dzuhur,
            'is_ashar' => $is_ashar,
            'is_maghrib' => $is_maghrib,
            'is_isya' => $is_isya,
            'list_laporan_harian' => $list_laporan_harian,
            'sudah_lapor_hari_ini' => $sudah_lapor_hari_ini
        ]);
    }
}
