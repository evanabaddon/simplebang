@extends('template.layout')
@section('title' , 'Tambah CSR Bibit')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('csr.bibit.index') }}" class="breadcrumb--active"> CSR Bibit</a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    @include('template.search')
                    @include('template.notification')
                    @include('template.account')
                </div>
                <!-- END: Top Bar -->
                @if (session('success'))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> <i data-feather="terminal" class="w-6 h-6 mr-2"></i> {{ session('success') }} </div>
                @endif
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
                        Edit CSR Bibit
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <div class="dropdown relative">
                            <button class="dropdown-toggle button text-white bg-theme-1 shadow-md flex items-center" id="save"> Save </button>

                        </div>
                    </div>
                </div>
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Post Content -->
                    <div class="intro-y col-span-12 lg:col-span-8">
                        <input type="text" name="judul" id="judul" value="{{ $csr->judul }}" class="intro-y input input--lg w-full box pr-10 placeholder-theme-13" placeholder="Judul CSR">
                        <div class="post intro-y overflow-hidden box mt-5">
                            <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                                <a title="Fill in the article content" data-toggle="tab" data-target="#content" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Daftar Bibit </a>

                            </div>
                            <div class="post__content tab-content">
                                <div class="tab-content__pane p-5 active" id="content">
                                    <div class="border border-gray-200 rounded-md p-5">
                                        <div class="mt-5">
                                          <div class="mt-3">
                                              <label>Jenis Bibit</label>
                                              <select class="input w-full border bg-gray-100  mt-2" id="bibit">
                                                @foreach($bibit as $each)
                                                  <option value="{{ $each->id }}">{{ $each->jenis }}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="mt-3">
                                              <label>Jumlah Bibit</label>
                                              <input type="text" id="jumlah" class="input w-full border  mt-2"  placeholder="10">
                                          </div>
                                          <div class="mt-3">
                                              <label>Lokasi Penyimpanan Bibit</label>
                                              <select class="input w-full border  mt-2" id="gudang_bibit">
                                                @foreach($gudang_bibit as $each)
                                                  <option value="{{ $each->id }}">{{ $each->nama }}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="mt-3">
                                              <button class="button text-white bg-theme-1 shadow-md flex items-center" id="tambah"> Tambah </button>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="border border-gray-200 rounded-md p-5 mt-5">
                                        <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Daftar Bibit </div>
                                        <div class="mt-5">
                                          <div class="overflow-x-auto">
                                              <table class="table">
                                               <thead>
                                                 <tr class="bg-gray-700 text-white">
                                                   <th class="whitespace-no-wrap">Jenis Bibit</th>
                                                   <th class="whitespace-no-wrap">Jumlah</th>
                                                   <th class="whitespace-no-wrap">Gudang Bibit</th>
                                                   <th class="whitespace-no-wrap text-center">#</th>
                                                 </tr>
                                               </thead>
                                               <tbody class="list-bibit">

                                                 @foreach($csr_bibit as $each)
                                                 <form  action="{{ route('csr.bibit.daftar.update') }}" method="post">
                                                   @csrf
                                                   <input type="hidden" name="id" value="{{ $each->id }}">
                                                   <tr>
                                                     <td class="border-b">
                                                       <select class="input w-full border mt-2" name="bibit_id">
                                                         @foreach($bibit as $b)
                                                          <option value="{{ $b->id }}" @if($b->id == $each->bibit_id) selected @endif>{{ $b->jenis }}</option>

                                                         @endforeach
                                                       </select>
                                                     </td>
                                                     <td class="border-b">
                                                       <input type="text" name="jumlah" class="input w-full border mt-2" value="{{ $each->jumlah }}">
                                                     </td>
                                                     <td class="border-b">
                                                       <select class="input w-full border mt-2" name="gudang_bibit_id">
                                                         @foreach($gudang_bibit as $g )
                                                          <option value="{{ $g->id }}" @if($g->id == $each->gudang_bibit_id) selected @endif>{{ $g->nama }}</option>
                                                         @endforeach
                                                       </select>
                                                     </td>
                                                     <td class="border-b">
                                                       <div class="flex sm:justify-center items-center">
                                                         <button class="button text-gray bg-theme-2 shadow-md flex items-center" type="submit"> Edit </button>&nbsp;&nbsp;
                                                         <a class="flex items-center text-theme-6" href="{{ route('csr.bibit.daftar.delete' , $each->id) }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                                       </div>
                                                     </td>
                                                   </tr>
                                                 </form>

                                               @endforeach
                                               </tbody>
                                              </table>

                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Post Content -->
                    <!-- BEGIN: Post Info -->
                    <div class="col-span-12 lg:col-span-4">
                        <div class="intro-y box p-5">
                            <div>
                                <label>Perusahaan </label>
                                <select class="input w-full border mt-2" id="perusahaan" name="perusahaan_id">
                                    @foreach($perusahaan as $each)
                                      <option value="{{ $each->id }}" @if($each->id == $csr->perusahaan_id) selected @endif >{{ $each->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label>Tanggal CSR</label>
                                <input type="date" name="tanggal" id="tanggal" value="{{ $csr->tanggal }}" class="input w-full border mt-2">
                            </div>
                            <div class="mt-3">
                                <label>Tanda Terima</label>
                                <div class="mt-2">
                                    <input type="file" name="tanda_terima" id="tanda_terima" class="input w-full border mt-2" value="">
                                      <div class="mt-2">
                                        <br>
                                    <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" width="200"  src="@if($csr->tanda_terima == NULL) /dist/images/profile-11.jpg @else {{ $csr->tanda_terima }} @endif">
                                        <a href="{{ route('csr.bibit.delete.tanda_terima' , $csr->id) }}"><div title="Hapus tanda terima ?" class="tooltip w-5 h-5 flex justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                        </a>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label>Catatan</label>
                                <div class="mt-2">
                                    <textarea name="catatan" rows="8" cols="80" id="catatan" class="input w-full border mt-2">{{ $csr->catatan }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END: Post Info -->
                </div>
            </div>
            <!-- END: Content -->
            <form class="hidden" id="form-csr" action="{{ route('csr.bibit.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $csr->id }}">
                @foreach($csr_bibit as $each)
                  <input type="hidden" id="old_bibit_{{ $each->bibit_id }}_{{ $each->gudang_bibit_id }}" value="">
                @endforeach
            </form>
@endsection
@section('js')
<script type="text/javascript">
function delete_list( bibit , gudang_bibit){
  //alert(gudang_bibit);
    $("#" + bibit + "_" + gudang_bibit ).remove();
    $("#bibit_" + bibit + "_" + gudang_bibit ).remove();
    $("#total_bibit_" + bibit + "_" + gudang_bibit ).remove();
    $("#gudang_bibit_" + bibit + "_" + gudang_bibit ).remove();
}

function cek(bibit , gudang_bibit ){
  return $("#" + bibit + "_" + gudang_bibit ).length;
}

function cek_old(bibit, gudang_bibit){
  //console.log("#old_bibit_" + text_bibit + "_" + nama_gudang);
  return $("#old_bibit_" + bibit + "_" + gudang_bibit).length;
}
    $(document).ready(function(){

        $('#tambah').click(function(){
            var bibit  = $('#bibit').val();
            var text_bibit = $( "#bibit option:selected" ).text();
            var gudang_bibit = $( "#gudang_bibit option:selected" ).text();
            var jumlah = $('#jumlah').val();
            var gudang_bibit_id = $('#gudang_bibit').val();
            //alert(gudang_bibit_id);
            var table = '<tr id="' + bibit + '_' + $('#gudang_bibit').val() +'">';
              table += '<td class="border-b">' + text_bibit + '</td>';
              table += '<td class="border-b">' + jumlah + '</td>';
              table += '<td class="border-b">' + gudang_bibit + '</td>';
              table += '<td class="border-b">';
              table += '  <div class="flex sm:justify-center items-center">';
              table += '    <a class="flex items-center text-theme-6" onclick=delete_list('+bibit +','+gudang_bibit_id+');> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus </a>';
              table += '  </div>';
              table += '</td>';
              table += '</tr>';

              if(!cek(bibit,$('#gudang_bibit').val()) && !cek_old(bibit,$('#gudang_bibit').val())){
                  $('.list-bibit').append(table);
                  var form_bibit = '<input type="hidden" id="bibit_'+bibit+'_'+gudang_bibit_id+'" name="bibit[jenis][]" value="'+bibit+'">';
                  $('#form-csr').append(form_bibit);
                  var form_total_bibit = '<input type="hidden" id="total_bibit_'+bibit+'_'+gudang_bibit_id+'" name="bibit[jumlah][]" value="'+jumlah+'">';
                  $('#form-csr').append(form_total_bibit);
                  var form_gudang_bibit = '<input type="hidden" id="gudang_bibit_'+bibit+'_'+gudang_bibit_id+'" name="bibit[gudang_bibit_id][]" value="'+$('#gudang_bibit').val()+'">';
                  $('#form-csr').append(form_gudang_bibit);
              }

        });

        $("#save").click(function(){
            var judul    =   $('#judul').clone();
            judul.attr('id' , 'form-judul');
            judul.val($('#judul').val());

            var perusahaan = $('#perusahaan').clone();
            perusahaan.attr('id' , 'form-perusahaan');
            perusahaan.val($('#perusahaan').val());

            var tanggal = $('#tanggal').clone();
            tanggal.attr('id' , 'form-tanggal');
            tanggal.val($('#tanggal').val());

            var tanda_terima = $('#tanda_terima').clone();
            tanda_terima.attr('id' , 'form-tanda_terima');

            var catatan = $('#catatan').clone();
            catatan.attr('id' , 'form-catatan');
            catatan.val($('#catatan').val());


            if(!$('#form-judul').length)
              $('#form-csr').append(judul);

            if(!$('#form-perusahaan').length)
              $('#form-csr').append(perusahaan);

            if(!$('#form-tanggal').length)
              $('#form-csr').append(tanggal);

            if(!$('#form-tanda_terima').length)
                $('#form-csr').append(tanda_terima);

            if(!$('#form-catatan').length)
                $('#form-csr').append(catatan);

            $("#form-csr").submit();

        });
    });
</script>
@endsection
