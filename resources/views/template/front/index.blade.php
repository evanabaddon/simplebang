@extends('template.front.layout')

@section('content')
<main>

  <div class="container" >
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 ">
      <!--<div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-5 fw-bold lh-1 mb-3">Simplebang</h1>
        <h3 class="display-7 lh-1 mb-3">Sistem Informasi Pemulihan Lahan Bekas Tambang</h3>
        <ul class="list">
          <li>Berbasis Web sehingga ringan dan mudah diakses (menggunakan mobile phone), tanpa perlu mendownload di Play Store / Apps Store</li>
          <li>Mampu memberikan informasi secara realtime dan terintegrasi</li>
          <li>Memiliki keamanan data yang cukup memadai  dalam menjaga kerahasiaan informasi</li>
          <li>Dilengkapi fitur geo tagging, data report management dan digital mapping</li>
        </ul>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a href="#latar-belakang"><button type="button" class="btn btn-outline-primary btn-lg px-4">Selengkapnya</button></a>
        </div>
      </div>-->
      
          <img class="rounded-lg-3" src="/dist/images/simplebang.png" alt="" width="720">
    </div>
  </div>
  <section class="py-2 container-fluid bg-section" id="latar-belakang" >
    <div class="container col-xxl-12 px-4 py-2 ">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-2">
        <div class="col-12 col-sm-8 col-lg-6">
          <img src="https://simplebang.malangkab.go.id/img/bupati.png" class="d-block mx-lg-auto img-fluid"  loading="lazy">
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold lh-1 mb-3">Latar Belakang</h1>
          <p class="lead">Dalam rangka menuju <b>ASEAN Environmentally Sustainable City Award</b> Tahun 2024, di Tahun 2022 Pemerintah Kabupaten Malang melalui Dinas Lingkungan Hidup meluncurkan program Kabupaten Malang Bersih (Clean City) dengan mentargetkan keberhasilan dalam pengelolaan lingkungan hidup (Clean land, Clean Air dan Clean Water)</p>
          <p class="lead mb-4 mt-4">Salah satu indikator keberhasilan dalam pengelolaan lingkungan hidup adalah terpenuhinya target Indeks Kualitas Lingkungan Hidup Daerah (IKLHD) yang diwakili oleh Indeks Kualitas Udara (IKU), Indeks Kualitas Air (IKA), dan Indeks Kualitas Lahan (IKL)</p>
          
        </div>
      </div>
    </div>
  </section>
  <section class="py-2 text-center container" id="profil" >
    <div class="px-4 my-5 text-center ">
      <h1 class="display-4 fw-bold">Indeks Kualitas Lahan</h1>
      <div class="col-lg-8 mx-auto">
        <div class="container px-5">
          <br>
          <canvas id="barChart"></canvas>
        </div>
        <p class="lead mb-3">Dari hasil Capaian IKLH Tahun 2022, walaupun sudah memenuhi target namun nilai Indeks Kualitas Lahan (IKL) masih di angka yang cukup rendah bahkan mengalami penurunan dari tahun 2022 (47,52 ke 46,88). Oleh karena itu, perlu adanya upaya yang lebih signifikan di tahun 2023 dalam meningkatkan IKL</p>
        
      </div>
      
    </div>

  </section>

  <section class="py-2 text-center container-fluid bg-section" id="target" >
    <div class="px-4 my-5 text-center ">
      <h1 class="display-4 fw-bold">TARGET IKL TAHUN 2023</h1>
      <div class="col-lg-8 mx-auto">
        <div class="overflow-hidden">
        <div class="container px-5">
          <img src="https://simplebang.malangkab.go.id/img/target-ikl.png" class="img-fluid rounded-3 loading="lazy">
        </div>
      </div>
        <p class="lead mb-4 mt-4">Dari hasil Capaian IKLH Tahun 2022, walaupun sudah memenuhi target namun nilai Indeks Kualitas Lahan (IKL) masih di angka yang cukup rendah. Oleh karena itu, perlu adanya upaya yang lebih signifikan di tahun 2023 dalam meningkatkan IKL. TARGET IKL > 50.00 pada Tahun 2023</p>
      
      </div>
      
    </div>

  </section>

  <section class="py-2 text-center container" id="target" >
    <div class="px-4 my-5 text-center ">
      <h1 class="display-4 fw-bold">LAHAN AKSES TERBUKA (LAT)</h1>
      <div class="col-lg-8 mx-auto">
        <div class="overflow-hidden">
        <div class="container px-5">
          <img src="https://simplebang.malangkab.go.id/img/lat.png" class="img-fluid rounded-3" loading="lazy">
        </div>
      </div>
        <p class="lead mb-4 mt-4">Salah satu komponen yang dapat dimaksimalkan dalam memperbaiki indeks kualitas lahan adalah Lahan Akses Terbuka (LAT) atau yang sering disebut lahan bekas tambang illegal. LAT sangat berpotensi menjadi lahan kritis dikarenakan tidak adanya upaya preservasi Top Soil lahan dan reklamasi lahan bekas tambang</p>
      
      </div>
      
    </div>

  </section>


  <section class="py-2 container-fluid bg-section" id="target" >
    <div class="px-4 my-5 text-center ">
      <h1 class="display-4 fw-bold">TANTANGAN DALAM PEMANFAATAN LAT </h1>
      <div class="col-lg-8 mx-auto">
        <div class="overflow-hidden">
        <div class="container px-5">
          <img src="https://simplebang.malangkab.go.id/img/tantangan.png" class="img-fluid rounded-3" loading="lazy">
        </div>
      </div>
        <ul class="list mt-4 mb-4" style="text-align: left !important; ">
          
                  <li>Belum ada pemetaan secara komprehensif terkait persebaran LAT</li>
                  <li>Tingkat keberhasilan reboisasi pada LAT cukup rendah</li>
                  <li>Fokus hanya pada penanaman tetapi tidak ada rencana yang matang dalam pengelolaan pasca penanaman</li>
                  <li>Keterbatasan anggaran pemerintah untuk memaksimalkan program reboisasi, khususnya untuk memenuhi kriteria LAT</li>
                </ul>
      
      </div>
      
    </div>

  </section>

  <section class="py-2 text-center container" id="target" >
    <div class="px-4 my-5 text-center ">
      <h1 class="display-4 fw-bold">INOVASI DLH : SIMPLE BANG <br>
