@extends('template.layout')
@section('title' , 'Daftar Penanaman')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('penanaman.index') }}" class="breadcrumb--active"> Data Penanaman</a> </div>
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
                        Data Penanaman
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="{{ route('penanaman.create') }}"><button class="button text-white bg-theme-1 shadow-md mr-2">Buat Pencatatan Penanaman</button></a>
                    </div>
                </div>

                
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">
                                        
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $widget['total_bibit'] }}</div>
                                <div class="text-base text-gray-600 mt-1">Total Bibit Tertanam</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-11"></i>
                                    
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $widget['total_tambang_tanam'] }}</div>
                                <div class="text-base text-gray-600 mt-1">Total Tambang Ditanam</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                    
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $widget['total_luas'] }} m2</div>
                                <div class="text-base text-gray-600 mt-1">Total Luas Tambang</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-9"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer"> {{ number_format((float)$widget['total_luas_tanam'] / $widget['total_luas'] * 100 , 2, '.', '') }}% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $widget['total_luas_tanam'] }} m2</div>
                                <div class="text-base text-gray-600 mt-1">Total Luas Ditanam</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">JUDUL</th>
                                <th class="border-b-2 whitespace-no-wrap">TAMBANG</th>
                                <th class="border-b-2 whitespace-no-wrap">DAFTAR BIBIT</th>
                                 <th class="border-b-2 whitespace-no-wrap">LUAS TAMBANG</th>
                                <th class="border-b-2 whitespace-no-wrap">LUAS PENANAMAN</th>
                                <th class="border-b-2 whitespace-no-wrap">JUMLAH BIBIT TERTANAM</th>
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
                                <td class="border-b">{{ $each->tambang }}</td>
                                <td class="border-b">
                                  <div class="flex">
                                  @foreach($each->list_bibit as $bibit)
                                    @if($bibit->logo == NULL)
                                      <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                          <img alt="{{ $bibit->jenis }}" class="tooltip rounded-full" src="/dist/images/preview-4.jpg" title="{{ $bibit->jenis }}">
                                      </div>
                                    @else
                                      <div class="w-10 h-10 image-fit zoom-in -ml-1">
                                          <img alt="{{ $bibit->jenis }}" class="tooltip rounded-full" src="{{ $bibit->logo }}" title="{{ $bibit->jenis }}">
                                      </div>
                                    @endif
                                  @endforeach
                                  </div>
                                </td>
                                <td class="border-b">{{ $each->luas }} m2</td>
                                <td class="border-b">{{ $each->luas_penanaman }} m2</td>
                                <td class="border-b">{{ $each->jumlah_bibit}} </td>
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                        <a class="flex items-center mr-3" href="{{ route('penanaman.edit' , $each->id) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6" href="{{ route('penanaman.delete' , $each->id) }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END: Content -->
@endsection
@section('js')

@endsection
