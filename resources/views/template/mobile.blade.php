
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="/dist/images/logo.svg">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
            <li>
                <a href="/dashboard" class="menu @if(str_contains(Route::currentRouteName(),'dashboard')) menu--active @endif">
                    <div class="menu__icon"> <i data-feather="home"></i> </div>
                    <div class="menu__title"> Dashboard </div>
                </a>
            </li>

            <li>
                <a href="javascript:;" class="menu @if(str_contains(Route::currentRouteName(),'tambang')) menu--active @endif">
                    <div class="menu__icon"> <i data-feather="box"></i> </div>
                    <div class="menu__title">Ex Tambang <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('tambang.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Data Tambang </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jenis-tambang.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Jenis Tambang </div>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;" class="menu @if(str_contains(Route::currentRouteName(),'usaha')) menu--active @endif" >
                    <div class="menu__icon"> <i data-feather="box"></i> </div>
                    <div class="menu__title"> Perusahaan <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('perusahaan.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Data Perusahaan </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jenis-usaha.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Jenis Perusahaan </div>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;" class="menu @if(str_contains(Route::currentRouteName(),'bibit') && !str_contains(Route::currentRouteName(),'bank')  && !str_contains(Route::currentRouteName(),'csr') &&  !str_contains(Route::currentRouteName(),'penggunaan-donasi'))) menu--active @endif">
                    <div class="menu__icon"> <i data-feather="box"></i> </div>
                    <div class="menu__title"> Bibit Pohon <i data-feather="chevron-down" class="menu__sub-icon "></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('bibit.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Jenis Bibit Pohon </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gudang-bibit.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Kebun Bibit </div>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="side-nav__devider my-6"></li>
            <li>
                <a href="javascript:;" class="menu  @if(str_contains(Route::currentRouteName(),'csr')) menu--active @endif">
                    <div class="menu__icon"> <i data-feather="inbox"></i> </div>
                    <div class="menu__title"> CSR <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('csr.bibit.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Bibit Pohon</div>
                        </a>
                    </li>
                    <!--
                    <li>
                        <a href="{{ route('csr.donasi.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Donasi </div>
                        </a>
                    </li>
                  -->
                </ul>
            </li>
            <li>
                <a href="{{ route('penanaman.index') }}" class="menu @if(str_contains(Route::currentRouteName(),'penanaman')) menu--active @endif">
                    <div class="menu__icon"> <i data-feather="sidebar"></i> </div>
                    <div class="menu__title"> Penanaman </div>
                </a>

            </li>
            <!--
            <li>
                <a href="javascript:;" class="menu @if(str_contains(Route::currentRouteName(),'penggunaan-donasi')) menu--active @endif" >
                    <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                    <div class="menu__title"> Donasi <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('penggunaan-donasi.bibit.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Bibit </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaan-donasi.kredit.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Kredit </div>
                        </a>
                    </li>
                </ul>
            </li>-->

            <li>
                <a href="{{ route('bank-bibit.index') }}" class="menu @if(str_contains(Route::currentRouteName(),'bank')) menu--active @endif">
                    <div class="menu__icon"> <i data-feather="sidebar"></i> </div>
                    <div class="menu__title"> Bank Bibit Pohon </div>
                </a>

            </li>
            <li>
                <a href="{{ route('laporan.index') }}" class="menu @if(str_contains(Route::currentRouteName(),'laporan')) menu--active @endif">
                    <div class="menu__icon"> <i data-feather="sidebar"></i> </div>
                    <div class="menu__title"> Laporan Simplebang </div>
                </a>

            </li>
            <li>
                <a href="javascript:;" class="menu @if(str_contains(Route::currentRouteName(),'users')) menu--active @endif">
                    <div class="menu__icon"> <i data-feather="hard-drive"></i> </div>
                    <div class="menu__title"> Pengaturan <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('users.index') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Daftar Pengguna </div>
                        </a>
                    </li>
                    <li>
                        <a href="menu-slider.html" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Konten Profil </div>
                        </a>
                    </li>
                    <li>
                        <a href="menu-image-zoom.html" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Pengaturan </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
</div>
