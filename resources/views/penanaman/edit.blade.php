@extends('template.layout')
@section('title' , 'Tambah Penanaman Bibit Pohon')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('penanaman.index') }}" class="breadcrumb--active"> Data Penanaman</a> </div>
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
                        Edit Penanaman Bibit Pohon
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <div class="dropdown relative">
                            

                        </div>
                    </div>
                </div>
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Post Content -->
                    <div class="intro-y col-span-12 lg:col-span-6">
                        <input type="text" name="judul" id="judul" value="{{ $csr_out->judul }}" class="intro-y input input--lg w-full box pr-10 placeholder-theme-13" placeholder="Judul Penanaman">
                        <div class="post intro-y overflow-hidden box mt-5">
                            <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                                <a title="Fill in the article content" data-toggle="tab" data-target="#content" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Detail </a>

                            </div>
                            <div class="post__content tab-content">
                                <div class="tab-content__pane p-5 active" id="content">
                                	<div class="border border-gray-200 rounded-md p-5">
                                        <div class="mt-5">
                                          <div class="mt-3">
                                              <label>Pilih Tambang</label>
                                              <select class="input w-full border bg-gray-100  mt-2" id="tambang" name="tambang_id">
                                                @foreach($tambang as $each)
                                                  <option value="{{ $each->id }}" @if($csr_out->tambang_id == $each->id) selected @endif>{{ $each->nama }}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="mt-3 hidden" id="getinfotambang">
                                              <div class="grid grid-cols-12 gap-6 mt-5">
                                                <div class="col-span-12 sm:col-span-6 xl:col-span-5 intro-y">
                                                    <div class="report-box zoom-in">
                                                        <div class="box p-5">
                                                            <div class="flex">


                                                            </div>
                                                            <div class="text-3xl font-bold leading-8 mt-6" id="tertanam"></div>
                                                            <div class="text-base text-gray-600 mt-1">Area tertanam (m2)</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 xl:col-span-5 intro-y">
                                                    <div class="report-box zoom-in">
                                                        <div class="box p-5">
                                                            <div class="flex">


                                                            </div>
                                                            <div class="text-3xl font-bold leading-8 mt-6" id="belum_tertanam"></div>
                                                            <div class="text-base text-gray-600 mt-1">Area belun ditanam (m2)</div>
                                                        </div>
                                                    </div>
                                                </div>

                                              </div>
                                            </div>
                                          <div class="mt-3">
                                              <label>Luas Area</label>
                                              <input type="text" value="{{ $csr_out->luas }}" name="luas" class="input w-full border  mt-2" id="luas" placeholder="1000 m2">
                                          </div>
                                          
                                        </div>
                                    </div> <br>
                                    <div class="border border-gray-200 rounded-md p-5">
                                        <div class="mt-5">
                                          <div class="mt-3">
                                              <label>Jenis Bibit</label>
                                              <select class="input w-full border bg-gray-100  mt-2" id="bibit">
                                                <option value="0"> Pilih Bibit </option>
                                                @foreach($bibit as $each)
                                                  <option value="{{ $each->id }}">{{ $each->jenis }}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="mt-3" >
                                              <label>Pilih asal CSR</label>
                                              <select class="input w-full border bg-gray-100  mt-2" id="csr">
                                                <option value="0"> Pilih CSR </option>
                                              </select>
                                          </div>
                                          <div class="mt-3" >
                                              <label>Pilih asal gudang</label>
                                              <select class="input w-full border bg-gray-100  mt-2" id="gudang">
                                                <option value="0"> Pilih Gudang </option>
                                              </select>
                                          </div>

                                          <div class="mt-3">
                                              <div class="grid grid-cols-12 gap-6 mt-5">
                                                <div class="col-span-12 sm:col-span-6 xl:col-span-5 intro-y">
                                                    <div class="report-box zoom-in">
                                                        <div class="box p-5">
                                                            <div class="flex">


                                                            </div>
                                                            <div class="text-3xl font-bold leading-8 mt-6" id="bibit_tertanam"></div>
                                                            <div class="text-base text-gray-600 mt-1">Bibit tertanam</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 xl:col-span-5 intro-y">
                                                    <div class="report-box zoom-in">
                                                        <div class="box p-5">
                                                            <div class="flex">


                                                            </div>
                                                            <div class="text-3xl font-bold leading-8 mt-6" id="bibit_belum_tertanam"></div>
                                                            <div class="text-base text-gray-600 mt-1">Bibit belum ditanam</div>
                                                        </div>
                                                    </div>
                                                </div>

                                              </div>
                                          </div>

                                         <div class="mt-3">
                                             <label>Jumlah</label>
                                             <input type="text" class="input w-full border bg-white-100  mt-2" id="jumlah" placeholder="100">
                                         </div>                                          
                                          <div class="mt-3">
                                              <button class="button text-white bg-theme-1 shadow-md flex items-center" id="tambah"> Tambah </button>
                                          </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Post Content -->
                    <!-- BEGIN: Post Info -->
                    <div class="col-span-12 lg:col-span-6">
                        <div class="intro-y box p-5">
                           <div class="border border-gray-200 rounded-md p-5 mt-5">
                                        <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Daftar Bibit </div>
                                        <div class="mt-5">
                                          <div class="overflow-x-auto">
                                              <table class="table">
                                               <thead>
                                                 <tr class="bg-gray-700 text-white">
                                                   <th class="whitespace-no-wrap">Jenis Bibit</th>
                                                   <th class="whitespace-no-wrap">Jumlah</th>
                                                   <th class="whitespace-no-wrap">Asal CSR</th>
                                                   <th class="whitespace-no-wrap">Gudang Bibit</th>
                                                   <th class="whitespace-no-wrap text-center">#</th>
                                                 </tr>
                                               </thead>
                                               <tbody class="list-bibit">
                                                @foreach($csr_out_bibit as $each)
                                                <form method="POST" action="{{ route('penanaman.bibit.update') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $each->id }}">
                                                <tr id="list_{{ $each->bibit_id }}_{{ $each->csr_id }}_{{ $each->gudang_bibit_id }}">
                                                    <td class="border-b">{{ $each->jenis }}</td>
                                                     <td class="border-b"> <input type="text" class="input w-full border bg-white-100  mt-2" name="jumlah" value="{{ $each->jumlah }}"> </td>
                                                     <td class="border-b">{{ $each->judul }}</td>
                                                     <td class="border-b">{{ $each->nama }}</td>
                                                                  <td class="border-b">
                                                        <div class="flex sm:justify-center items-center">
                                                            <button class="button text-gray bg-theme-2 shadow-md flex items-center" type="submit"> Edit </button>&nbsp;&nbsp;
                                                          <a class="flex items-center text-theme-6" href="{{ route('penanaman.bibit.delete' , $each->id ) }}"><i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </form>
                                                @endforeach
                                                 <!--
                                                 <tr>
                                                   <td class="border-b">1</td>
                                                   <td class="border-b">Angelina</td>
                                                   <td class="border-b">Jolie</td>
                                                   <td class="border-b">
                                                     <div class="flex sm:justify-center items-center">
                                                       <a class="flex items-center text-theme-6" href=""> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                                     </div>
                                                   </td>
                                                 </tr>
                                               -->
                                               </tbody>
                                              </table>

                                              </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 lg:col-span-6">
                        <div class="intro-y box p-5">
                            <div class="mt-3">
                                <label>Tanggal Penanaman</label>
                                <input type="date" class="input w-full border bg-white-100  mt-2" value="{{ $csr_out->tanggal }}" name="tanggal" id="tanggal">
                            </div>
                            <div class="mt-3">
                                <label>Galeri Penanaman</label>
                                <div class="border-2 border-dashed rounded-md mt-3 pt-4">
                                        <div class="flex flex-wrap px-4" >
                                                      @foreach($dokumentasi as $each)
                                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                            <img class="rounded-md" alt="{{ $csr_out->judul }}" src="{{ $each->file }}">
                                                            <a href="{{ route('penanaman.dokumentasi.delete' , $each->id) }}"><div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div></a>
                                                        </div>
                                                      @endforeach
                                                      <div class="flex flex-wrap px-4" id="list">

                                                      </div>
                                                    </div>
                                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                        <i data-feather="image" class="w-4 h-4 mr-2"></i> <span class="text-theme-1 mr-1">Upload a file</span> or drag and drop
                                                        <input type="file" id="foto" name="foto[]" multiple class="w-full h-full top-0 left-0 absolute opacity-0">
                                                    </div>
                                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="dropdown-toggle button text-white bg-theme-1 shadow-md flex items-center" id="save"> Save </button>
                            </div>

                        </div>
                    </div>
                    <!-- END: Post Info -->
                </div>
            </div>
            <!-- END: Content -->
            <form class="hidden" id="form-penanaman" action="{{ route('penanaman.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="csr_out_id" value="{{ $csr_out->id }}">
            </form>
