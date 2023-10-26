<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TambangController;
use App\Http\Controllers\JenisTambangController;
use App\Http\Controllers\JenisUsahaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\BibitController;
use App\Http\Controllers\GudangBibitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsrController;
use App\Http\Controllers\PenggunaanDonasiController;
use App\Http\Controllers\PenanamanController;
use App\Http\Controllers\BankBibitController;
use App\Models\CsrBibitModel;
use App\Models\CsrOutBibitModel;
use App\Models\CsrOutModel;
use App\Models\BibitModel;
USE App\Models\TambangModel;
use App\Models\FotoTambangModel;
use App\Models\PemilikTambangModel;
use App\Models\DokumentasiModel;
use App\Models\GudangBibitModel;
use App\Models\PerusahaanModel;
use App\Models\CsrModel;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Http\Controllers\LaporanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/dummy' , function(){
    $debit  =    CsrBibitModel::join('bibit' , 'bibit.id' , '=' , 'csr_bibit.bibit_id')
    ->join('csr' , 'csr.id' , '=' , 'csr_bibit.csr_id')
    ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_bibit.gudang_bibit_id')
    ->select(Db::raw('csr.judul as asal') , 'bibit.jenis as bibit' , 'gudang_bibit.nama as gudang' , 'csr_bibit.jumlah'  , Db::raw("'Debit' as tipe"), 'csr_bibit.created_at')
    ->get();

    $kredit    = CsrOutBibitModel::join('bibit' , 'bibit.id' , '=' , 'csr_out_bibit.bibit_id')
    ->join('csr_out' , 'csr_out.id' , '=' , 'csr_out_bibit.csr_out_id')
    ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_out_bibit.gudang_bibit_id')
    ->select(Db::raw('csr_out.judul as asal') , 'bibit.jenis as bibit' , 'gudang_bibit.nama as gudang' , 'csr_out_bibit.jumlah' , Db::raw("'Kredit' as tipe") , 'csr_out_bibit.created_at')
    ->get();

    $debit = collect($debit->toArray());
    $kredit     =   collect($kredit->toArray());


    $history    =    $debit->merge($kredit)->sortByDesc('created_at');
    echo "<pre>";
    print_r($history);
});

Route::get('/' , function(){

    return view('template.front.index');
});

Route::get('/gallery' , function(){
  	
  	$penanaman 	=	 CsrOutModel::all();
    foreach($penanaman as $key => $each){
      	$penanaman[$key]->foto 	=	 DokumentasiModel::where('csr_out_id' , $each->id)->get();
      	$penanaman[$key]->tambang 	=	TambangModel::find($each->tambang_id);
    }
  
  	$foto 	= DokumentasiModel::join('csr_out' , 'csr_out.id' , '=' , 'dokumentasi.csr_out_id')->get();
	return view('template.front.gallery' , ["penanaman" => $penanaman , "foto" => $foto]);
});

Route::get('/carbon-offsets' , function(){
    return view('template.front.carbon');
});

Route::get('/peta-tambang' , function(){
    $tambang    =    TambangModel::all();
    return view('template.front.peta' , ["tambang" => $tambang]);
});

Route::get('/profil' , function(){
    return view('template.front.profil');
});

