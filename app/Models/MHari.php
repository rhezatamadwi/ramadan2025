<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MHari extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_hari';

    /**
     * Mendapatkan tanggal Masehi yang diformat.
     * 
     * Fungsi ini mengubah tanggal Masehi dari format database menjadi 
     * format yang lebih mudah dibaca (contoh: 1 Januari 2025).
     * 
     * @return string Tanggal Masehi yang sudah diformat (tanggal bulan tahun).
     */
    public function getFormattedDate(): string {
        return date('j F Y', strtotime($this->tanggal_masehi));
    }
}
