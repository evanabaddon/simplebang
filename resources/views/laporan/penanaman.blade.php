<div class="intro-y flex flex-col sm:flex-row items-center mt-8">

                    <h2 class="text-lg font-medium mr-auto">
                        Data Penanaman
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       <a href="{{ route('laporan.xls' , ['modul' => $request->modul , 'keyword' => isset($request->keyword) ? $request->keyword : ' ' , 'tanggal' => base64_encode($request->tanggal) ]) }}"><button >XLS</button></a>&nbsp;&nbsp;&nbsp;
                      <button onclick="printDiv()">Print</button>
                    </div>
                </div>

                <!-- BEGIN: Datatable -->
            
                <div class="overflow-x-auto">
                  <div class="overflow-x-auto intro-y datatable-wrapper  box p-5 mt-5 " id="data">

                    <table class="table" id="table-penanaman" border="1">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">JUDUL</th>
                                <th class="border-b-2 whitespace-no-wrap">TAMBANG</th>
                                <th class="border-b-2 whitespace-no-wrap">DAFTAR BIBIT</th>
                                 <th class="border-b-2 whitespace-no-wrap">LUAS TAMBANG</th>
                                <th class="border-b-2 whitespace-no-wrap">LUAS PENANAMAN</th>
                                <th class="border-b-2 whitespace-no-wrap">JUMLAH BIBIT TERTANAM</th>
                                <th class="border-b-2  whitespace-no-wrap">TANGGAL PENANAMAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $each)
                             <tr>
                                <td class="border-b">
                                    
                                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->judul }}</div>
                                </td>
                                <td class="border-b">{{ $each->tambang }}</td>
                                <td class="border-b">
                                  <div class="flex">
                                  @foreach($each->list_bibit as $bibit)
                                    @if($bibit->logo == NULL)
                                      <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                          <img alt="{{ $bibit->jenis }}" width="150px" class="tooltip rounded-full" src="/dist/images/preview-4.jpg" title="{{ $bibit->jenis }}">
                                      </div>
                                    @else
                                      <div class="w-10 h-10 image-fit zoom-in -ml-1">
                                          <img alt="{{ $bibit->jenis }}"  width="150px" class="tooltip rounded-full" src="{{ $bibit->logo }}" title="{{ $bibit->jenis }}">
                                      </div>
                                    @endif
                                  @endforeach
                                  </div>
                                </td>
                                <td class="border-b">{{ $each->luas }} m2</td>
                                <td class="border-b">{{ $each->luas_penanaman }} m2</td>
                                <td class="border-b">{{ $each->jumlah_bibit}} </td>
                                <td class="border-b">{{ $each->tanggal}} </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                <!-- END: Datatable -->