Route::post('/peta-tambang' , function(Request $request){
    $id     =    $request->id;
    $tambang    =    TambangModel::findOrFail($id);
    $tambang    =    TambangModel::where('tambang.id' , $tambang->id)
    ->join('jenis_tambang' , 'jenis_tambang.id' , '=' , 'tambang.jenis_tambang_id')
    ->select('tambang.id as id' , 'jenis_tambang.jenis'  , 'tambang.pemilik_tambang_id' , 'tambang.nama', 'tambang.alamat' , 'tambang.luas' , 'tambang.lokasi')->first();

    $foto_tambang   =    FotoTambangModel::where('tambang_id' , $tambang->id)->get();

    $pemilik    =    PemilikTambangModel::where('id' , $tambang->pemilik_tambang_id)->first();

    $penanaman  =    CsrOutModel::where('tambang_id'  , $id)
    ->get();

    $bibit_tanam    =    CsrOutBibitModel::whereIn('csr_out_id' , CsrOutModel::where('tambang_id' , $id)->select('id')->get())
    ->join('bibit' , 'bibit.id'  , '=' , 'csr_out_bibit.bibit_id')
    ->join('csr_out' , 'csr_out.id' , '=' , 'csr_out_bibit.csr_out_id')
    ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_out_bibit.gudang_bibit_id')
    ->select('csr_out.judul' , 'bibit.jenis'  , 'gudang_bibit.nama' , 'csr_out_bibit.jumlah' , 'csr_out.tanggal')
    ->get();

    $dokumentasi    =    DokumentasiModel::whereIn('csr_out_id' , CsrOutModel::where('tambang_id' , $id)->select('id')->get())->get();

    return view('template.front.tambang' , ["tambang" => $tambang , "foto_tambang" => $foto_tambang , "pemilik" => $pemilik , "penanaman" => $penanaman , "bibit_tanam" => $bibit_tanam , "dokumentasi" => $dokumentasi]);
});

Route::get('/peta-tambang/{id}' , function($id){
    $tambang    =    TambangModel::findOrFail($id);
    $tambang    =    TambangModel::where('tambang.id' , $tambang->id)
    ->join('jenis_tambang' , 'jenis_tambang.id' , '=' , 'tambang.jenis_tambang_id')
    ->select('tambang.id as id' , 'jenis_tambang.jenis'  , 'tambang.pemilik_tambang_id' , 'tambang.nama', 'tambang.alamat' , 'tambang.luas' , 'tambang.lokasi')->first();

    $foto_tambang   =    FotoTambangModel::where('tambang_id' , $tambang->id)->get();

    $pemilik    =    PemilikTambangModel::where('id' , $tambang->pemilik_tambang_id)->first();

    $penanaman  =    CsrOutModel::where('tambang_id'  , $id)
    ->get();

    $bibit_tanam    =    CsrOutBibitModel::whereIn('csr_out_id' , CsrOutModel::where('tambang_id' , $id)->select('id')->get())
    ->join('bibit' , 'bibit.id'  , '=' , 'csr_out_bibit.bibit_id')
    ->join('csr_out' , 'csr_out.id' , '=' , 'csr_out_bibit.csr_out_id')
    ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_out_bibit.gudang_bibit_id')
    ->select('csr_out.judul' , 'bibit.jenis'  , 'gudang_bibit.nama' , 'csr_out_bibit.jumlah' , 'csr_out.tanggal')
    ->get();

    $dokumentasi    =    DokumentasiModel::whereIn('csr_out_id' , CsrOutModel::where('tambang_id' , $id)->select('id')->get())->get();

    return view('template.front.tambang' , ["tambang" => $tambang , "foto_tambang" => $foto_tambang , "pemilik" => $pemilik , "penanaman" => $penanaman , "bibit_tanam" => $bibit_tanam , "dokumentasi" => $dokumentasi]);
});

