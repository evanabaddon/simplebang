@extends('template.front.layout')

@section('content')
<main>

  <div class="container my-5" >
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
  <section class="py-5 container" id="latar-belakang" style="height: 100vh !important;">
    <div class="container col-xxl-12 px-4 py-5 " style="height: 50% !important;">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="https://www.digi.com/getattachment/blog/post/sustainable-city/gettyimages-544342844-1280x720.jpg?lang=en-us&width=1280&height=720&ext=.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold lh-1 mb-3">Latar Belakang</h1>
          <p class="lead">Dalam rangka menuju <b>ASEAN Environmentally Sustainable City Award</b> Tahun 2024, di Tahun 2022 Pemerintah Kabupaten Malang melalui Dinas Lingkungan Hidup meluncurkan program Kabupaten Malang Bersih (Clean City) dengan mentargetkan keberhasilan dalam pengelolaan lingkungan hidup (Clean land, Clean Air dan Clean Water)</p>
          <p class="lead mb-4">Salah satu indikator keberhasilan dalam pengelolaan lingkungan hidup adalah terpenuhinya target Indeks Kualitas Lingkungan Hidup Daerah (IKLHD) yang diwakili oleh Indeks Kualitas Udara (IKU), Indeks Kualitas Air (IKA), dan Indeks Kualitas Lahan (IKL)</p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="#profil"><button type="button" class="btn btn-outline-primary btn-lg px-4">Selengkapnya</button></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5 text-center container" id="profil" style="height: 100vh !important;">
    <div class="px-4 pt-5 my-5 text-center border-bottom">
      <h1 class="display-4 fw-bold">Indeks Kualitas Lahan</h1>
      <div class="col-lg-8 mx-auto">
        <div class="container px-5">
          <br>
          <canvas id="barChart"></canvas>
        </div>
        <p class="lead mb-3">Dari hasil Capaian IKLH Tahun 2022, walaupun sudah memenuhi target namun nilai Indeks Kualitas Lahan (IKL) masih di angka yang cukup rendah bahkan mengalami penurunan dari tahun 2022 (47,52 ke 46,88). Oleh karena itu, perlu adanya upaya yang lebih signifikan di tahun 2023 dalam meningkatkan IKL</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
          <a href="#target"><button type="button" class="btn btn-outline-primary btn-lg px-4">Selanjutnya : Target IKL Tahun 2023</button></a>
        </div>
      </div>
      <div >
        
      </div>
    </div>

  </section>

  <section class="py-5 text-center container" id="target" style="height: 100vh !important;">
    <div class="px-4 pt-5 my-5 text-center border-bottom">
      <h1 class="display-4 fw-bold">TARGET IKL TAHUN 2023</h1>
      <div class="col-lg-8 mx-auto">
        <div class="overflow-hidden">
        <div class="container px-5">
          <img src="/assets/img/tanam.png" class="img-fluid rounded-3  mb-4" alt="Example image" width="700" height="500" loading="lazy">
        </div>
      </div>
        <p class="lead mb-4">Dari hasil Capaian IKLH Tahun 2022, walaupun sudah memenuhi target namun nilai Indeks Kualitas Lahan (IKL) masih di angka yang cukup rendah. Oleh karena itu, perlu adanya upaya yang lebih signifikan di tahun 2023 dalam meningkatkan IKL. TARGET IKL > 50.00 pada Tahun 2023</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
        <a href="#lat"><button type="button" class="btn btn-outline-primary btn-lg px-4">Selanjutnya : Tantangan Pemanfaatan LAT</button></a>
      </div>
      </div>
      
    </div>

  </section>

  <section class="py-5 text-center container" id="lat" style="height: 100vh !important;">
    <div class="px-4 pt-5 my-5 text-center border-bottom">
      <h1 class="display-4 fw-bold">LAHAN AKSES TERBUKA (LAT)</h1>
      <div class="col-lg-8 mx-auto">
        <p class="lead mb-4">Salah satu komponen yang dapat dimaksimalkan dalam memperbaiki indeks kualitas lahan adalah Lahan Akses Terbuka (LAT) atau yang sering disebut lahan bekas tambang illegal. </p>
        <p class="lead mb-4">LAT sangat berpotensi menjadi lahan kritis dikarenakan tidak adanya upaya preservasi Top Soil lahan dan reklamasi lahan bekas tambang seperti yang dilakukan oleh pertambangan resmi yang dikelola oleh pemilik ijin tambang LAT. Jika tidak ditangani dengan baik
akan sangat berpotensi terjadi Erosi.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
        <a href="#tantangan"><button type="button" class="btn btn-outline-primary btn-lg px-4">Selanjutnya : Tantangan Pemanfaatan LAT</button></a>
      </div>
      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          <img src="https://img.freepik.com/premium-vector/green-eco-city-banner_174191-51.jpg?w=1280" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
        </div>
      </div>
    </div>

  </section>
  <section class="py-5 container" id="tantangan" style="height: 100vh !important;">
    <div class="px-4 pt-5 my-5 border-bottom">
      <h1 class="display-4 fw-bold text-center">Tantangan Pemanfaatan LAT</h1>
      <div class="col-lg-8 mx-auto">
        <p class="lead mb-4"></p>
        <div class="row row-cols-12 row-cols-md-12 mb-3 ">
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm ">

              <div class="card-body">

                <ul class="list mt-3 mb-4">
                  <li>Belum ada pemetaan secara komprehensif terkait persebaran LAT</li>
                  <li>Tingkat keberhasilan reboisasi pada LAT cukup rendah</li>
                  <li>Fokus hanya pada penanaman tetapi tidak ada rencana yang matang dalam pengelolaan pasca penanaman</li>
                  <li>Keterbatasan anggaran pemerintah untuk memaksimalkan program reboisasi, khususnya untuk memenuhi kriteria LAT</li>
                </ul>
              </div>
            </div>
          </div>

        </div>

      </div>
      <h1 class="display-4 fw-bold text-center">Inovasi DLH</h1>
      <div class="col-lg-8 mx-auto">
        <p class="lead mb-4"></p>
        <div class="row row-cols-12 row-cols-md-12 mb-3 ">
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm dlh">

              <div class="card-body">

                <ul class="list mt-3 mb-4">
                  <li>Untuk memudahkan update data lokasi Bekas Tambang, DLH membuat Peta Digital berdasarkan dokumen DATA BASE DAN PEMETAAN LAHAN KRITIS BEKAS TAMBANG DI KABUPATEN MALANG TAHUN 2022  </li>
                  <li>Untuk memudahkan pengelolaan program DLH membuat aplikasi Online berbasis web, yang sekaligus juga dapat memberikan informasi kepada masyarakat luas terkait progress dan akuntabilitas program</li>
                  <li>Untuk memaksimalkan pendanaan program, DLH akan berkolaborasi dengan pelaku usaha melalui Corporate Social Responsibility (CSR)</li>
                </ul>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </section>
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
        label: 'Realisasi 2022',
        fill: false,
        backgroundColor: "#004d03",
        borderColor: "#004d03",
        data: [42.8,77.95,47.9,58.13],
      }],
  }
});
</script>
@endsection