<?php

namespace App\Providers;

use App\Models\LaporanHarian;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Mendefinisikan gate authorization 'update-laporan' yang mengontrol izin untuk memperbarui laporan harian.
         * 
         * Gate ini mengizinkan pengguna untuk memperbarui laporan hanya jika:
         * 1. Pengguna adalah pemilik laporan (ID pengguna sama dengan ID user laporan)
         * 2. Laporan dibuat pada tanggal hari ini (tanggal_masehi laporan sama dengan tanggal saat ini)
         * 
         * @param User $user - Pengguna yang mencoba melakukan pembaruan
         * @param LaporanHarian $laporan - Objek laporan harian yang akan diperbarui
         * @return bool - TRUE jika pengguna diizinkan memperbarui laporan, FALSE jika tidak
         */
        Gate::define('update-laporan', function (User $user, LaporanHarian $laporan): bool {
            return $user->id === $laporan->id_user && $laporan->tanggal_masehi == date('Y-m-d');
        });


        /**
         * Mendefinisikan kebijakan otorisasi 'view-leaderboard'.
         * 
         * Gate ini mengontrol akses ke fitur leaderboard:
         * - Mengizinkan pengguna admin untuk melihat leaderboard
         * - Menolak pengguna non-admin dengan respons "not found" (404)
         * untuk menyembunyikan keberadaan fitur tersebut
         * 
         * @param  \App\Models\User  $user  Pengguna yang sedang diautentikasi
         * @return \Illuminate\Auth\Access\Response
         */
        Gate::define('view-leaderboard', function (User $user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::denyAsNotFound();
        });
    }
}