Route::get('/mitra-bibit-pohon' , function(Request $request){
    $debit  =    CsrBibitModel::join('bibit' , 'bibit.id' , '=' , 'csr_bibit.bibit_id')
    ->join('csr' , 'csr.id' , '=' , 'csr_bibit.csr_id')
    ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_bibit.gudang_bibit_id')
    ->select(Db::raw('csr.judul as asal') , 'bibit.jenis as bibit' , 'gudang_bibit.nama as gudang' , 'csr_bibit.jumlah'  , Db::raw("'Debit' as tipe"), 'csr_bibit.created_at' , 'bibit.id as bibit_id');
    
    if($request->gudang){
        $debit  =    $debit->where('csr_bibit.gudang_bibit_id' , $request->gudang);
    }
    $debit  =    $debit->get();

    $kredit    = CsrOutBibitModel::join('bibit' , 'bibit.id' , '=' , 'csr_out_bibit.bibit_id')
    ->join('csr_out' , 'csr_out.id' , '=' , 'csr_out_bibit.csr_out_id')
    ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_out_bibit.gudang_bibit_id')
    ->select(Db::raw('csr_out.judul as asal') , 'bibit.jenis as bibit' , 'gudang_bibit.nama as gudang' , 'csr_out_bibit.jumlah' , Db::raw("'Kredit' as tipe") , 'csr_out_bibit.created_at' , 'bibit.id as bibit_id');
    
    if($request->gudang){
        $kredit     =    $kredit->where('csr_out_bibit.gudang_bibit_id' , $request->gudang);
    }
    $kredit     =    $kredit->get();

    $debit = collect($debit->toArray());
    $kredit     =   collect($kredit->toArray());


    $data   =    BibitModel::whereIn('id' , CsrBibitModel::groupBy('bibit_id')->select('bibit_id')->get());
    if($request->gudang){
        $data   =    BibitModel::whereIn('id' , CsrBibitModel::groupBy('bibit_id')->where('gudang_bibit_id' , $request->gudang)->select('bibit_id')->get());
    }
        $data   =    $data->get();

        foreach($data as $k => $v){
            $total  =    CsrBibitModel::where('bibit_id' , $v->id)->sum('jumlah');
            $total_tanam    =    CsrOutBibitModel::where('bibit_id' , $v->id)->sum('jumlah');

            if($request->gudang){
                $total  =    CsrBibitModel::where('bibit_id' , $v->id)->where('gudang_bibit_id' , $request->gudang)->sum('jumlah');
            $total_tanam    =    CsrOutBibitModel::where('bibit_id' , $v->id)->where('gudang_bibit_id'  , $request->gudang)->sum('jumlah');
            }

            $data[$k]->tersedia     =    $total - $total_tanam;
        }

    $history    =    $debit->merge($kredit)->sortByDesc('created_at');

    $gudang     =    GudangBibitModel::all();


    $totalan  =   [];
     
    // add total tanam dan total tersedia
    foreach($history as $key => $each){
      $total_tanam   =  CsrOutBibitModel::where('bibit_id' , $each['bibit_id'])->where('created_at' , '<=' , $each['created_at'])->sum('jumlah');
      $total_tersedia   =  CsrBibitModel::where('bibit_id' , $each['bibit_id'])->where('created_at' , '<=' , $each['created_at'])->sum('jumlah');
      $totalan[$key]['total_tanam'] = $total_tanam;
      $totalan[$key]['total_tersedia'] = $total_tersedia; 
    }
  	
    return view('template.front.gudang' , ["history" => $history , "bibit" => $data , "gudang" => $gudang , "totalan" => $totalan]);
});

Route::get('/corp' , function(){
    $data   =    PerusahaanModel::join('pemilik_usaha' , 'pemilik_usaha.id' , '=' , 'perusahaan.pemilik_usaha_id')
    ->join('jenis_usaha' , 'jenis_usaha.id' , '=' , 'perusahaan.jenis_usaha_id')
    ->select('perusahaan.id as perusahaan_id' , 'perusahaan.nama as nama_perusahaan' , 'pemilik_usaha.nama as nama_pemilik'  , 'perusahaan.logo' , 'jenis_usaha.jenis')
    ->get();

    foreach($data as $key => $each){
        $data[$key]->total    =   CsrBibitModel::whereIn('csr_id' , CsrModel::where('perusahaan_id' , $each->perusahaan_id)->select('id')->get())->sum('jumlah');
    }

    $data   =    $data->sortByDesc('total');

    return view('template.front.perusahaan' , ["data" => $data]);
});

