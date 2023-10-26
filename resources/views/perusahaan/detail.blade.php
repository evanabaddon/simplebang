@extends('template.layout')
@section('title' , 'Detail Perusahaan')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                  <!-- BEGIN: Breadcrumb -->
                  <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('perusahaan.index') }}" class="breadcrumb--active"> Perusahaan</a> </div>
                  <!-- END: Breadcrumb -->
                  @include('template.search')
                  @include('template.notification')
                  @include('template.account')
                </div>
                <!-- END: Top Bar -->
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Detail Perusahaan
                    </h2>
                </div>
                <!-- BEGIN: Profile Info -->
                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-gray-200 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32  relative">
                                <img alt="Midone Tailwind HTML Admin Template" class="full" src="@if($perusahaan->logo != NULL) {{ $perusahaan->logo }} @else /dist/images/profile-10.jpg @endif">
                            </div>
                            <div class="ml-5">
                                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $perusahaan->nama }}</div>
                                <div class="text-600">{{ $jenis_usaha->jenis }}</div>
                                <div class="text-gray-600">{{ $perusahaan->alamat }}</div>
                            </div>
                        </div>
                        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="truncate sm:whitespace-normal flex items-center"> <i data-feather="mail" class="w-4 h-4 mr-2"></i> {{ $perusahaan->email }} </div>
                            <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="phone" class="w-4 h-4 mr-2"></i> {{ $perusahaan->no_telepon }} </div>

                        </div>
                        <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 pt-5 lg:pt-0">
                            <div class="text-center rounded-md w-20 py-3">
                                <div class="font-semibold text-theme-1 text-lg">2</div>
                                <div class="text-gray-600">CSR</div>
                            </div>
                            <div class="text-center rounded-md w-20 py-3">
                                <div class="font-semibold text-theme-1 text-lg">492</div>
                                <div class="text-gray-600">Bibit</div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END: Profile Info -->
                <div class="grid grid-cols-12">

                    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Informasi Pemilik Usaha
                                </h2>
                            </div>

                              <div class="p-5">
                                  <div class="grid grid-cols-12 gap-5">

                                      <div class="col-span-12 xl:col-span-9">
                                          <div class="mt-3">
                                              <label>Nama</label>
                                              <input type="text" name="jenis" class="input w-full border  mt-2" value="{{ $pemilik->nama }}"  placeholder="Jenis Usaha">
                                          </div>
                                          <div class="mt-3">
                                              <label>Alamat</label>
                                              <textarea class="input w-full border  mt-2" >{{ $pemilik->alamat }}</textarea>
                                          </div>
                                          <div class="mt-3">
                                              <label>Email</label>
                                              <input type="text" name="jenis" class="input w-full border  mt-2" value="{{ $pemilik->email }}" placeholder="Jenis Usaha">
                                          </div>
                                          <div class="mt-3">
                                              <label>Telepon</label>
                                              <input type="text" name="jenis" class="input w-full border  mt-2" value="{{ $pemilik->no_telepon }}"  placeholder="Jenis Usaha">
                                          </div>
                                          <a href="{{ route('perusahaan.edit' , $perusahaan->id) }}"><button type="button" class="button w-20 bg-theme-1 text-white mt-3">Edit</button></a>
                                           <a href="{{ route('perusahaan.index') }}"><button type="button" class="button w-20 bg-theme-1 text-white mt-3">Kembali</button></a>
                                      </div>
                                  </div>
                              </div>


                        </div>
                        <!-- END: Display Information -->
                    </div>
                </div>

            </div>
            <!-- END: Content -->
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
      $('.input').attr('readonly' , 'readonly');
    });
</script>
@endsection
