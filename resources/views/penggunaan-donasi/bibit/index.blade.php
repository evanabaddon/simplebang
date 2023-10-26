@extends('template.layout')
@section('title' , 'Daftar Penggunaan Donasi')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('penggunaan-donasi.bibit.index') }}" class="breadcrumb--active"> Bibit Donasi</a> </div>
                    <!-- END: Breadcrumb -->
                    @include('template.search')
                    @include('template.notification')
                    @include('template.account')
                </div>
                <!-- END: Top Bar -->
                @if (session('success'))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> <i data-feather="terminal" class="w-6 h-6 mr-2"></i> {{ session('success') }} </div>
                @endif
                @if (session('error'))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{ session('error') }} </div>
                @endif
                <!-- BEGIN: General Report -->
                        <div class="col-span-12 mt-8">

                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="dollar-sign" class="report-box__icon text-theme-10"></i>

                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">@rupiah($total)</div>
                                            <div class="text-base text-gray-600 mt-1">Total Donasi Masuk</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="dollar-sign" class="report-box__icon text-theme-11"></i>

                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">@rupiah($kredit)</div>
                                            <div class="text-base text-gray-600 mt-1">Total Kredit </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="dollar-sign" class="report-box__icon text-theme-11"></i>

                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">@rupiah($kredit_bibit)</div>
                                            <div class="text-base text-gray-600 mt-1">Total Kredit Bibit</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="dollar-sign" class="report-box__icon text-theme-9"></i>

                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">@rupiah($saldo)</div>
                                            <div class="text-base text-gray-600 mt-1">Total Donasi Tersedia</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">

                    <h2 class="text-lg font-medium mr-auto">
                        Data Bibit Donasi
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="{{ route('penggunaan-donasi.kredit.create') }}"><button class="button text-white bg-theme-1 shadow-md mr-2">Tambah Baru</button></a>
                    </div>
                </div>

                <!-- BEGIN: Datatable -->
                <div class="overflow-x-auto">
                  <div class="overflow-x-auto intro-y datatable-wrapper  box p-5 mt-5 ">

                    <table class="table" id="table-csr-donasi">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">JUDUL</th>
                                <th class="border-b-2 whitespace-no-wrap">KREDIT</th>
                                <th class="border-b-2  whitespace-no-wrap">TANGGAL INPUT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $each)
                          <tr>
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{ $each->judul }}</div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->judul }}</div>
                            </td>
                            <td class="border-b">
                              <div class="flex">

                              <div class="font-medium whitespace-no-wrap"> @rupiah($each->total) </div>


                              </div>
                            </td>


                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{ $each->created_at }}</div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->created_at }}</div>
                            </td>
                            <td class="border-b w-5">
                                <div class="flex sm:justify-center items-center">

                                    <a class="flex items-center mr-3" href="{{ route('penggunaan-donasi.kredit.edit' , $each->id) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-theme-6" href="{{ route('penggunaan-donasi.kredit.delete' , $each->id) }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                          </tr>
                          @endforeach

                        </tbody>
                    </table>
                </div>
                </div>
                <!-- END: Datatable -->
            </div>
            <!-- END: Content -->
@endsection
@section('js')
  <script type="text/javascript">
      $(document).ready(function(){
        $("#table-csr-donasi").dataTable({

        });
      });
  </script>
@endsection
