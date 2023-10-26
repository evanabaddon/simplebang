<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="/dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Simpelbang - @yield('title')</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="/dist/css/app.css" />
        <link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
        <link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Mobile Menu -->
        @include('template.mobile')
        <!-- END: Mobile Menu -->
        @include('template.menu')
        <!-- BEGIN: JS Assets-->
        @yield('content')
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

        

        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <!-- END: JS Assets-->
        <script src="/dist/js/app.js"></script> 
        <script>
            function fnExcelReport() {  
              var table = document.getElementById('table-tambang');   
              var tableHTML = table.outerHTML;  
              var fileName = 'download.xls';  
              
              var msie = window.navigator.userAgent.indexOf("MSIE ");  
              if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {  
                dummyFrame.document.open('txt/html', 'replace');  
                dummyFrame.document.write(tableHTML);  
                dummyFrame.document.close();  
                dummyFrame.focus();  
                return dummyFrame.document.execCommand('SaveAs', true, fileName);  
              }  
              else {  
                var a = document.createElement('a');  
                tableHTML = tableHTML.replace(/  /g, '').replace(/ /g, '%20');   
                a.href = 'data:application/vnd.ms-excel,' + tableHTML;  
                a.setAttribute('download', fileName);  
                document.body.appendChild(a);  
                a.click();  
                document.body.removeChild(a);  
              }  
            }  
        </script>
    </body>
    @yield('js')
</html>