<span style="color: #46B749 !important;">SISTEM INFORMASI PEMULIHAN LAHAN BEKAS TAMBANG </span></h1>
      <div class="col-lg-8 mx-auto">
        <div class="overflow-hidden">
        <div class="container px-5">
          <img src="https://simplebang.malangkab.go.id/img/simpleb.png" class="img-fluid rounded-3" alt="Example image"  loading="lazy">
        </div>
      </div>
        <ul class="list mt-4 mb-4" style="text-align: left !important; ">
          
                  <li>Untuk memudahkan update data lokasi Bekas Tambang, DLH membuat Peta Digital lokasi bekas tambang (plot reboisasi)
</li>
                  <li>Tingkat keberhasilan reboisasi pada LAT cukup rendah</li>
                  <li>Untuk memudahkan pengelolaan program DLH membuat aplikasi Online berbasis web, yang sekaligus juga dapat memberikan informasi kepada masyarakat luas terkait progress dan akuntabilitas program</li>
                  <li>Untuk memaksimalkan pendanaan program, DLH akan berkolaborasi dengan pelaku usaha melalui Corporate Social Responsibility (CSR)</li>
                </ul>
      
      </div>
      
    </div>

  </section>
  <section class="py-2 container-fluid bg-section" id="target" >
    <div class="px-4 my-5 text-center ">
      <h1 class="display-4 fw-bold">Kolaborasi DLH dengan PEMUDA TANI KAB. MALANG</h1>
      <div class="col-lg-8 mx-auto">
        <div class="overflow-hidden">
        <div class="container px-5">
          <img src="https://simplebang.malangkab.go.id/img/kolab.png" class="img-fluid rounded-3  mb-4" alt="Example image" width="700" height="500" loading="lazy">
        </div>
      </div>
        <p class="lead mb-4">DLH akan bekerjasama dengan PEMUDA TANI KABUPATEN MALANG dalam hal penyediaan bibit sesuai kebutuhan reboisasi, penyediaan kebun bibit (penyimpanan), proses penanaman dan pemeliharaan bibit pasca penanaman</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
        
      </div>
      </div>
      
    </div>

  </section>
  <section class="py-2 text-center container" id="target" >
    <div class="px-4 my-5 text-center ">
      <h1 class="display-4 fw-bold">ALUR PENANAMAN</h1>
      <div class="col-lg-8 mx-auto">
        <div class="overflow-hidden">
        <div class="container px-5">
          
        </div>
      </div>
        <img src="https://simplebang.malangkab.go.id/img/alur.png" class="img-fluid rounded-3  mb-4" alt="Example image" width="700" height="500" loading="lazy">
      
      </div>
      
    </div>

  </section>
  <section class="py-2 container-fluid bg-section" id="target" >
    <div class="px-4 my-5 text-center ">
      <h1 class="display-4 fw-bold">PENGEMBANGAN JANGKA PANJANG</h1>
      <div class="col-lg-8 mx-auto">
        <div class="overflow-hidden">
        <div class="container px-5">
          <img src="https://simplebang.malangkab.go.id/img/jangka.png" class="img-fluid rounded-3  mb-4" alt="Example image" width="700" height="500" loading="lazy">
        </div>
      </div>
        <p class="lead mb-4">
Ke depannya program SIMPLE BANG tidak hanya berfokus pada pemulihan LAT saja, tetapi akan juga pemulihan Daerah Aliran Sungai (DAS) yang mengalami kerusakan akibat proses penambangan illegal

</p>
       
      
      </div>
      
    </div>

  </section>
  <br>
  
</main>
@endsection
@section('js')
<script type="text/javascript">
  var ctx = document.getElementById("barChart").getContext('2d');
var barChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['', '', '', '', ''],
      datasets: [{
        label: 'Target 2022',
        backgroundColor: "#2e7a30",
        borderColor: "#2e7a30",
        data: [42.7 ,77.86,46.57,58.13],
        fill: false,
      }, {
        label: 'Target 2023',
        fill: false,
        backgroundColor: "#5faa5c",
        borderColor: "#5faa5c",
        data: [66.39,79.74,46.88,67.52],
      }, {
        label: 'Capaian 2022',
        fill: false,
        backgroundColor: "#004d03",
        borderColor: "#004d03",
        data: [42.8,77.95,47.9,58.13],
      }],
  }
});
</script>
@endsection