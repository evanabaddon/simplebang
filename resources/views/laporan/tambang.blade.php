<div class="intro-y flex flex-col sm:flex-row items-center mt-8">

                    <h2 class="text-lg font-medium mr-auto">
                        Data Tambang
                    </h2>
                      <a href="{{ route('laporan.xls' , ['modul' => $request->modul , 'keyword' => isset($request->keyword) ? $request->keyword : ' ' , 'tanggal' => base64_encode($request->tanggal) ]) }}"><button >XLS</button></a>&nbsp;&nbsp;&nbsp;
                      <button onclick="printDiv()">Print</button>
                </div>
<!-- BEGIN: Datatable -->
                <div class="overflow-x-auto">
                  <div class="overflow-x-auto intro-y datatable-wrapper  box p-5 mt-5 " id="data">

                    <table class="table" id="table-tambang" border="1">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">#</th>
                                <th class="border-b-2  whitespace-no-wrap">NAMA TAMBANG</th>
                                <th class="border-b-2  whitespace-no-wrap">JENIS TAMBANG</th>
                                <th class="border-b-2  whitespace-no-wrap">NAMA PEMILIK</th>
                                <th class="border-b-2  whitespace-no-wrap">STATUS LAHAN</th>
                                <th class="border-b-2  whitespace-no-wrap">TANGGAL INPUT</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $each)
                            <tr>

                              <td class="w-40">
                                      <div class="flex">
                                        @if(empty($each->foto))
                                          <div class="w-10 h-10 image-fit zoom-in">
                                              <img alt="Midone Tailwind HTML Admin Template" width="150px" class="tooltip rounded-full" src="/dist/images/preview-4.jpg" title="Uploaded at 17 July 2021">
                                          </div>
                                        @else
                                          @foreach($each->foto as $key => $foto)
                                          @if($key <= 4 )
                                          <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                              <img alt="{{ $each->nama }}" width="150px" class="tooltip rounded-full" src="{{ $foto->foto }}" title="{{ $each->nama }}">
                                          </div>
                                          @endif
                                          @endforeach
                                        @endif
                                      </div>
                                  </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->nama }}</div>
                                    
                                </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->jenis }}</div>
                                    
                                </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->nama_pemilik }}</div>
                                   
                                </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->status_lahan }}</div>
                                    
                                </td>
                                <td class="border-b w-5">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->created_at }}</div>
                                    
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                </div>
                <!-- END: Datatable -->