@extends('layouts.layout')

@section('content')
    <div class="text-[16px] leading-[24px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
        <h1 class="mb-1 font-medium">Buat Laporan Harian</h1>
        <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">Hari ini <span class="text-[#f53003] dark:text-[#FF4433] font-medium">1 Ramadan 1446H</span>/1 Maret 2025</p>
        
        <!-- Form -->
        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf

            <!-- Tanggal -->
            <div>
                <x-input-label for="tanggal" :value="__('Tanggal')" />
                <x-text-input id="tanggal" class="block mt-1 w-full datepicker" type="text" name="tanggal" :value="old('tanggal')" required autofocus autocomplete="tanggal" />
                <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
            </div>

            @if ($is_wanita)
                <!-- Apakah Sedang Haid -->
                <div class="mt-4">
                    <x-input-label for="is_haid" :value="__('Apakah Anda Sedang Haid')" />
                    <x-select-input id="is_haid" class="block mt-1 w-full" type="text" name="is_haid" :value="old('is_haid')" :options="$options" required />
                    <x-input-error :messages="$errors->get('is_haid')" class="mt-2" />
                </div>
            @endif

            <!-- Melaksanakan 3x kalo Sholat Berjamaah di Masjid/ Sholat Diawal Waktu -->
            <div class="mt-4">
                <x-input-label for="sholat_berjamaah" :value="__('Apakah Anda Melaksanakan 3x kalo Sholat Berjamaah di Masjid/ Sholat Diawal Waktu')" />
                <x-select-input id="sholat_berjamaah" class="block mt-1 w-full" type="text" name="sholat_berjamaah" :value="old('sholat_berjamaah')" :options="$options" required />
                <x-input-error :messages="$errors->get('sholat_berjamaah')" class="mt-2" />
            </div>

            <!-- Melaksanakan Mengaji 2 lembar -->
            <div class="mt-4">
                <x-input-label for="mengaji" :value="__('Apakah Anda Mengaji Minimal 2 lembar')" />
                <x-select-input id="mengaji" class="block mt-1 w-full" type="text" name="mengaji" :value="old('mengaji')" :options="$options" required />
                <x-input-error :messages="$errors->get('mengaji')" class="mt-2" />
            </div>

            <!-- Melaksanakan Infaq -->
            <div class="mt-4">
                <x-input-label for="infaq" :value="__('Apakah Anda Sudah Berinfaq')" />
                <x-select-input id="infaq" class="block mt-1 w-full" type="text" name="infaq" :value="old('infaq')" :options="$options" required />
                <x-input-error :messages="$errors->get('infaq')" class="mt-2" />
            </div>

            <!-- Melaksanakan Tarawih Berjamaah -->
            <div class="mt-4">
                <x-input-label for="tarawih_berjamaah" :value="__('Apakah Anda Melaksanakan Tarawih Berjamaah')" />
                <x-select-input id="tarawih_berjamaah" class="block mt-1 w-full" type="text" name="tarawih_berjamaah" :value="old('tarawih_berjamaah')" :options="$options" required />
                <x-input-error :messages="$errors->get('tarawih_berjamaah')" class="mt-2" />
            </div>

            <!-- Melaksanakan Sholat Dhuha -->
            <div class="mt-4">
                <x-input-label for="dhuha" :value="__('Apakah Anda Melaksanakan Sholat Dhuha')" />
                <x-select-input id="dhuha" class="block mt-1 w-full" type="text" name="dhuha" :value="old('dhuha')" :options="$options" required />
                <x-input-error :messages="$errors->get('dhuha')" class="mt-2" />
            </div>

            <!-- Mendengar Kajian Islam -->
            <div class="mt-4">
                <x-input-label for="kajian" :value="__('Apakah Anda Mendengarkan Kajian Islam')" />
                <x-select-input id="kajian" class="block mt-1 w-full" type="text" name="kajian" :value="old('kajian')" :options="$options" required />
                <x-input-error :messages="$errors->get('kajian')" class="mt-2" />
            </div>

            <!-- Melaksanakan Tahajjud -->
            <div class="mt-4">
                <x-input-label for="tahajjud" :value="__('Apakah Anda Melaksanakan Sholat Tahajjud')" />
                <x-select-input id="tahajjud" class="block mt-1 w-full" type="text" name="tahajjud" :value="old('tahajjud')" :options="$options" required />
                <x-input-error :messages="$errors->get('tahajjud')" class="mt-2" />
            </div>

            <!-- Haid: Mendengar Kajian Islam -->
            <div class="mt-4">
                <x-input-label for="haid_kajian" :value="__('Apakah Anda Mendengarkan Kajian Islam')" />
                <x-select-input id="haid_kajian" class="block mt-1 w-full" type="text" name="haid_kajian" :value="old('haid_kajian')" :options="$options" required />
                <x-input-error :messages="$errors->get('haid_kajian')" class="mt-2" />
            </div>

            <!-- Haid: Berdzikir -->
            <div class="mt-4">
                <x-input-label for="haid_zikir" :value="__('Apakah Anda Sudah Berdzikir')" />
                <x-select-input id="haid_zikir" class="block mt-1 w-full" type="text" name="haid_zikir" :value="old('haid_zikir')" :options="$options" required />
                <x-input-error :messages="$errors->get('haid_zikir')" class="mt-2" />
            </div>

            <!-- Haid: Memberi Makanan Orang yang Berpuasa -->
            <div class="mt-4">
                <x-input-label for="haid_memberi_makanan_iftar" :value="__('Apakah Anda Memberi Makanan Orang yang Berpuasa')" />
                <x-select-input id="haid_memberi_makanan_iftar" class="block mt-1 w-full" type="text" name="haid_memberi_makanan_iftar" :value="old('haid_zikir')" :options="$options" required />
                <x-input-error :messages="$errors->get('haid_memberi_makanan_iftar')" class="mt-2" />
            </div>

            <!-- Haid: Mendengarkan Al-Quran -->
            <div class="mt-4">
                <x-input-label for="haid_mendengar_alquran" :value="__('Apakah Anda Mendengarkan Al-Quran')" />
                <x-select-input id="haid_mendengar_alquran" class="block mt-1 w-full" type="text" name="haid_mendengar_alquran" :value="old('haid_mendengar_alquran')" :options="$options" required />
                <x-input-error :messages="$errors->get('haid_mendengar_alquran')" class="mt-2" />
            </div>

            <!-- Haid: Infaq -->
            <div class="mt-4">
                <x-input-label for="haid_infaq" :value="__('Apakah Anda Sudah Berinfaq')" />
                <x-select-input id="haid_infaq" class="block mt-1 w-full" type="text" name="haid_infaq" :value="old('haid_infaq')" :options="$options" required />
                <x-input-error :messages="$errors->get('haid_infaq')" class="mt-2" />
            </div>

            <!-- Haid: Membaca Surah Nabawiyah -->
            <div class="mt-4">
                <x-input-label for="haid_membaca_surah_nabawiyah" :value="__('Apakah Anda Sudah Membaca Surah Nabawiyah')" />
                <x-select-input id="haid_membaca_surah_nabawiyah" class="block mt-1 w-full" type="text" name="haid_membaca_surah_nabawiyah" :value="old('haid_membaca_surah_nabawiyah')" :options="$options" required />
                <x-input-error :messages="$errors->get('haid_membaca_surah_nabawiyah')" class="mt-2" />
            </div>

            <!-- Haid: Membaca Hadist -->
            <div class="mt-4">
                <x-input-label for="haid_membaca_hadist" :value="__('Apakah Anda Sudah Membaca Hadist')" />
                <x-select-input id="haid_membaca_hadist" class="block mt-1 w-full" type="text" name="haid_membaca_hadist" :value="old('haid_membaca_hadist')" :options="$options" required />
                <x-input-error :messages="$errors->get('haid_membaca_hadist')" class="mt-2" />
            </div>

            <div class="mt-4 flex items-center justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Simpan</button>
            </div>
        </form>
    </div>
@endsection
