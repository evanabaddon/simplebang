@extends('template.layout')
@section('title' , 'Daftar CSR Donasi')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('csr.donasi.index') }}" class="breadcrumb--active"> Data CSR Donasi</a> </div>
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
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">

                    <h2 class="text-lg font-medium mr-auto">
                        Data CSR Donasi
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="{{ route('csr.donasi.create') }}"><button class="button text-white bg-theme-1 shadow-md mr-2">Tambah Baru</button></a>
                    </div>
                </div>

                <!-- BEGIN: Datatable -->
                <div class="overflow-x-auto">
                  <div class="overflow-x-auto intro-y datatable-wrapper  box p-5 mt-5 ">

                    <table class="table" id="table-csr-donasi">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">NAMA PERUSAHAAN</th>
                                <th class="border-b-2  whitespace-no-wrap">JENIS CSR</th>
                                <th class="border-b-2 whitespace-no-wrap">TOTAL DONASI</th>
                                <th class="border-b-2 whitespace-no-wrap">JUDUL CSR</th>
                                <th class="border-b-2  whitespace-no-wrap">TANGGAL CSR</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $each)
                          <tr>
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{ $each->nama_perusahaan }}</div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->nama_perusahaan }}</div>
                            </td>
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{ $each->jenis_csr }}</div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->jenis_csr }}</div>
                            </td>
                            <td class="border-b">
                              <div class="flex">

                              <div class="font-medium whitespace-no-wrap"> @rupiah($each->donasi->jumlah) </div>


                              </div>
                            </td>
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{ $each->judul }}</div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->judul }}</div>
                            </td>
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{ $each->tanggal }}</div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->tanggal }}</div>
                            </td>
                            <td class="border-b w-5">
                                <div class="flex sm:justify-center items-center">

                                    <a class="flex items-center mr-3" href="{{ route('csr.donasi.edit' , $each->id) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-theme-6" href="{{ route('csr.donasi.delete' , $each->id) }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
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
