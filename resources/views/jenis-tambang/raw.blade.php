<link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
        <link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

<table class="table table-report table-report--bordered display datatable w-full" id="jenis-tambang">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">JENIS TAMBANG</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">TANGGAL INPUT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($jenis_tambang as $each)
                            <tr>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->jenis }}</div>
                                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->jenis }}</div>
                                </td>
                                <td class="text-center border-b">{{ date('Y-m-d H:i:s' , strtotime($each->created_at)) }}</td>
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                        <a class="flex items-center mr-3" href="{{ route('jenis-tambang.edit' , $each->id) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6" href="{{ route('jenis-tambang.delete' , $each->id) }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                     <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>


<script>
    $(document).ready(function(){
        $("#jenis-tambang").DataTable({
            dom: 'Blfrtip',
     buttons: [
       {  
          extend: 'copy'
       },
       {
          extend: 'pdf',
          exportOptions: {
            columns: [0,1] // Column index which needs to export
          }
       },
       {
          extend: 'csv',
       },
       {
          extend: 'excel',
       } 
     ] 
        });
    });
</script>