@endsection
@section('js')
<script type="text/javascript">

function getstock(csr_id , bibit_id , gudang_bibit_id){
    $.ajax({
        type: 'GET',
        url: '/csr/bibit/getstock/' + csr_id + '/' + bibit_id + '/' + gudang_bibit_id,
        success: function(response){
            $("#bibit_tertanam").html(response.jumlah_tertanam);
            $("#bibit_belum_tertanam").html(response.jumlah - response.jumlah_tertanam);
        }
    });
}   

function getgudang(csr_id , bibit_id){
    var option = '';
    $.ajax({
        type : 'GET',
        url: '/csr/bibit/getgudang/' + csr_id + '/' + bibit_id,
        success: function(response){
            $.each(response , function(k,v){
                option += '<option value="' + v.id + '">'+v.nama+'</option>';
                if(k == 0){
                    getstock(csr_id , bibit_id  , v.id);
                }
            });
            
            $("#gudang").html(option);
        }
    });
}

function infotambang(id){
    $.ajax({
            type: 'GET',
            url: '/tambang/getinfo/' + id,
            success: function(response){
                
                $("#tertanam").html(response.luas_tertanam);
                $("#belum_tertanam").html(response.luas - response.luas_tertanam);
                $("#getinfotambang").removeClass('hidden');
            }   
         });
}

