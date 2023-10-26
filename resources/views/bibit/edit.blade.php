@extends('template.layout')
@section('title' , 'Tambah Bibit')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('bibit.index') }}" class="breadcrumb--active"> Jenis Bibit</a> </div>
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
                                    Update Jenis Bibit
                                </h2>
                            </div>
                            <form class="" action="{{ route('bibit.update') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="id" value="{{ $bibit->id }}">
                              <div class="p-5">
                                  <div class="grid grid-cols-12 gap-5">
                                      <div class="col-span-12 xl:col-span-4">
                                          <div class="border border-gray-200 rounded-md p-5">
                                              <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                  <img class="rounded-md" width="200" id="preview" alt="Midone Tailwind HTML Admin Template" src="@if($bibit->logo == NULL) /dist/images/profile-11.jpg @else {{ $bibit->logo }} @endif">
                                                  <a href="{{ route('bibit.delete.logo' , $bibit->id) }}"><div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                                  </a>
                                              </div>
                                              <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                                  <button type="button" class="button w-full bg-theme-1 text-white">Upload Foto</button>
                                                  <input type="file" name="logo" id="imgInp" onchange="previewFile(this);" class="w-full h-full top-0 left-0 absolute opacity-0">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-span-12 xl:col-span-8">
                                          <div>
                                              <label>Jenis</label>
                                              <input type="text" name="jenis" class="input w-full border bg-gray-100 mt-2"  placehodler="Misal: Alpukat,Nagka" value="{{ $bibit->jenis }}">
                                          </div>
                                          <div>
                                            <label>Harga</label>
                                            <input type="number" name="harga" class="input w-full border bg-gray-100  mt-2"  placeholder="Misal: 10000">
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