Route::get('/dashboard', function () {
    $bibit_masuk   =    CsrBibitModel::join('csr' , 'csr.id' , '=' , 'csr_bibit.csr_id')
    ->groupBy(DB::raw('YEAR(csr.tanggal)'))
    ->groupBy(DB::raw('MONTH(csr.tanggal)'))
    ->select(DB::raw('SUM(csr_bibit.jumlah) AS masuk'))
    ->where(DB::raw('YEAR(csr.tanggal)') , date('Y'))
    ->get();

    $bibitm     =    [];
    foreach($bibit_masuk as $each){
        $bibitm[]   =    $each->masuk;
    }

    $bibit_keluar   =    CsrOutBibitModel::join('csr_out' , 'csr_out.id' , '=' , 'csr_out_bibit.csr_out_id')
    ->groupBy(DB::raw('YEAR(csr_out.tanggal)'))
    ->groupBy(DB::raw('MONTH(csr_out.tanggal)'))
    ->select(DB::raw('SUM(csr_out_bibit.jumlah) AS keluar'))
    ->where(DB::raw('YEAR(csr_out.tanggal)') , date('Y'))
    ->get();

    $bibitk     =    [];
    foreach($bibit_keluar as $each){
        $bibitk[]   =    $each->keluar;
    }


    $bibit  =    BibitModel::select('jenis')->orderBy('id' , 'DESC')->get();

    // hitung jumlah tambang
    $totaltambang    =    TambangModel::all()->count();

    // hitung jumlah perusahaan
    $totalperusahaan     =    PerusahaanModel::all()->count();

    // hitung jumlah CSR bibit group by csr_id
    $totalcsr_bibit  =    CsrBibitModel::select(DB::raw('SUM(jumlah) as total')  , 'csr_id');
    $totalcsr_bibit  =    $totalcsr_bibit->groupBy('csr_id');
    $totalcsr_bibit  =    $totalcsr_bibit->count();

    // hitung jumlah bibit yang ditanam
    $totalbibit_tanam    =    CsrOutBibitModel::select(DB::raw('SUM(jumlah) as total')  , 'csr_out_id')->get();
    $totalbibit_tanam    =    $totalbibit_tanam->toArray();
    $totalbibit_tanam    =    array_sum(array_column($totalbibit_tanam , 'total'));


    $csr_bibit  =    CsrBibitModel::select(DB::raw('SUM(jumlah) as total')  , 'bibit.jenis')
    ->groupBy('bibit_id')
    ->join('bibit' , 'bibit.id' , '=' , 'csr_bibit.bibit_id')
    ->orderBy('bibit_id' , 'DESC')
    ->get();
    
    $b = [];
    $j = [];
    foreach($csr_bibit as $c){
        $b[]    =    $c->jenis;
        $j[]    = $c->total;
    }

    return view('template.default' , [
        "bibit_masuk" => json_encode($bibitm) , 
        "bibit_keluar" => json_encode($bibitk) , 
        "bibit" => json_encode($b) , 
        "jumlah_bibit" => json_encode($j) , 
        "tambang" => TambangModel::all(),
        "totalperusahaan" => $totalperusahaan,
        "totaltambang" => $totaltambang,
        "totalcsr_bibit" => $totalcsr_bibit,
        "totalbibit_tanam" => $totalbibit_tanam
    ]);
})->name('dashboard');

Route::get('/login' , [AuthController::class , 'index'])->name('auth.index');
Route::post('/login/process' , [AuthController::class , 'auth'])->name('auth.process');
Route::get('/logout' , [AuthController::class , 'logout'])->name('auth.logout');


