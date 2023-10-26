@extends('template.layout')
@section('title' , 'Edit Jenis Usaha')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('jenis-usaha.index') }}" class="breadcrumb--active"> Jenis Usaha</a> </div>
                    <!-- END: Breadcrumb -->
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
                <div class="intro-y flex items-center mt-8">

                </div>
                <div class="grid grid-cols-12">

                    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Edit Jenis Usaha
                                </h2>
                            </div>
                            <form class="" action="{{ route('jenis-usaha.update') }}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $jenis_usaha->id }}">
                              <div class="p-5">
                                  <div class="grid grid-cols-12 gap-5">

                                      <div class="col-span-12 xl:col-span-9">
                                          <div class="mt-3">
                                              <label>Jenis</label>
                                              <input type="text" name="jenis" class="input w-full border  mt-2" value="{{ $jenis_usaha->jenis }}" placeholder="Jenis Usaha">
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
            </div>
            <!-- END: Content -->
@endsection
@section('js')

@endsection
