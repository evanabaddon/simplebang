@extends('template.layout')
@section('title' , 'Edit Kredit Donasi')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('penggunaan-donasi.kredit.index') }}" class="breadcrumb--active"> Kredit</a> </div>
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
                        Edit Kredit Donasi
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
                        <input type="text" name="judul" id="judul" value="{{ $donasi->judul }}" class="intro-y input input--lg w-full box pr-10 placeholder-theme-13" placeholder="Judul Penggunaan Donasi">
                        <div class="post intro-y overflow-hidden box mt-5">
                            <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                                <a title="Fill in the article content" data-toggle="tab" data-target="#content" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Daftar Donasi </a>

                            </div>
                            <div class="post__content tab-content">
                                <div class="tab-content__pane p-5 active" id="content">
                                    <div class="border border-gray-200 rounded-md p-5">
                                        <div class="mt-5">
                                          <div class="mt-3">
                                              <label>Pilih Asal CSR Donasi</label>
                                              <select class="input w-full border bg-gray-100  mt-2" id="csr">
                                                @foreach($csr as $each)
                                                  <option value="{{ $each->id }}">{{ $each->judul }}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="mt-3">
                                              <button class="button text-white bg-theme-1 shadow-md flex items-center" id="pilih"> Pilih </button>
                                          </div>
                                          <div class="hidden" id="set-kredit">
                                            <div class="mt-3">
                                              <div class="grid grid-cols-12 gap-6 mt-5">
                                                <div class="col-span-12 sm:col-span-6 xl:col-span-5 intro-y">
                                                    <div class="report-box zoom-in">
                                                        <div class="box p-5">
                                                            <div class="flex">
                                                                <i data-feather="dollar-sign" class="report-box__icon text-theme-10"></i>

                                                            </div>
                                                            <div class="text-3xl font-bold leading-8 mt-6" id="saldo"></div>
                                                            <div class="text-base text-gray-600 mt-1">Saldo Tersedia</div>
                                                        </div>
                                                    </div>
                                                </div>

                                              </div>
                                            </div>
                                            <div class="mt-3">
                                                <label>Nominal Kredit</label>
                                                <input type="text" class="input w-full border bg-white-10  mt-2" id="jumlah" value="" placeholder="Nominal penggunaan donasi">
                                            </div>
                                            <div class="mt-3">
                                                <label>keterangan</label>
                                                <textarea class="input w-full border bg-white  mt-2" id="keterangan" rows="8" cols="80" placeholder="Keterangan penggunaan donasi"></textarea>
                                            </div>
                                            <div class="mt-3">
                                              <div class="flex ">
                                                <button class="button text-white bg-theme-1 shadow-md flex " id="tambah"> Tambah ke daftar </button>&nbsp;&nbsp;
                                                  <button class="button text-grey bg-theme-0 shadow-md flex " id="clear"> Clear </button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="border border-gray-200 rounded-md p-5 mt-5">
                                        <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Daftar Kredit </div>
                                        <div class="mt-5">
                                          <div class="overflow-x-auto">
                                              <table class="table">
                                               <thead>
                                                 <tr class="bg-gray-700 text-white">
                                                   <th class="whitespace-no-wrap">Asal Donasi</th>
                                                   <th class="whitespace-no-wrap">Jumlah</th>
                                                   <th class="whitespace-no-wrap">Keterangan</th>
                                                   <th class="whitespace-no-wrap text-center">#</th>
                                                 </tr>
                                               </thead>
                                               <tbody class="list-kredit">
                                                 @foreach($kredit as $each)


                                                 <tr>
                                                   <form class="" action="{{ route('penggunaan-donasi.kredit.donasi.update') }}" method="post">
                                                     @csrf
                                                   <input type="hidden" name="id" value="{{ $each->id }}">
                                                  <td class="border-b"> <select class="input w-full border bg-white  mt-2" name="csr_id">
                                                      @foreach($csr as $c)
                                                        <option value="{{ $c->id }}" @if($c->id == $each->csr_id) selected  @endif>{{ $c->judul }}</option>
                                                      @endforeach
                                                  </select> </td>
                                                  <td class="border-b"> <input type="text" class="input w-full border bg-white  mt-2" name="jumlah" value="{{ $each->jumlah }}"> </td>
                                                  <td class="border-b"> <textarea name="keterangan" class="input w-full border bg-white  mt-2" rows="2" cols="40">{{ $each->keterangan }}</textarea> </td>
                                                  <td class="border-b">
                                                    <div class="flex sm:justify-center items-center">
                                                      <button class="button text-gray bg-theme-2 shadow-md flex items-center" type="submit"> Edit </button>&nbsp;&nbsp;
                                                      <a class="flex items-center text-theme-6" href="{{ route('penggunaan-donasi.kredit.donasi.delete' , $each->id) }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
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
                            </div>
                        </div>
                    </div>
                    <!-- END: Post Content -->
                    <!-- BEGIN: Post Info -->
                    <div class="col-span-12 lg:col-span-4">
                        <div class="intro-y box p-5">

                            <div class="mt-3">
                                <label>Catatan</label>
                                <div class="mt-2">
                                    <textarea name="catatan" rows="8" cols="80" id="catatan" class="input w-full border mt-2" placeholder="Catatan penggunaan donasi, penjelasan secara singkat dan jelas">{{ $donasi->catatan }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END: Post Info -->
                </div>
            </div>
            <!-- END: Content -->
            <form class="hidden" id="form-kredit" action="{{ route('penggunaan-donasi.kredit.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $donasi->id }}">
                <input type="hidden" name="judul" id="form_judul" value="">
                <input type="hidden" name="catatan" id="form_catatan" value="">
            </form>
@endsection
@section('js')
<script type="text/javascript">
function delete_list(tr_id){
    $("#" + tr_id).remove();
    $(".kredit_" + tr_id).remove();
}
  $(document).ready(function(){
    var tr_index = 1;
    $("#csr").change(function(){
        var csr = $(this).val();
        $.ajax({
            'type' : 'GET',
            'url' : '/penggunaan-donasi/saldo/' + csr,
            'success' : function(response){
              $("#saldo").html("Rp. " + response.saldo);
              $("#set-kredit").removeClass('hidden');
              $("#pilih").addClass('hidden');
              $("#jumlah").val('');
              $("#keterangan").val('');
            }
        });
    });
    $("#pilih").click(function(){
        var csr = $("#csr").val();
        $.ajax({
            'type' : 'GET',
            'url' : '/penggunaan-donasi/saldo/' + csr,
            'success' : function(response){
              $("#saldo").html("Rp. " + response.saldo);
              $("#set-kredit").removeClass('hidden');
              $("#pilih").addClass('hidden');
              $("#jumlah").val('');
              $("#keterangan").val('');
            }
        });
    });
    $("#clear").click(function(){
      $("#set-kredit").addClass('hidden');
      $("#pilih").removeClass('hidden');
      $("#jumlah").val('');
      $("#keterangan").val('');
    });



    $("#tambah").click(function(){
        var csr_id = $("#csr").val();
        var csr  = $("#csr option:selected").text();
        var jumlah = $("#jumlah").val();
        var keterangan = $("#keterangan").val();

        var table  = '<tr id="' + tr_index +'">';
          table += '<td class="border-b">' + csr+ '</td>';
          table += '<td class="border-b">'+ jumlah +'</td>';
          table += '<td class="border-b">'+ keterangan +'</td>';
          table += '<td class="border-b">';
          table += '  <div class="flex sm:justify-center items-center">';
          table += '    <a class="flex items-center text-theme-6" onclick=delete_list('+tr_index+')> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>';
          table += '  </div>';
          table += '</td>';
        table += '</tr>';


        $('.list-kredit').append(table);
        var form_csr  = '<input type="hidden" class="kredit_'+ tr_index +'" name="donasi[csr_id][]" value="' + csr_id +'">';
        var form_jumlah = '<input type="hidden" class="kredit_'+ tr_index +'" name="donasi[jumlah][]" value="' + jumlah +'">';
        var form_keterangan = '<input type="hidden" class="kredit_'+ tr_index +'" name="donasi[keterangan][]" value="' + keterangan +'">';
        var form_total = '<input type="hidden" class="kredit_'+ tr_index +'" name="total[jumlah]['+csr_id+'][]" value="' + jumlah +'">';
        $("#form-kredit").append(form_csr + form_jumlah + form_keterangan + form_total);

          tr_index = tr_index+1;
    });

    $("#save").click(function(){
      var catatan = $("#catatan").val();
      var judul = $("#judul").val();
      $("#form_judul").val(judul);
      $("#form_catatan").val(catatan);
      $("#form-kredit").submit();
    });
  });
</script>
@endsection
