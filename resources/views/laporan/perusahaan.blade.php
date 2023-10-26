<div class="intro-y flex flex-col sm:flex-row items-center mt-8">

                    <h2 class="text-lg font-medium mr-auto">
                        Data Perusahaan
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                            <a href="{{ route('laporan.xls' , ['modul' => $request->modul , 'keyword' => isset($request->keyword) ? $request->keyword : ' ' , 'tanggal' => base64_encode($request->tanggal) ]) }}"><button >XLS</button></a>&nbsp;&nbsp;&nbsp;
                      <button onclick="printDiv()">Print</button>
                    </div>
                </div>
                <!-- BEGIN: Datatable -->
                <div class="overflow-x-auto">
                <div class="overflow-x-auto intro-y datatable-wrapper  box p-5 mt-5 " id="data">

                    <table class="table" id="table-perusahaan" border="1">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">#</th>
                                <th class="border-b-2  whitespace-no-wrap">NAMA PERUSAHAAN</th>
                                <th class="border-b-2  whitespace-no-wrap">JENIS PERUSAHAAN</th>
                                <th class="border-b-2  whitespace-no-wrap">NAMA PEMILIK</th>
                                <th class="border-b-2  whitespace-no-wrap">TANGGAL INPUT</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $each)
                            <tr>

                                <td class="text-center border-b">
                                    <div class="flex sm:justify-center">
                                        <div class="intro-x w-10 h-10 image-fit">
                                            <img alt="" class="rounded-full" width="150px" src="@if($each->logo != NULL) {{ $each->logo }} @else /dist/images/preview-9.jpg @endif">
                                        </div>
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