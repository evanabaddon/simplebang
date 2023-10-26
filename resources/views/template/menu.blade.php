<div class="flex">
    <!-- BEGIN: Side Menu -->
    <nav class="side-nav">
        <a href="" class="intro-x flex items-center pl-5 pt-4">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="/dist/images/logo.svg">
            <span class="hidden xl:block text-white text-lg ml-3"> Simpell<span class="font-medium">Bang</span> </span>
        </a>
        <div class="side-nav__devider my-6"></div>
        <ul>
            <li>
                <a href="/dashboard" class="side-menu @if(str_contains(Route::currentRouteName(),'dashboard')) side-menu--active @endif">
                    <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                    <div class="side-menu__title"> Dashboard </div>
                </a>
            </li>

            <li>
                <a href="javascript:;" class="side-menu @if(str_contains(Route::currentRouteName(),'tambang')) side-menu--active @endif">
                    <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                    <div class="side-menu__title">Ex Tambang <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('tambang.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Data Tambang </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jenis-tambang.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Jenis Tambang </div>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;" class="side-menu @if(str_contains(Route::currentRouteName(),'usaha')) side-menu--active @endif" >
                    <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                    <div class="side-menu__title"> Perusahaan <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('perusahaan.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Data Perusahaan </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jenis-usaha.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Jenis Perusahaan </div>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;" class="side-menu @if(str_contains(Route::currentRouteName(),'bibit') && !str_contains(Route::currentRouteName(),'bank')  && !str_contains(Route::currentRouteName(),'csr') &&  !str_contains(Route::currentRouteName(),'penggunaan-donasi'))) side-menu--active @endif">
                    <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                    <div class="side-menu__title"> Bibit Pohon <i data-feather="chevron-down" class="side-menu__sub-icon "></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('bibit.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Jenis Bibit Pohon </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gudang-bibit.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Kebun Bibit </div>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="side-nav__devider my-6"></li>
            <li>
                <a href="javascript:;" class="side-menu  @if(str_contains(Route::currentRouteName(),'csr')) side-menu--active @endif">
                    <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                    <div class="side-menu__title"> CSR <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('csr.bibit.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Bibit Pohon</div>
                        </a>
                    </li>
                    <!--
                    <li>
                        <a href="{{ route('csr.donasi.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Donasi </div>
                        </a>
                    </li>
                  -->
                </ul>
            </li>
            <li>
                <a href="{{ route('penanaman.index') }}" class="side-menu @if(str_contains(Route::currentRouteName(),'penanaman')) side-menu--active @endif">
                    <div class="side-menu__icon"> <i data-feather="sidebar"></i> </div>
                    <div class="side-menu__title"> Penanaman </div>
                </a>

            </li>
            <!--
            <li>
                <a href="javascript:;" class="side-menu @if(str_contains(Route::currentRouteName(),'penggunaan-donasi')) side-menu--active @endif" >
                    <div class="side-menu__icon"> <i data-feather="dollar-sign"></i> </div>
                    <div class="side-menu__title"> Donasi <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('penggunaan-donasi.bibit.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Bibit </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaan-donasi.kredit.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Kredit </div>
                        </a>
                    </li>
                </ul>
            </li>-->

            <li>
                <a href="{{ route('bank-bibit.index') }}" class="side-menu @if(str_contains(Route::currentRouteName(),'bank')) side-menu--active @endif">
                    <div class="side-menu__icon"> <i data-feather="sidebar"></i> </div>
                    <div class="side-menu__title"> Mitra Bibit </div>
                </a>

            </li>
            <li>
                <a href="{{ route('laporan.index') }}" class="side-menu @if(str_contains(Route::currentRouteName(),'laporan')) side-menu--active @endif">
                    <div class="side-menu__icon"> <i data-feather="sidebar"></i> </div>
                    <div class="side-menu__title"> Laporan Simplebang </div>
                </a>

            </li>
            <li>
                <a href="javascript:;" class="side-menu @if(str_contains(Route::currentRouteName(),'users')) side-menu--active @endif">
                    <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                    <div class="side-menu__title"> Pengaturan <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('users.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Daftar Pengguna </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-slider.html" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Konten Profil </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-image-zoom.html" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Pengaturan </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