Route::group(['middleware' => ['auth']], function() {
  // uses 'auth' middleware plus all middleware from $middlewareGroups['web']
  Route::get('/users' , [UserController::class , 'index'])->name('users.index');
Route::post('/users/data' , [UserController::class , 'index'])->name('users.data');
Route::get('/users/create' , [UserController::class , 'create'])->name('users.create');
Route::post('/users/store' , [UserController::class , 'store'])->name('users.store');
Route::get('/users/edit/{id}' , [UserController::class  , 'edit'])->name('users.edit');
Route::post('/users/update' , [UserController::class , 'update'])->name('users.update');
Route::get('/users/delete/{id}' , [UserController::class , 'delete'])->name('users.delete');


Route::get('/tambang' , [TambangController::class , 'index'])->name('tambang.index');
Route::post('/tambang/data' , [TambangController::class , 'index'])->name('tambang.data');
Route::get('/tambang/create' , [TambangController::class , 'create'])->name('tambang.create');
Route::post('/tambang/store' , [TambangController::class , 'store'])->name('tambang.store');
Route::get('/tambang/edit/{id}' , [TambangController::class , 'edit'])->name('tambang.edit');
Route::post('/tambang/update' , [TambangController::class , 'update'])->name('tambang.update');
Route::get('/tambang/delete/{id}' , [TambangController::class , 'delete'])->name('tambang.delete');
Route::get('/tambang/delete/foto/{id}' , [TambangController::class , 'delete_foto'])->name('tambang.delete.foto');
Route::get('/tambang/getinfo/{id}' , [TambangController::class , 'getinfo'])->name('tambang.getinfo');

Route::get('/jenis-tambang' , [JenisTambangController::class , 'index'])->name('jenis-tambang.index');
Route::post('/jenis-tambang/data' , [JenisTambangController::class , 'index'])->name('jenis-tambang.data');
Route::get('/jenis-tambang/create' , [JenisTambangController::class , 'create'])->name('jenis-tambang.create');
Route::post('/jenis-tambang/store' , [JenisTambangController::class , 'store'])->name('jenis-tambang.store');
Route::get('/jenis-tambang/edit/{id}' , [JenisTambangController::class , 'edit'])->name('jenis-tambang.edit');
Route::post('/jenis-tambang/update' , [JenisTambangController::class , 'update'])->name('jenis-tambang.update');
Route::get('/jenis-tambang/delete/{id}' , [JenisTambangController::class , 'delete'])->name('jenis-tambang.delete');
Route::get('/jenis-tambang/raw' , [JenisTambangController::class , 'raw'])->name('jenis-tambang.raw');

Route::get('/jenis-usaha' , [JenisUsahaController::class , 'index'])->name('jenis-usaha.index');
Route::post('/jenis-usaha/data' , [JenisUsahaController::class , 'index'])->name('jenis-usaha.data');
Route::get('/jenis-usaha/create' , [JenisUsahaController::class , 'create'])->name('jenis-usaha.create');
Route::post('/jenis-usaha/store' , [JenisUsahaController::class , 'store'])->name('jenis-usaha.store');
Route::get('/jenis-usaha/edit/{id}' , [JenisUsahaController::class , 'edit'])->name('jenis-usaha.edit');
Route::post('/jenis-usaha/update' , [JenisUsahaController::class , 'update'])->name('jenis-usaha.update');
Route::get('/jenis-usaha/delete/{id}' , [JenisUsahaController::class , 'delete'])->name('jenis-usaha.delete');


Route::get('/perusahaan' , [PerusahaanController::class , 'index'])->name('perusahaan.index');
Route::post('/perusahaan/data' , [PerusahaanController::class , 'index'])->name('perusahaan.data');
Route::get('/perusahaan/create' , [PerusahaanController::class , 'create'])->name('perusahaan.create');
Route::post('/perusahaan/store' , [PerusahaanController::class , 'store'])->name('perusahaan.store');
Route::get('/perusahaan/edit/{id}' , [PerusahaanController::class , 'edit'])->name('perusahaan.edit');
Route::post('/perusahaan/update' , [PerusahaanController::class , 'update'])->name('perusahaan.update');
Route::get('/perusahaan/delete/{id}' , [PerusahaanController::class , 'delete'])->name('perusahaan.delete');
Route::get('/perusahaan/delete/logo/{id}' , [PerusahaanController::class , 'delete_logo'])->name('perusahaan.delete.logo');
Route::get('/perusahaan/detail/{id}' , [PerusahaanController::class , 'detail'])->name('perusahaan.detail');

Route::get('/bibit' , [BibitController::class , 'index'])->name('bibit.index');
Route::post('/bibit/data' , [BibitController::class , 'index'])->name('bibit.data');
Route::get('/bibit/create' , [BibitController::class , 'create'])->name('bibit.create');
Route::post('/bibit/store' , [BibitController::class , 'store'])->name('bibit.store');
Route::get('/bibit/edit/{id}' , [BibitController::class , 'edit'])->name('bibit.edit');
Route::post('/bibit/update' , [BibitController::class , 'update'])->name('bibit.update');
Route::get('/bibit/delete/logo/{id}' , [BibitController::class , 'delete_logo'])->name('bibit.delete.logo');
Route::get('/bibit/delete/{id}' , [BibitController::class , 'delete'])->name('bibit.delete');

Route::get('/gudang-bibit' , [GudangBibitController::class , 'index'])->name('gudang-bibit.index');
Route::post('/gudang-bibit/data' , [GudangBibitController::class , 'index'])->name('gudang-bibit.data');
Route::get('/gudang-bibit/create' , [GudangBibitController::class , 'create'])->name('gudang-bibit.create');
Route::post('/gudang-bibit/store' , [GudangBibitController::class , 'store'])->name('gudang-bibit.store');
Route::get('/gudang-bibit/edit/{id}' , [GudangBibitController::class , 'edit'])->name('gudang-bibit.edit');
Route::post('/gudang-bibit/update' , [GudangBibitController::class , 'update'])->name('gudang-bibit.update');
Route::get('/gudang-bibit/delete/{id}' , [GudangBibitController::class , 'delete'])->name('gudang-bibit.delete');

Route::get('/csr/bibit' , [CsrController::class , 'bibit'])->name('csr.bibit.index');
Route::get('/csr/bibit/create' , [CsrController::class , 'bibit_create'])->name('csr.bibit.create');
Route::post('/csr/bibit/store' , [CsrController::class , 'bibit_store'])->name('csr.bibit.store');
Route::get('/csr/bibit/edit/{id}' , [CsrController::class , 'bibit_edit'])->name('csr.bibit.edit');
Route::post('/csr/bibit/daftar/update'  , [CsrController::class , 'bibit_daftar_update'])->name('csr.bibit.daftar.update');
Route::get('/csr/bibit/daftar/delete/{id}' , [CsrController::class , 'bibit_daftar_delete'])->name('csr.bibit.daftar.delete');
Route::get('/csr/bibit/delete/tanda_terima/{id}' , [CsrController::class , 'delete_tanda_terima'])->name('csr.bibit.delete.tanda_terima');
Route::post('/csr/bibit/update' , [CsrController::class , 'bibit_update'])->name('csr.bibit.update');
Route::get('/csr/bibit/delete/{id}' , [CsrController::class , 'bibit_delete'])->name('csr.bibit.delete');
Route::get('/csr/bibit/getinfo/{id}' , [CsrController::class  , 'getinfo'])->name('csr.bibit.getinfo');
Route::get('/csr/bibit/getgudang/{id}/{bibit_id}' , [CsrController::class , 'getgudang'])->name('csr.bibit.getgudang');
Route::get('/csr/bibit/getstock/{csr_id}/{bibit_id}/{gudang_bibit_id}' , [CsrController::class  , 'getstock'])->name('csr.bibit.getstock');

Route::get('/csr/donasi' , [CsrController::class , 'donasi'])->name('csr.donasi.index');
Route::get('/csr/donasi/create' , [CsrController::class , 'donasi_create'])->name('csr.donasi.create');
Route::post('/csr/donasi/store' , [CsrController::class , 'donasi_store'])->name('csr.donasi.store');
Route::get('/csr/donasi/edit/{id}' , [CsrController::class , 'donasi_edit'])->name('csr.donasi.edit');
Route::post('/csr/donasi/update' , [CsrController::class , 'donasi_update'])->name('csr.donasi.update');
Route::get('/csr/donasi/delete/{id}' , [CsrController::class , 'donasi_delete'])->name('csr.donasi.delete');

Route::get('/penggunaan-donasi/kredit' , [PenggunaanDonasiController::class  , 'kredit_index'])->name('penggunaan-donasi.kredit.index');
Route::get('/penggunaan-donasi/kredit/create' , [PenggunaanDonasiController::class , 'kredit_create'])->name('penggunaan-donasi.kredit.create');
Route::get('/penggunaan-donasi/saldo/{id}' , [PenggunaanDonasiController::class , 'saldo'])->name('penggunaan-donasi.saldo');
Route::post('/penggunaan-donasi/kredit/store' , [PenggunaanDonasiController::class , 'kredit_store'])->name('penggunaan-donasi.kredit.store');
Route::get('/penggunaan-donasi/kredit/edit/{id}' , [PenggunaanDonasiController::class , 'kredit_edit'])->name('penggunaan-donasi.kredit.edit');
Route::post('/penggunaan-donasi/kredit/donasi/update' , [PenggunaanDonasiController::class , 'kredit_donasi_update'])->name('penggunaan-donasi.kredit.donasi.update');
Route::get('/penggunaan-donasi/kredit/donasi/delete/{id}' , [PenggunaanDonasiController::class , 'kredit_donasi_delete'])->name('penggunaan-donasi.kredit.donasi.delete');
Route::post('/penggunaan-donasi/kredit/update',[PenggunaanDonasiController::class , 'kredit_update'])->name('penggunaan-donasi.kredit.update');
Route::get('/penggunaan-donasi/kredit/delete/{id}' , [PenggunaanDonasiController::class , 'kredit_delete'])->name('penggunaan-donasi.kredit.delete');

Route::get('/penggunaan-donasi/bibit' , [PenggunaanDonasiController::class , 'bibit_index'])->name('penggunaan-donasi.bibit.index');



Route::get('/penanaman' , [PenanamanController::class , 'index'])->name('penanaman.index');
Route::get('/penanaman/create' , [PenanamanController::class , 'create'])->name('penanaman.create');
Route::post('/penanaman/store' , [PenanamanController::class , 'store'])->name('penanaman.store');
Route::get('/penanaman/edit/{id}' , [PenanamanController::class , 'edit'])->name('penanaman.edit');
Route::get('/penanaman/delete/dokumentasi/{id}' , [PenanamanController::class , 'delete_dokumentasi'])->name('penanaman.dokumentasi.delete');
Route::post('/penanaman/bibit/update' , [PenanamanController::class , 'update_bibit'])->name('penanaman.bibit.update');
Route::get('/penanaman/bibit/delete/{id}' , [PenanamanController::class , 'delete_bibit'])->name('penanaman.bibit.delete');
Route::post('/penanaman/update' , [PenanamanController::class , 'update'])->name('penanaman.update');
Route::get('/penanaman/delete/{id}' , [PenanamanController::class , 'delete'])->name('penanaman.delete');


Route::get('/mitra-bibit' , [BankBibitController::class , 'index'])->name('bank-bibit.index');
Route::get('/mitra-bibit/mutasi/{id}' , [BankBibitController::class , 'mutasi'])->name('bank-bibit.mutasi');


Route::get('/laporan' , [LaporanController::class , 'index'])->name('laporan.index');
Route::post('/laporan/data' , [LaporanController::class , 'data'])->name('laporan.data');
Route::get('/laporan/xls/{modul}/{keyword}/{tanggal}' , [LaporanController::class  , 'xls'])->name('laporan.xls');
});