function delete_list( bibit , csr , gudang_bibit ){
 $("#list_"+bibit+'_'+csr+'_'+gudang_bibit).remove();
  $("#form_"+bibit+'_'+csr+'_'+gudang_bibit).remove();
}

	function cek(bibit , csr , gudang_bibit ){
	  return $("#list_"+bibit+'_'+csr+'_'+gudang_bibit).length;
	}
    $(document).ready(function(){
        infotambang({{ $csr_out->tambang_id }})
        $('#tambah').click(function(){
            var bibit = $("#bibit");
            var csr     =    $("#csr");
            var gudang_bibit    =    $("#gudang");
            var jumlah  =    $("#jumlah");

            if(bibit.val() == 0 || csr.val() == 0 || gudang_bibit.val() == 0 || !jumlah.val()){
                return false;
            }
            
            var table = '';

            table += '<tr id="list_'+bibit.val()+'_'+csr.val()+'_'+gudang_bibit.val()+'">';
            table += '<td class="border-b">' + $("#bibit option:selected").text() + '</td>';
            table += ' <td class="border-b">' + jumlah.val() + '</td>';
            table += ' <td class="border-b">' +  $("#csr option:selected").text() + '</td>';
            table += ' <td class="border-b">' +  $("#gudang option:selected").text() + '</td>';
                          table += '<td class="border-b">';
              table += '  <div class="flex sm:justify-center items-center">';
              table += '    <a class="flex items-center text-theme-6" onclick=delete_list('+bibit.val()+','+csr.val()+','+gudang_bibit.val()+');> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus </a>';
              table += '  </div>';

            if(cek(bibit.val() , csr.val() , gudang_bibit.val()) )
                    return false;

            $(".list-bibit").append(table);
            var form  =    '<div id="form_'+bibit.val()+'_'+csr.val()+'_'+gudang_bibit.val()+'"><input type="hidden"  name="bibit_id[]" value="' + bibit.val() + '"><input type="hidden" name="csr_id[]" value="'+csr.val()+'"> <input type="hidden" name="gudang_bibit[]" value="' + gudang_bibit.val() +'"><input type="hidden" name="jumlah[]" value="'+jumlah.val() + '"></div>';

            $("#form-penanaman").append(form);
        });

        $("#save").click(function(){
         
         var  judul       =  $("#judul").clone();
         var  tambang_id = $("#tambang").clone();
         tambang_id.attr("id" , "form-tambang");
         tambang_id.val($("#tambang").find(":selected").val());
         var  tanggal   =    $("#tanggal").clone();
         var foto   =    $("#foto").clone();
         var luas   =    $("#luas").clone();

         $("#form-penanaman").append(judul);
         $("#form-penanaman").append(tambang_id);
         $("#form-penanaman").append(tanggal);
         $("#form-penanaman").append(foto);
         $("#form-penanaman").append(luas);

         $("#form-penanaman").submit();

        });

        $("#bibit").change(function(){
            var bibit_id    =    $(this).val();
            var option = '';

            $.ajax({
                type: 'GET',
                url : '/csr/bibit/getinfo/' + bibit_id,
                success: function(response){
                    $.each(response , function(k,v){
                        option += '<option value='+v.id+'>'+ v.judul + '</option>';
                        if(k == 0){
                            getgudang(v.id  , bibit_id);
                        }
                    });

                    $("#csr").html(option);
                    
                }
            });
        });

        $("#tambang").change(function(){
            var id = $(this).val();
            if(id == 0) {$("#getinfotambang").addClass('hidden');return false};
            infotambang(id);
         
        });

        $("#csr").change(function(){
            var id = $(this).val();
            var bibit_id = $("#bibit").val();

            getgudang(id , bibit_id);
        });

        $("#gudang").change(function(){
            var csr_id = $("#csr").val();
            var bibit_id  = $("#bibit").val();
            var gudang_bibit_id = $(this).val();

            getstock(csr_id , bibit_id , gudang_bibit_id);
        });

    });


</script>
<script>
	$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input) {
      $('#list').html('');
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {

                  var html  = '<div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">';
                    html += '<img class="rounded-md" src="' + event.target.result +'">';
                    html += '</div>';
                    $("#list").append(html);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#foto').on('change', function() {
        imagesPreview(this);
    });
   });
	</script>
@endsection
