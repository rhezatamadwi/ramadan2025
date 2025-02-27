<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
    @if (Route::has('login'))
        <nav class="flex items-center justify-between">
            <div class="flex items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center text-[16px] font-bold dark:text-[#EDEDEC]">
                    <x-application-logo class="w-12 h-12 fill-current text-gray-800 dark:text-gray-200 object-contain" />
                    LPDP Ramadan
                </a>
            </div>
            <div class="flex gap-4 items-center justify-end">
                <!-- theme switcher -->
                <x-theme-switch class="ml-4" />
                
                @auth
                    <!-- Modal Trigger Button -->
                    <button id="openModalBtn" class="px-2 py-2 text-[#1b1b18] dark:text-[#EDEDEC] border border-[#19140035] dark:border-[#3E3E3A] hover:border-[#007dd9] dark:hover:border-[#007dd9] rounded">
                        Laporan Harian
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="flex inline-block px-2 py-1.5 dark:text-[#FF4433] border-scarlet-500 hover:border-[#FF4433] text-[#FF4433] dark:border-[#3E3E3A] dark:hover:border-[#FF4433] rounded-sm text-sm leading-normal">
                            <x-lucide-log-out class="w-5 h-5 mr-1" /> {{ __('Log Out') }}
                        </button>
                    </form>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Daftar Akun
                        </a>
                    @endif
                @endauth
            </div>
        </nav>
    @endif
</header>