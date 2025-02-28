<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    //
    /**
     * Mendapatkan daftar laporan harian untuk pengguna yang sedang login.
     * 
     * Method ini mengambil seluruh data laporan harian milik pengguna yang sedang login
     * beserta informasi tanggal hijriyah dan masehi yang terkait dari tabel m_hari.
     * Hasil diurutkan berdasarkan waktu pembuatan secara menurun (terbaru dulu).
     * 
     * @return \Illuminate\Database\Eloquent\Collection Koleksi objek LaporanHarian dengan data tambahan
     */
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

    /**
     * Mengambil data hari untuk tanggal hari ini dari tabel m_hari.
     *
     * Fungsi ini mengambil data hari yang sesuai dengan tanggal masehi hari ini (tanggal saat ini)
     * dari tabel m_hari dalam database.
     *
     * @return object|null Objek yang berisi data hari untuk tanggal hari ini atau null jika tidak ditemukan.
     */
    public function getHariIni(): object|null {
        return DB::table('m_hari')->where('tanggal_masehi', date('Y-m-d'))->first();
    }

    /**
     * Memeriksa apakah pengguna yang sedang login sudah melaporkan untuk hari tertentu
     * 
     * Fungsi ini mengueri tabel 'laporan_harian' untuk memeriksa apakah pengguna
     * saat ini telah mengirimkan laporan untuk id_hari yang ditentukan.
     *
     * @param int $id_hari ID hari yang akan diperiksa
     * @return bool TRUE jika pengguna sudah melaporkan pada hari tersebut, FALSE jika belum
     */
    public function getIsSudahLaporHariIni(int $id_hari) {
        $laporan_harian_hari_ini = DB::table('laporan_harian')
                ->select(DB::raw('count(*) as jumlah'))
                ->where('id_user', auth()->user()->id)
                ->where('id_hari', $id_hari)
                ->first();

        return $laporan_harian_hari_ini->jumlah > 0;
    }
}
