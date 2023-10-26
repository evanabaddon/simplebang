@extends('template.layout')
@section('title' , 'Daftar Penanaman')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('laporan.index') }}" class="breadcrumb--active"> Laporan Simpelbang</a> </div>
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
                <div class="intro-y flex items-center mt-8">

                </div>
                <div class="grid grid-cols-12">

                    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Laporan SimpleBang
                                </h2>
                            </div>
                            <form class="" action="{{ route('laporan.data') }}" method="post">
                              @csrf
                              <div class="p-5">
                                  <div class="grid grid-cols-12 gap-5">

                                      <div class="col-span-12 xl:col-span-9">
                                          <div class="mt-3">
                                              <label>Pilih Modul</label>
                                              <select name="modul" class="input w-full border  mt-2">
                                                    <option value="1" @if(isset($request->modul)) @if($request->modul == "1") selected @endif  @endif>Ex Tambang</option>
                                                    <option value="2" @if(isset($request->modul)) @if($request->modul == "2") selected @endif  @endif>Perusahaan</option>
                                                    <option value="3" @if(isset($request->modul)) @if($request->modul == "3") selected @endif  @endif>Bibit Pohon</option>
                                                    <option value="4" @if(isset($request->modul)) @if($request->modul == "4") selected @endif  @endif>Kebun Bibit</option>
                                                    <option value="5" @if(isset($request->modul)) @if($request->modul == "5") selected @endif  @endif>CSR</option>
                                                    <option value="6" @if(isset($request->modul)) @if($request->modul == "6") selected @endif  @endif>Penanaman</option>
                                                    <option value="7" @if(isset($request->modul)) @if($request->modul == "7") selected @endif  @endif>Mitra Bibit</option>
                                              </select>
                                          </div>
                                          <div class="mt-3">
                                              <label>Kata Kunci</label>
                                              <input class="input w-full border  mt-2" tyoe="text" name="keyword" @if($request->keyword) value="{{ $request->keyword }}" @endif placeholder="Kata kunci"></input>
                                          </div>
                                          <div class="mt-3">
                                              <label>Rentan Tanggal</label>
                                               <input name="tanggal" data-daterange="true" @if($request->tanggal) value="{{ $request->tanggal }}"  @endif class="datepicker input w-full border  mt-2"> 
                                          </div>
                                          <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Save</button>
                                      </div>
                                  </div>
                              </div>
                            </form>

                        </div>
                        <!-- END: Display Information -->
                    </div>
                </div>
                @if(isset($modul))
                    @if($modul == "1")
                        @include('laporan.tambang')
                    @endif
                    @if($modul == "2")
                        @include('laporan.perusahaan')
                    @endif
                    @if($modul == "3")
                        @include('laporan.bibit')
                    @endif
                    @if($modul == "4")
                        @include('laporan.gudang-bibit')
                    @endif
                     @if($modul == "5")
                        @include('laporan.csr-bibit')
                    @endif
                    @if($modul == "6")
                        @include('laporan.penanaman')
                    @endif
                    @if($modul == "7")
                        @include('laporan.bank-bibit')
                    @endif
                @endif
            </div>
@endsection
@section('js')
  <script type="text/javascript">
      function printDiv() 
        {

          var divToPrint=document.getElementById('data');

          var newWin=window.open('','Print-Window');

          newWin.document.open();

          newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

          newWin.document.close();

          setTimeout(function(){newWin.close();},10);

        }
  </script>
@endsection
