@extends('template.front.layout')
@section('content')
<main>

  <div class="container my-5" >
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-5 fw-bold lh-1 mb-3">INOVASI DLH : SIMPLE BANG 
        </h1>
        <h3>SISTEM INFORMASI PEMULIHAN LAHAN BEKAS TAMBANG</h3>
        <ul class="list">
          <li>Untuk memudahkan update data lokasi Bekas Tambang, DLH membuat Peta Digital lokasi bekas tambang (plot reboisasi)</li>
          <li>Untuk memudahkan pengelolaan program DLH membuat aplikasi Online berbasis web, yang sekaligus juga dapat memberikan informasi kepada masyarakat luas terkait progress dan akuntabilitas program</li>
          <li>Untuk memaksimalkan pendanaan program, DLH akan berkolaborasi dengan pelaku usaha melalui Corporate Social Responsibility (CSR)</li>
        </ul>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">

        </div>
      </div>
      <div class="col-lg-5  overflow-hidden">
          <img class="rounded-lg-3" src="/dist/images/simplebang.png" alt="" width="600">
      </div>
    </div>
    <section class="py-5 container" id="latar-belakang" >
    <div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 ">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1">PROFIL SIMPLE BANG</h1>
        <p class="lead">Keunggulan Aplikasi SIMPLE BANG :</p>
        <ul class="list">
          <li>Berbasis Web sehingga ringan dan mudah diakses (menggunakan mobile phone), tanpa perlu mendownload di Play Store / Apps Store</li>
          <li>User Friendly, memberikan kemudahan dalam akses data</li>
          <li>Sebagai instrument untuk mempermudah pengelolaan program</li>
          <li>Transparasi data dan konsistensi data yang up to date</li>
          <li>Sebagai media promosi dan apresiasi bagi pelaku usaha terkait kontribusi dalam pengurangan emisi Karbon</li>
        </ul>
        
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
          <iframe width="100%" height="312px"
            src="https://www.youtube.com/embed/aLos8FhCOVY">
            </iframe>
      </div>
    </div>
  </div>
  </section>
  <section class="py-5 container" id="latar-belakang" >
    <div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold">DASAR PEMBUATAN PETA DIGITAL</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Pembuatan Aplikasi SIMPLEBANG ini berdasarkan kajian dan analisis data dokumen <b>DATA BASE DAN PEMETAAN LAHAN KRITIS BEKAS TAMBANG DI KABUPATEN MALANG TAHUN 2022 </b>sehingga didapatkan tingkat kekritisan masing-masing bekas tambang termasuk juga sampling kondisi tanahnya untuk menentukan jenis tanaman yang sesuai </p>
      
    </div>
    <div class="overflow-hidden" >
      <div class="container px-5">
        <img src="/img/dasar-peta.png" class="img-fluid border rounded-3 shadow-lg mb-4" >
        
      </div>
      <a target="_blank" href="/download/Laporan_Akhir_Studi_Identifikasi_Lahan_Kritis_Hasil_Lab.pdf"><button class="btn btn-default">Download PDF</button></a>
      <br><br>
    </div>
  </div>
  </section>
  </div>


</main>
@endsection
