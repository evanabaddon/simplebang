@extends('template.layout')
@section('title' , 'Tambah CSR Donasi')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('csr.donasi.index') }}" class="breadcrumb--active"> CSR Donasi</a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    @include('template.search')
                    @include('template.notification')
                    @include('template.account')
                </div>
                <!-- END: Top Bar -->
                @if ($errors->any())
                <div class="rounded-md px-5 py-4 mb-2 bg-theme-6 text-white">
                   <div class="flex items-center">
                       <div class="font-medium text-lg">Terjadi Kesalahan</div>
                   </div>
                   <ul>
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
               @endif
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Tambah CSR Donasi
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <div class="dropdown relative">


                        </div>
                    </div>
                </div>
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Post Content -->

                    <div class="intro-y col-span-12 lg:col-span-8">
                      <form method="POST" action="{{ route('csr.donasi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="judul" id="judul" class="intro-y input input--lg w-full box pr-10 placeholder-theme-13" placeholder="Judul CSR">
                        <div class="post intro-y overflow-hidden box mt-5">
                            <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                                <a title="Fill in the article content" data-toggle="tab" data-target="#content" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Donasi </a>

                            </div>
                            <div class="post__content tab-content">
                                <div class="tab-content__pane p-5 active" id="content">

                                    <div class="border border-gray-200 rounded-md p-5">
                                        <div class="mt-5">

                                          <div class="mt-3">
                                              <label>Jumlah Donasi</label>
                                              <input type="text" name="jumlah" id="jumlah" class="input w-full border  mt-2"  placeholder="Contoh: 1000000">
                                          </div>
                                          <div class="mt-3">
                                              <label>Perusahaan </label>
                                              <select class="input w-full border mt-2" id="perusahaan" name="perusahaan_id">
                                                  @foreach($perusahaan as $each)
                                                    <option value="{{ $each->id }}">{{ $each->nama }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="mt-3">
                                              <label>Tanggal CSR</label>
                                              <input type="date" name="tanggal" id="tanggal" class="input w-full border mt-2">
                                          </div>
                                          <div class="mt-3">
                                              <label>Tanda Terima</label>
                                              <div class="mt-2">
                                                  <input type="file" name="tanda_terima" id="tanda_terima" class="input w-full border mt-2" value="">
                                              </div>
                                          </div>
                                          <div class="mt-3">
                                              <label>Catatan</label>
                                              <div class="mt-2">
                                                  <textarea name="catatan" rows="8" cols="80" id="catatan" class="input w-full border mt-2"></textarea>
                                              </div>
                                          </div>
                                          <div class="mt-3">
                                              <button class="button text-white bg-theme-1 shadow-md flex items-center" type="submit"> Simpan </button>
                                          </div>
                                        </div>
                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Post Content -->

                </div>
            </div>
            <!-- END: Content -->

@endsection
@section('js')
@endsection
