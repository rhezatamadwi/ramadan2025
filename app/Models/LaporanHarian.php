<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laporan_harian';

    /**
     * Mendapatkan label yang sesuai untuk atribut model.
     *
     * Fungsi ini mengembalikan label yang lebih mudah dibaca untuk berbagai atribut model LaporanHarian.
     * Label digunakan untuk tampilan form, validasi, dan output ke pengguna.
     *
     * Atribut yang ditangani:
     * - id_hari: Label untuk hari
     * - id_user: Label untuk pengguna
     * - is_haid: Status haid pengguna wanita
     * - sholat_berjamaah: Status pelaksanaan sholat berjamaah
     * - mengaji: Status membaca Al-Quran minimal 2 lembar
     * - infaq: Status berinfaq
     * - tarawih_berjamaah: Status pelaksanaan tarawih berjamaah
     * - dhuha: Status pelaksanaan sholat dhuha
     * - kajian: Status mendengarkan kajian Islam
     * - tahajjud: Status pelaksanaan sholat tahajjud
     * 
     * Atribut khusus untuk wanita yang sedang haid:
     * - haid_kajian: Status mendengarkan kajian Islam
     * - haid_zikir: Status berdzikir
     * - haid_memberi_makanan_iftar: Status memberi makanan berbuka
     * - haid_mendengar_alquran: Status mendengarkan Al-Quran
     * - haid_infaq: Status berinfaq
     * - haid_membaca_surah_nabawiyah: Status membaca surah nabawiyah
     * - haid_membaca_hadist: Status membaca hadist
     *
     * @param string $attribute Nama atribut yang ingin didapatkan labelnya
     * @return string Label yang sesuai untuk atribut tersebut
     */
    public function getAttributeLabel($attribute): string {
        return match ($attribute) {
            'id_hari' => 'Hari',
            'id_user' => 'User',
            'is_haid' => 'Apakah Anda Sedang Datang Bulan?',
            'sholat_berjamaah' => 'Apakah Anda Sudah Melaksanakan 3x Sholat Berjamaah di Masjid/Sholat Diawal Waktu?',
            'mengaji' => 'Apakah Anda Sudah Mengaji Minimal 2 lembar?',
            'infaq' => 'Apakah Anda Sudah Berinfaq?',
            'tarawih_berjamaah' => 'Apakah Anda Sudah Melaksanakan Tarawih Berjamaah?',
            'dhuha' => 'Apakah Anda Sudah Melaksanakan Sholat Dhuha?',
            'kajian' => 'Apakah Anda Sudah Mendengarkan Kajian Islam?',
            'tahajjud' => 'Apakah Anda Sudah Melaksanakan Sholat Tahajjud?',
            'haid_kajian' => 'Apakah Anda Sudah Mendengarkan Kajian Islam?',
            'haid_zikir' => 'Apakah Anda Sudah Berdzikir?',
            'haid_memberi_makanan_iftar' => 'Apakah Anda Sudah Memberi Makanan Orang yang Berpuasa?',
            'haid_mendengar_alquran' => 'Apakah Anda Sudah Mendengarkan Al-Quran?',
            'haid_infaq' => 'Apakah Anda Sudah Berinfaq?',
            'haid_membaca_surah_nabawiyah' => 'Apakah Anda Sudah Membaca Sirah Nabawiyah?',
            'haid_membaca_hadist' => 'Apakah Anda Sudah Membaca Hadist?',
            default => $attribute,
        };
    }

    /**
     * Mendapatkan nilai atribut dengan format HTML yang menampilkan "Ya" atau "Tidak".
     *
     * Metode ini memformat nilai boolean (1 atau 0) ke dalam tampilan HTML span
     * dengan warna hijau untuk nilai 1 (Ya) dan merah untuk nilai 0 (Tidak).
     * Digunakan untuk menampilkan status dalam antarmuka pengguna.
     *
     * @param string $attribute Nama atribut yang akan diformat
     * @return string HTML yang telah diformat dengan class Tailwind CSS
     */
    public function getFormattedAttribute($attribute): string {
        return $this->$attribute == 1 ? '<span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset">Ya</span>' : '<span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset">Tidak</span>';
    }

    /**
     * Mengembalikan daftar atribut yang diisi berdasarkan status haid.
     * 
     * Jika pengguna sedang dalam kondisi haid, fungsi ini akan mengembalikan
     * daftar atribut khusus untuk kondisi haid seperti kajian, zikir, dll.
     * Jika tidak, fungsi akan mengembalikan daftar atribut ibadah reguler
     * seperti sholat berjamaah, mengaji, dll.
     *
     * @return array Daftar nama atribut yang bisa diisi sesuai kondisi
     */
    public function getListAttributesFilled(): array {
        if($this->is_haid) {
            return [
                'haid_kajian',
                'haid_zikir',
                'haid_memberi_makanan_iftar',
                'haid_mendengar_alquran',
                'haid_infaq',
                'haid_membaca_surah_nabawiyah',
                'haid_membaca_hadist'
            ];
        } else {
            return [
                'sholat_berjamaah',
                'mengaji',
                'infaq',
                'tarawih_berjamaah',
                'dhuha',
                'kajian',
                'tahajjud'
            ];
        }
    }

    /**
     * Mendapatkan tanggal masehi dalam format "j F Y" (contoh: 1 Januari 2023)
     *
     * Method ini mengubah tanggal masehi model saat ini menjadi format yang lebih mudah dibaca.
     * 
     * @return string Tanggal masehi yang sudah diformat
     */
    public function getFormattedDate(): string {
        return date('j F Y', strtotime($this->tanggal_masehi));
    }
}
