<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $options = [
            0 => 'Tidak',
            1 => 'Ya',
        ];

        $user = auth()->user();
        $is_wanita = $user->isWanita();

        // get laporan harian
        $list_laporan_harian = $this->getListLaporanHarian();

        // get hari ini
        $hari_ini = $this->getHariIni();

        // apakah sudah lapor hari ini
        $sudah_lapor_hari_ini = $this->getIsSudahLaporHariIni($hari_ini->id);

        // jika sudah lapor hari ini
        if($sudah_lapor_hari_ini) {
            session()->flash('alert-danger', 'Anda sudah melapor hari ini!');
            return redirect()->route('home');
        }

        // laporan_harian instance for getting attribute label
        $laporan_harian_instance = resolve(LaporanHarian::class);

        // apakah sudah lapor hari ini
        $sudah_lapor_hari_ini = $this->getIsSudahLaporHariIni($hari_ini->id);

        return view('laporan.create', [
            'options' => $options,
            'is_wanita' => $is_wanita,
            'list_laporan_harian' => $list_laporan_harian,
            'hari_ini' => $hari_ini,
            'laporan_harian_instance' => $laporan_harian_instance,
            'sudah_lapor_hari_ini' => $sudah_lapor_hari_ini,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $is_wanita = $user->isWanita();
        $is_haid = 0;
        if($is_wanita) {
            $is_haid = $request->is_haid;
        }

        // jika wanita dan haid
        if($is_wanita && $is_haid) {
            $attr_1 = 'haid_kajian';
            $attr_2 = 'haid_zikir';
            $attr_3 = 'haid_memberi_makanan_iftar';
            $attr_4 = 'haid_mendengar_alquran';
            $attr_5 = 'haid_infaq';
            $attr_6 = 'haid_membaca_surah_nabawiyah';
            $attr_7 = 'haid_membaca_hadist';
            
            $attr_8 = 'sholat_berjamaah';
            $attr_9 = 'mengaji';
            $attr_10 = 'infaq';
            $attr_11 = 'tarawih_berjamaah';
            $attr_12 = 'dhuha';
            $attr_13 = 'kajian';
            $attr_14 = 'tahajjud';
        }

        // jika pria atau wanita tidak haid
        else {
            $attr_1 = 'sholat_berjamaah';
            $attr_2 = 'mengaji';
            $attr_3 = 'infaq';
            $attr_4 = 'tarawih_berjamaah';
            $attr_5 = 'dhuha';
            $attr_6 = 'kajian';
            $attr_7 = 'tahajjud';

            $attr_8 = 'haid_kajian';
            $attr_9 = 'haid_zikir';
            $attr_10 = 'haid_memberi_makanan_iftar';
            $attr_11 = 'haid_mendengar_alquran';
            $attr_12 = 'haid_infaq';
            $attr_13 = 'haid_membaca_surah_nabawiyah';
            $attr_14 = 'haid_membaca_hadist';
        }

        // validate request
        $request->validate([
            'tanggal' => 'required|date_format:Y-m-d|date_equals:today',
            $attr_1 => 'required|in:0,1',
            $attr_2 => 'required|in:0,1',
            $attr_3 => 'required|in:0,1',
            $attr_4 => 'required|in:0,1',
            $attr_5 => 'required|in:0,1',
            $attr_6 => 'required|in:0,1',
            $attr_7 => 'required|in:0,1',
        ], [
            '*.required' => ':attribute wajib diisi',
            '*.date_format' => ':attribute tidak sesuai format',
            '*.date_equals' => ':attribute tidak sesuai tanggal hari ini',
            '*.in' => ':attribute tidak sesuai pilihan',
        ]);

        // get hari ini
        $hari_ini = $this->getHariIni();

        // jika tidak ditemukan
        if (!$hari_ini) {
            return redirect()->back()->withErrors([
                'tanggal' => 'Tanggal tidak ditemukan',
            ]);
        }

        // save to database
        $laporan = LaporanHarian::where('id_user', $user->id)
            ->where('id_hari', $hari_ini->id)
            ->first();

        if(!$laporan)
            $laporan = new LaporanHarian;
        
        $laporan->id_user = $user->id;
        $laporan->id_hari = $hari_ini->id;
        $laporan->is_haid = $is_haid;

        $laporan->$attr_1 = $request->$attr_1;
        $laporan->$attr_2 = $request->$attr_2;
        $laporan->$attr_3 = $request->$attr_3;
        $laporan->$attr_4 = $request->$attr_4;
        $laporan->$attr_5 = $request->$attr_5;
        $laporan->$attr_6 = $request->$attr_6;
        $laporan->$attr_7 = $request->$attr_7;
        $laporan->$attr_8 = 0;
        $laporan->$attr_9 = 0;
        $laporan->$attr_10 = 0;
        $laporan->$attr_11 = 0;
        $laporan->$attr_12 = 0;
        $laporan->$attr_13 = 0;
        $laporan->$attr_14 = 0;

        $laporan->total = $laporan->$attr_1 + $laporan->$attr_2 + $laporan->$attr_3 + $laporan->$attr_4 + $laporan->$attr_5 + $laporan->$attr_6 + $laporan->$attr_7;

        $laporan->save();

        // set flash message
        session()->flash('alert-success', 'Sukses menyimpan laporan!');
        
        // redirect to index
        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $options = [
            0 => 'Tidak',
            1 => 'Ya',
        ];

        $user = auth()->user();
        $is_wanita = $user->isWanita();

        // get laporan harian by id
        $laporan_harian_instance = LaporanHarian::select(
            'laporan_harian.*',
            'm_hari.tanggal_hijriyah',
            'm_hari.tanggal_masehi'
        )
        ->join('m_hari', 'laporan_harian.id_hari', '=', 'm_hari.id')
        ->where('laporan_harian.id', $id)
        ->orderBy('created_at', 'desc')
        ->first();

        // jika id user tidak sama dengan id_user pada laporan harian, atau tanggal tidak sama dengan hari ini
        if(Gate::denies('update-laporan', $laporan_harian_instance)) {
            session()->flash('alert-danger', 'Anda sudah tidak memiliki akses untuk mengubah laporan ini!');
            return redirect()->route('home');
        }

        // get laporan harian
        $list_laporan_harian = $this->getListLaporanHarian();

        // get hari ini
        $hari_ini = $this->getHariIni();

        // apakah sudah lapor hari ini
        $sudah_lapor_hari_ini = $this->getIsSudahLaporHariIni($hari_ini->id);

        return view('laporan.create', [
            'options' => $options,
            'is_wanita' => $is_wanita,
            'list_laporan_harian' => $list_laporan_harian,
            'laporan_harian_instance' => $laporan_harian_instance,
            'hari_ini' => $hari_ini,
            'sudah_lapor_hari_ini' => $sudah_lapor_hari_ini
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
