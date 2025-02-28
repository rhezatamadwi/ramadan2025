@extends('layouts.layout')

@section('content')
    <div class="text-[16px] leading-[24px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
        <h1 class="mb-1 font-medium">Buat Laporan Harian</h1>
        <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">Hari ini <span class="text-[#007dd9] dark:text-[#007dd9] font-medium">{{ $hari_ini->tanggal_hijriyah }}</span> / {{ date('j F Y', strtotime($hari_ini->tanggal_masehi)) }}</p>
        
        <!-- Form -->
        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf

            <input type="hidden" name="tanggal" value="{{ $laporan_harian_by_id->tanggal_masehi ?? date('Y-m-d') }}">
            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />

            @if ($is_wanita)
                <!-- Apakah Sedang Haid -->
                <div class="mt-8">
                    <x-input-label for="is_haid" :value="__('Apakah Anda Sedang Datang Bulan?')" />
                    <x-select-input id="is_haid" class="block mt-1 w-full" type="text" name="is_haid" :value="old('is_haid')" :selected="$laporan_harian_by_id->is_haid ?? null" :options="$options" :is_include_empty="1" :required="1" />
                    <x-input-error :messages="$errors->get('is_haid')" class="mt-2" />
                </div>
            @endif

            <div id="container-laporan-form" @if ($is_wanita) style="display: none;" @endif>
                <!-- Melaksanakan 3x kalo Sholat Berjamaah di Masjid/ Sholat Diawal Waktu -->
                <div class="mt-8">
                    <x-input-label for="sholat_berjamaah" :value="__('Apakah Anda Sudah Melaksanakan 3x Sholat Berjamaah di Masjid/Sholat Diawal Waktu?')" />
                    <x-select-input id="sholat_berjamaah" class="block mt-1 w-full" type="text" name="sholat_berjamaah" :value="old('sholat_berjamaah')" :selected="$laporan_harian_by_id->sholat_berjamaah ?? null" :options="$options" :required="1" />
                    <x-input-error :messages="$errors->get('sholat_berjamaah')" class="mt-2" />
                </div>

                <!-- Melaksanakan Mengaji 2 lembar -->
                <div class="mt-8">
                    <x-input-label for="mengaji" :value="__('Apakah Anda Sudah Mengaji Minimal 2 lembar?')" />
                    <x-select-input id="mengaji" class="block mt-1 w-full" type="text" name="mengaji" :value="old('mengaji')" :selected="$laporan_harian_by_id->mengaji ?? null" :options="$options" :required="1" />
                    <x-input-error :messages="$errors->get('mengaji')" class="mt-2" />
                </div>

                <!-- Melaksanakan Infaq -->
                <div class="mt-8">
                    <x-input-label for="infaq" :value="__('Apakah Anda Sudah Berinfaq?')" />
                    <x-select-input id="infaq" class="block mt-1 w-full" type="text" name="infaq" :value="old('infaq')" :selected="$laporan_harian_by_id->infaq ?? null" :options="$options" :required="1" />
                    <x-input-error :messages="$errors->get('infaq')" class="mt-2" />
                </div>

                <!-- Melaksanakan Tarawih Berjamaah -->
                <div class="mt-8">
                    <x-input-label for="tarawih_berjamaah" :value="__('Apakah Anda Sudah Melaksanakan Tarawih Berjamaah?')" />
                    <x-select-input id="tarawih_berjamaah" class="block mt-1 w-full" type="text" name="tarawih_berjamaah" :value="old('tarawih_berjamaah')" :selected="$laporan_harian_by_id->tarawih_berjamaah ?? null" :options="$options" :required="1" />
                    <x-input-error :messages="$errors->get('tarawih_berjamaah')" class="mt-2" />
                </div>

                <!-- Melaksanakan Sholat Dhuha -->
                <div class="mt-8">
                    <x-input-label for="dhuha" :value="__('Apakah Anda Sudah Melaksanakan Sholat Dhuha?')" />
                    <x-select-input id="dhuha" class="block mt-1 w-full" type="text" name="dhuha" :value="old('dhuha')" :selected="$laporan_harian_by_id->dhuha ?? null" :options="$options" :required="1" />
                    <x-input-error :messages="$errors->get('dhuha')" class="mt-2" />
                </div>

                <!-- Mendengar Kajian Islam -->
                <div class="mt-8">
                    <x-input-label for="kajian" :value="__('Apakah Anda Sudah Mendengarkan Kajian Islam?')" />
                    <x-select-input id="kajian" class="block mt-1 w-full" type="text" name="kajian" :value="old('kajian')" :selected="$laporan_harian_by_id->kajian ?? null" :options="$options" :required="1" />
                    <x-input-error :messages="$errors->get('kajian')" class="mt-2" />
                </div>

                <!-- Melaksanakan Tahajjud -->
                <div class="mt-8">
                    <x-input-label for="tahajjud" :value="__('Apakah Anda Sudah Melaksanakan Sholat Tahajjud?')" />
                    <x-select-input id="tahajjud" class="block mt-1 w-full" type="text" name="tahajjud" :value="old('tahajjud')" :selected="$laporan_harian_by_id->tahajjud ?? null" :options="$options" :required="1" />
                    <x-input-error :messages="$errors->get('tahajjud')" class="mt-2" />
                </div>
            </div>

            @if ($is_wanita)
                <div id="container-laporan-haid-form" style="display: none;">
                    <!-- Haid: Mendengar Kajian Islam -->
                    <div class="mt-8">
                        <x-input-label for="haid_kajian" :value="__('Apakah Anda Sudah Mendengarkan Kajian Islam?')" />
                        <x-select-input id="haid_kajian" class="block mt-1 w-full" type="text" name="haid_kajian" :value="old('haid_kajian')" :selected="$laporan_harian_by_id->haid_kajian ?? null" :options="$options" :required="1" />
                        <x-input-error :messages="$errors->get('haid_kajian')" class="mt-2" />
                    </div>

                    <!-- Haid: Berdzikir -->
                    <div class="mt-8">
                        <x-input-label for="haid_zikir" :value="__('Apakah Anda Sudah Berdzikir?')" />
                        <x-select-input id="haid_zikir" class="block mt-1 w-full" type="text" name="haid_zikir" :value="old('haid_zikir')" :selected="$laporan_harian_by_id->haid_zikir ?? null" :options="$options" :required="1" />
                        <x-input-error :messages="$errors->get('haid_zikir')" class="mt-2" />
                    </div>

                    <!-- Haid: Memberi Makanan Orang yang Berpuasa -->
                    <div class="mt-8">
                        <x-input-label for="haid_memberi_makanan_iftar" :value="__('Apakah Anda Sudah Memberi Makanan Orang yang Berpuasa?')" />
                        <x-select-input id="haid_memberi_makanan_iftar" class="block mt-1 w-full" type="text" name="haid_memberi_makanan_iftar" :value="old('haid_zikir')" :selected="$laporan_harian_by_id->haid_memberi_makanan_iftar ?? null" :options="$options" :required="1" />
                        <x-input-error :messages="$errors->get('haid_memberi_makanan_iftar')" class="mt-2" />
                    </div>

                    <!-- Haid: Mendengarkan Al-Quran -->
                    <div class="mt-8">
                        <x-input-label for="haid_mendengar_alquran" :value="__('Apakah Anda Sudah Mendengarkan Al-Quran?')" />
                        <x-select-input id="haid_mendengar_alquran" class="block mt-1 w-full" type="text" name="haid_mendengar_alquran" :value="old('haid_mendengar_alquran')" :selected="$laporan_harian_by_id->haid_mendengar_alquran ?? null" :options="$options" :required="1" />
                        <x-input-error :messages="$errors->get('haid_mendengar_alquran')" class="mt-2" />
                    </div>

                    <!-- Haid: Infaq -->
                    <div class="mt-8">
                        <x-input-label for="haid_infaq" :value="__('Apakah Anda Sudah Berinfaq?')" />
                        <x-select-input id="haid_infaq" class="block mt-1 w-full" type="text" name="haid_infaq" :value="old('haid_infaq')" :selected="$laporan_harian_by_id->haid_infaq ?? null" :options="$options" :required="1" />
                        <x-input-error :messages="$errors->get('haid_infaq')" class="mt-2" />
                    </div>

                    <!-- Haid: Membaca Surah Nabawiyah -->
                    <div class="mt-8">
                        <x-input-label for="haid_membaca_surah_nabawiyah" :value="__('Apakah Anda Sudah Membaca Surah Nabawiyah?')" />
                        <x-select-input id="haid_membaca_surah_nabawiyah" class="block mt-1 w-full" type="text" name="haid_membaca_surah_nabawiyah" :value="old('haid_membaca_surah_nabawiyah')" :selected="$laporan_harian_by_id->haid_membaca_surah_nabawiyah ?? null" :options="$options" :required="1" />
                        <x-input-error :messages="$errors->get('haid_membaca_surah_nabawiyah')" class="mt-2" />
                    </div>

                    <!-- Haid: Membaca Hadist -->
                    <div class="mt-8">
                        <x-input-label for="haid_membaca_hadist" :value="__('Apakah Anda Sudah Membaca Hadist?')" />
                        <x-select-input id="haid_membaca_hadist" class="block mt-1 w-full" type="text" name="haid_membaca_hadist" :value="old('haid_membaca_hadist')" :selected="$laporan_harian_by_id->haid_membaca_hadist ?? null" :options="$options" :required="1" />
                        <x-input-error :messages="$errors->get('haid_membaca_hadist')" class="mt-2" />
                    </div>
                </div>
            @endif

            <div class="mt-12 flex items-center justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Simpan</button>
            </div>
        </form>
    </div>
@endsection
