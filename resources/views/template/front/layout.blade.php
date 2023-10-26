<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Simplebang - Kabupaten Malang</title>
	<link rel="icon" type="image/x-icon" href="/dist/images/simplebang.png">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">

      <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
  rel="stylesheet"
/>
    <!-- Bootstrap core CSS -->
<link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
.checked {
  color: orange;
}
</style>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      @media (min-width: 992px) {
        .rounded-lg-3 { border-radius: .3rem; }
      }
      .hidden{
        display: none;
      }
      .dlh{
        background-color: #2F7C31;
        color: #fff;
      }

      .nav-link{
        text-decoration: none;
        color: #000;
      }

      .white{
        text-decoration: none;
        color: #fff !important;
      }

      .responsive {
        width: 100%;
        height: auto;
      }

      @media only screen and (max-width: 480px) {
        .img {
          width: 100%;
        }
      }

      .bg-section {
        background: linear-gradient(to top, rgb(64, 182, 73), rgb(105, 189, 69));
        padding: 20px; 
        color: #fff; 
      }

      .bg-section h1 {
        font-size: 2rem; 
      }

      .bg-section p {
        font-size: 1rem; 
      }

      .bg-section .container {
        padding: 20px; 
        border-radius: 10px; 
        width: 100%;
      }

      h1 {
        font-size: 2rem!important;; 
      }

      .fw-bold {
          font-weight: 500!important;
      }

      body {
        font-family: 'Poppins', sans-serif;
      }

      h1 {
        font-family: 'Poppins', sans-serif;
      }

      p {
        font-family: 'Poppins', sans-serif;
      }

      .navbar-nav .nav-link {
        font-weight: 600; 
        color: #000; 
      }

      .navbar-nav .nav-link.active {
        color: #46B749!important;; 
      }

    </style>


  </head>
  <body>

@include('template.front.menu')

@yield('content')

@include('template.front.footer')

  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
@yield('js')
    <script type="text/javascript">
      
    </script>
   <!-- Footer -->
<footer class="text-center text-lg-start bg-white text-muted">

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <b>Simplebang</b>
          </h6>
          <p>
            Sistem Informasi Pemulihan Lahan Bekas Tambang.
          </p>
        </div>
        <!-- Grid column -->

        

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="/login" class="text-reset">Login</a>
          </p>
           <p>
            <a href="https://instagram.com/mydarlingofficial_?igshid=NDk5N2NlZjQ=" class="me-4 link-secondary"><i class="fa fa-instagram"></i> Instagram</a>
          </p>
          <p>
            <a href="https://youtube.com/@mydarlingmillennialyouthsa7521" class="me-4 link-secondary">
              <i class="fa fa-youtube"></i> Youtube</a>
          </p>
          
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fa fa-home me-3 text-secondary"></i>  Jl. Panji No.158, Krajan, Panggungrejo, Kec. Kepanjen, Kabupaten Malang, Jawa Timur 65163</p>
          <p>
            <i class="fa fa-envelope me-3 text-secondary"></i>
            dinas.lh@malangkab.go.id
          </p>
          <p><i class="fa fa-phone me-3 text-secondary"></i> +62 821-1101-8877</p>
          
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4 bg-section" >
    © 2023 Copyright:
    <a class="text-reset fw-bold" href="https://simplebang.online/">DLH Kabupaten Malang</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
  </body>
</html>
