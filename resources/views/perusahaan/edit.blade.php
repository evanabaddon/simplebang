@extends('template.layout')
@section('title' , 'Edit Perusahaan')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('perusahaan.index') }}" class="breadcrumb--active"> Data Perusahaan</a> </div>
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
                <div class="grid grid-cols-12 gap-6">

                    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Edit Perusahaan
                                </h2>
                            </div>
                            <form class="" action="{{ route('perusahaan.update') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="id" value="{{ $perusahaan->id }}">
                              <div class="p-5">
                                  <div class="grid grid-cols-12 gap-5">
                                      <div class="col-span-12 xl:col-span-4">
                                          <div class="border border-gray-200 rounded-md p-5">
                                              <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                  <img class="rounded-md" width="200" id="preview" alt="Midone Tailwind HTML Admin Template" src="@if($perusahaan->logo != NULL) {{ $perusahaan->logo }} @else /dist/images/profile-11.jpg @endif">
                                                  @if($perusahaan->logo != NULL)
                                                  <a href="{{ route('perusahaan.delete.logo'  , $perusahaan->id) }}"><div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div></a>
                                                  @endif
                                              </div>
                                              <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                                  <button type="button" class="button w-full bg-theme-1 text-white">Upload Logo</button>
                                                  <input type="file" name="logo" id="imgInp" onchange="previewFile(this);" class="w-full h-full top-0 left-0 absolute opacity-0">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-span-12 xl:col-span-8">
                                          <div class="mt-3">
                                              <label>Nama</label>
                                              <input type="text" name="nama" class="input w-full border bg-gray-100  mt-2" value="{{ $perusahaan->nama }}"  placeholder="Nama Perusahaan">
                                          </div>
                                          <div class="mt-3">
                                              <label for="">Jenis</label>
                                              <select class="input w-full border bg-gray-100  mt-2" name="jenis_usaha_id">
                                                  @foreach($jenis_usaha as $each)
                                                    <option value="{{ $each->id }}" @if($each->id == $perusahaan->jenis_usaha_id) selected @endif>{{ $each->jenis }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="mt-3">
                                              <label>Alamat</label>
                                              <textarea name="alamat" rows="4" class="input w-full border bg-gray-100  mt-2" placeholder="Alamat Perusahaan">{{ $perusahaan->alamat }}</textarea>
                                          </div>
                                          <div class="mt-3">
                                              <label>Email</label>
                                              <input type="email" name="email" class="input w-full border bg-gray-100  mt-2"  placeholder="Email Perusahaan" value="{{ $perusahaan->email }}">
                                          </div>
                                          <div class="mt-3">
                                              <label>Telepon</label>
                                              <input type="text" name="no_telepon" class="input w-full border bg-gray-100  mt-2"  placeholder="Telepon Perusahaan" value="{{ $perusahaan->no_telepon }}">
                                          </div>

                                      </div>
                                  </div>
                              </div>


                        </div>
                        <!-- END: Display Information -->
                    </div>

                    <!-- BEGIN: Profile Menu -->
                    <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                        <div class="intro-y box mt-5">
                          <div class="flex items-center p-5 border-b border-gray-200">
                              <h2 class="font-medium text-base mr-auto">
                                  Informasi Pemilik Perusahaan
                              </h2>
                          </div>
                            <div class="p-5">
                                <div class="grid grid-cols-12 ">

                                    <div class="col-span-12 xl:col-span-12">
                                        <div class="mt-3">
                                            <label>Nama</label>
                                            <input type="text" name="nama_pemilik" class="input w-full border bg-gray-100  mt-2" value="{{ $pemilik_usaha->nama }}"  placeholder="Nama Pemilik Perusahaan">
                                        </div>
                                        <div class="mt-3">
                                            <label>Alamat</label>
                                            <textarea name="alamat_pemilik" rows="4" class="input w-full border bg-gray-100  mt-2" placeholder="Alamat Pemilik Perusahaan">{{ $pemilik_usaha->alamat }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label>Email</label>
                                            <input type="email" name="email_pemilik" class="input w-full border bg-gray-100  mt-2"  value="{{ $pemilik_usaha->email }}" placeholder="Email Pemilik Perusahaan">
                                        </div>
                                        <div class="mt-3">
                                            <label>Telepon</label>
                                            <input type="text" name="telepon_pemilik" class="input w-full border bg-gray-100  mt-2" value="{{ $pemilik_usaha->no_telepon }}" placeholder="Telepon Pemilik Perusahaan">
                                        </div>
                                        <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Save</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- END: Profile Menu -->
                </div>
            </div>
            <!-- END: Content -->
@endsection
@section('js')
<script type="text/javascript">
function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#preview").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
</script>
@endsection
