@extends('template.layout')
@section('title' , 'Daftar Penanaman')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('bank-bibit.index') }}" class="breadcrumb--active">Mitra Bibit</a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    @include('template.search')
                    @include('template.notification')
                    @include('template.account')
                </div>
                <!-- END: Top Bar -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Mitra Bibit
                    </h2>
                    
                </div>
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Item List -->
                    <div class="intro-y col-span-12 lg:col-span-8">
                        <div class="lg:flex intro-y">
                            <form>
                            <!--
                            <div class="relative text-gray-700">
                                <input type="text" name="keyword" class="input input--lg w-full lg:w-64 box pr-10 placeholder-theme-13" placeholder="Masukkan kata kunci lalu enter...">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
                            </div> -->
                            </form>
                            
                        </div>
                        
                        
                    </div>
                    <!-- END: Item List -->
                    
                </div>
                <div class="overflow-x-auto">
                  <div class="overflow-x-auto intro-y datatable-wrapper  box p-5 mt-5 ">

                    <table class="table" id="table-bank">
                        <thead>
                            <tr>
                                <th class="border-b-2 text-center whitespace-no-wrap">ASAL</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">TIPE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">JENIS BIBIT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">JUMLAH</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">HARGA/POHON</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">KEBUN BIBIT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">TANGGAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $key => $each)
                            <tr>
                              
                              <td>{{ $each['asal'] }}</td>
                              <td>{{ $each['tipe'] }}</td>
                              <td>{{ $each['bibit'] }}</td>
                              <td>@if($each['tipe'] == 'Debit') {{ $each['jumlah'] }} @else - {{ $each['jumlah'] }} @endif</td>
                              <td> @rupiah($each['harga'])</td>
                              <td>{{ $each['gudang'] }}</td>
                              <td>{{ date('d-m-Y' , strtotime($each['created_at'])) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                
            </div>
            <!-- END: Content -->
@endsection

@section('js')
<script>
    $("#table-bank").dataTable({});
</script>    
@endsection