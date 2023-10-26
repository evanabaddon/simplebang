<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsrModel;
use App\Models\PerusahaanModel;
use App\Models\JenisCsrModel;
use App\Models\BibitModel;
use App\Http\Requests\CsrStoreRequest;
use App\Models\GudangBibitModel;
use App\Models\CsrBibitModel;
use App\Http\Requests\CsrBibitDaftarUpdateRequest;
use App\Models\CsrOutBibitModel;
use App\Http\Requests\CsrBibitUpdateRequest;
use App\Models\CsrDonasiModel;
use App\Http\Requests\CsrDonasiStoreRequest;
use App\Http\Requests\CsrDonasiUpdateRequest;
use App\Models\CsrOutDonasiModel;
use App\Models\CsrOutDonasiKreditModel;
use App\Models\CsrOutDonasiBibitModel;
use Image;

class CsrController extends Controller
{
    //
    public function index(Request $request){
      #return view('csr.index');
    }

    public function bibit(Request $request){
      $data   =  CsrModel::join('perusahaan' , 'perusahaan.id' , '=' , 'csr.perusahaan_id')
      ->join('jenis_csr' , 'jenis_csr.id' , '=' , 'csr.jenis_csr_id')
      #->join('csr_bibit' , 'csr_bibit.csr_id' , '=' , 'csr.id')
      ->select('csr.id' , 'perusahaan.nama as nama_perusahaan' , 'jenis_csr.jenis as jenis_csr' , 'csr.judul' , 'csr.catatan' , 'csr.tanggal')
      ->where('csr.jenis_csr_id' , 1)
      #->groupBy('csr.id')
      ->get();

      foreach($data as $key => $value){
          $data[$key]->bibit  =  BibitModel::whereIn('id' , CsrBibitModel::where('csr_id' , $value->id)->get('bibit_id'))->get();
          $data[$key]->jumlah_bibit   =  CsrBibitModel::where('csr_id' , $value->id)->sum('jumlah');
      }


      #dd($data);
      return view('csr.bibit.index' , ['data' => $data] );
    }

    public function bibit_create(Request $request){
      $bibit  =  BibitModel::all();
      $perusahaan   =  PerusahaanModel::all();
      $gudang_bibit   =  GudangBibitModel::all();
      return view('csr.bibit.create' , ['bibit' => $bibit , 'perusahaan' => $perusahaan , 'gudang_bibit' => $gudang_bibit]);
    }

    public function bibit_store(CsrStoreRequest $request){
      $valid  =  $request->validated();
      $bibit  =  $request->input('bibit')['jenis'];
      $jumlah   =  $request->input('bibit')['jumlah'];
      $gudang_bibit   =  $request->input('bibit')['gudang_bibit_id'];
      if(count($bibit) != count($jumlah) || count($bibit) != count($gudang_bibit)){
        return back()->withErrors(['Data bibit tidak valid']);
      }

      $csr  =  new CsrModel;
      $csr->perusahaan_id   =  $request->input('perusahaan_id');
      $csr->jenis_csr_id    =  1;
      $csr->judul   =  $request->input('judul');
      if($request->file('tanda_terima')){
        $image = $request->file('tanda_terima');
        $tanda_terima = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img/csr/tanda_terima');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
    		    $constraint->aspectRatio();
    		})->save($destinationPath.'/'.$tanda_terima);
        $csr->tanda_terima   =  "/img/csr/tanda_terima/" . $tanda_terima;
      }
      $csr->tanggal   =  $request->input('tanggal');
      $csr->catatan   =  $request->input('catatan');



      if(!$csr->save()){
        return redirect()->route('csr.bibit.index')->with('error' , 'Gagal input CSR Bibit.');
      }

      foreach($bibit as $key => $value){
          $csr_bibit  =  new CsrBibitModel;
          $csr_bibit->csr_id  =  $csr->id;
          $csr_bibit->bibit_id  =  $bibit[$key];
          $csr_bibit->gudang_bibit_id = $gudang_bibit[$key];
          $csr_bibit->jumlah  =  $jumlah[$key];
          if(!$csr_bibit->save()){
              return back()->withErrors(['Gagal input detail CSR bibit.']);
          }
      }

      return redirect()->route('csr.bibit.index')->with('success' , 'Berhasil menambahkan CSR bibit.');
    }

    public function bibit_edit($id){
        $csr  =  CsrModel::findOrFail($id);

        if($csr->jenis_csr_id != '1'){
          return redirect()->route('csr.donasi.edit' , $csr->id);
        }

        $csr_bibit  = CsrBibitModel::where('csr_id' , $csr->id)
        ->join('bibit' , 'bibit.id' , '=' , 'csr_bibit.bibit_id')
        ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_bibit.gudang_bibit_id')
        ->select('csr_bibit.id as id' , 'bibit.id as bibit_id' , 'bibit.jenis as bibit_jenis' , 'csr_bibit.jumlah as jumlah' , 'gudang_bibit.id as gudang_bibit_id' , 'gudang_bibit.nama as gudang_bibit_nama')
        ->get();
        $bibit  =  BibitModel::all();
        $perusahaan   =  PerusahaanModel::all();
        $gudang_bibit   =  GudangBibitModel::all();

        return view('csr.bibit.edit' , ["csr" => $csr , "csr_bibit" => $csr_bibit , "bibit" => $bibit , "perusahaan" => $perusahaan , "gudang_bibit" => $gudang_bibit]);
    }

    public function bibit_daftar_update(CsrBibitDaftarUpdateRequest $request){
       $valid   =  $request->validated();

       $check   = CsrOutBibitModel::where('csr_bibit_id' , $request->id)->get();

       if(count($check) > 0 ){
          return back()->withErrors(['Bibit CSR telah digunakan dalam kegiatan penanaman.']);
       }

       $csr_bibit   =  CsrBibitModel::findOrFail($request->id);
       $csr_bibit->bibit_id   =  $request->bibit_id;
       $csr_bibit->gudang_bibit_id = $request->gudang_bibit_id;
       $csr_bibit->jumlah =  $request->jumlah;
       if($csr_bibit->save())
          return back()->with('success' , 'Berhasil Update CSR bibit.');

       return back()->withErrors(['Gagal update bibit CSR.']);
    }

    public function bibit_daftar_delete($id){
      $csr_bibit  =  CsrBibitModel::findOrFail($id);
      $check  =  CsrOutBibitModel::where('csr_bibit_id' , $csr_bibit->id)->get();

      if(count($check) > 0){
          return back()->withErrors(['Bibit CSR telah digunakan dalam kegiatan penanaman.']);
      }

      if($csr_bibit->delete())
        return back()->with('success' , 'Berhasil hapus CSR bibit.');

      return back()->with('error' , 'Gagal hapus CSR bibit.');
    }

    public function delete_tanda_terima($id){
        $csr  =  CsrModel::findOrFail($id);

        if($csr->tanda_terima != NULL ){
            if(file_exists(public_path() . $csr->tanda_terima)){
              unlink(public_path() . $csr->tanda_terima);
            }
        }

        $csr->tanda_terima  =  NULL;
        if($csr->save())
          return back()->with('success' , 'Berhasil hapus tanda terima CSR.');

        return back()->with('error' , 'Gagal hapus tanda terima CSR.');

    }

    public function bibit_update(CsrBibitUpdateRequest $request){
      $request->validated();

      $csr  =  CsrModel::findOrFail($request->input('id'));
      if($csr->jenis_csr_id != '1'){
        return redirect()->route('csr.donasi.edit' , $csr->id);
      }
      $csr->perusahaan_id   =  $request->input('perusahaan_id');
      $csr->jenis_csr_id    =  1;
      $csr->judul   =  $request->input('judul');
      if($request->file('tanda_terima')){

        if(file_exists(public_path() . $csr->tanda_terima) && $csr->tanda_terima != NULL){
            unlink(public_path() . $csr->tanda_terima);
        }

        $image = $request->file('tanda_terima');
        $tanda_terima = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img/csr/tanda_terima');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
    		    $constraint->aspectRatio();
    		})->save($destinationPath.'/'.$tanda_terima);
        $csr->tanda_terima   =  "/img/csr/tanda_terima/" . $tanda_terima;
      }
      $csr->tanggal   =  $request->input('tanggal');
      $csr->catatan   =  $request->input('catatan');
      $csr->save();

      if($request->bibit){
        $bibit  =  $request->input('bibit')['jenis'];
        $jumlah   =  $request->input('bibit')['jumlah'];
        $gudang_bibit   =  $request->input('bibit')['gudang_bibit_id'];
        if(count($bibit) != count($jumlah) || count($bibit) != count($gudang_bibit)){
          return back()->withErrors(['Data bibit tidak valid']);
        }

        foreach($bibit as $key => $value){
            $cek_bibit  =  CsrBibitModel::where('bibit_id' , $bibit[$key])
            ->where('gudang_bibit_id' , $gudang_bibit[$key])
            ->where('csr_id'  , $csr->id)
            ->get();
            #echo count($cek_bibit) .  $gudang_bibit[$key] . " " . $bibit[$key];die();
            if(count($cek_bibit) > 0)
                return back()->withErrors(['Data bibit sudah ada sebelumnya.']);

            $csr_bibit  =  new CsrBibitModel;
            $csr_bibit->csr_id  =  $csr->id;
            $csr_bibit->bibit_id  =  $bibit[$key];
            $csr_bibit->gudang_bibit_id = $gudang_bibit[$key];
            $csr_bibit->jumlah  =  $jumlah[$key];
            if(!$csr_bibit->save()){
                return back()->withErrors(['Gagal input detail CSR bibit.']);
            }
        }

      }

      if(!$csr->save()){
        return redirect()->route('csr.bibit.index')->with('error' , 'Gagal update CSR Bibit.');
      }
      return redirect()->route('csr.bibit.index')->with('success' , 'Berhasil update CSR bibit.');
    }

    public function bibit_delete($id){
        $csr  =  CsrModel::findOrFail($id);
        if($csr->jenis_csr_id != '1'){
            return redirect()->route('csr.donasi.delete' , $csr->id);
        }
        $csr_bibit  =  CsrBibitModel::where('csr_id' , $csr->id)->get();

        foreach($csr_bibit as $each){
            $cek  =  CsrOutBibitModel::where('csr_bibit_id' , $each->id)->get();
            if(count($cek) > 0 )
                return redirect()->route('csr.bibit.index')->with('error' , 'CSR tidak dapat dihapus karena sudah ditanam.');
        }

        foreach($csr_bibit as $each){
            $delete   =  CsrBibitModel::findOrFail($each->id);
            if(!$delete->delete())
              return redirect()->route('csr.bibit.index')->with('error' , 'Gagal menghapus bibit CSR.');
        }

        if(file_exists(public_path() . $csr->tanda_terima) && $csr->tanda_terima != NULL){
            unlink(public_path() . $csr->tanda_terima);
        }

        if($csr->delete())
          return redirect()->route('csr.bibit.index')->with('success' , 'Berhasil menghapus data CSR.');

        return redirect()->route('csr.bibit.index')->with('error' , 'Gagal menghapus data CSR.');
    }

    public function donasi(Request $request){
        $data   =  CsrModel::join('perusahaan' , 'perusahaan.id' , '=' , 'csr.perusahaan_id')
        ->join('jenis_csr' , 'jenis_csr.id' , '=' , 'csr.jenis_csr_id')
        ->select('csr.id' , 'perusahaan.nama as nama_perusahaan' , 'jenis_csr.jenis as jenis_csr' , 'csr.judul' , 'csr.catatan' , 'csr.tanggal')
        ->where('csr.jenis_csr_id' , 2)

        ->get();

        foreach($data as $key => $value){
            $data[$key]->donasi  =  CsrDonasiModel::where('csr_id' , $value->id)->first();
        }


        #dd($data);
        return view('csr.donasi.index' , ['data' => $data] );
    }

    public function donasi_create(Request $request){
      $bibit  =  BibitModel::all();
      $perusahaan   =  PerusahaanModel::all();
      $gudang_bibit   =  GudangBibitModel::all();
      return view('csr.donasi.create' , ['bibit' => $bibit , 'perusahaan' => $perusahaan , 'gudang_bibit' => $gudang_bibit]);
    }

    public function donasi_store(CsrDonasiStoreRequest  $request){
      $valid  =  $request->validated();

      $csr  =  new CsrModel;
      $csr->perusahaan_id   =  $request->input('perusahaan_id');
      $csr->jenis_csr_id    =  2;
      $csr->judul   =  $request->input('judul');
      if($request->file('tanda_terima')){
        $image = $request->file('tanda_terima');
        $tanda_terima = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img/csr/tanda_terima/donasi');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
    		    $constraint->aspectRatio();
    		})->save($destinationPath.'/'.$tanda_terima);
        $csr->tanda_terima   =  "/img/csr/tanda_terima/donasi/" . $tanda_terima;
      }
      $csr->tanggal   =  $request->input('tanggal');
      $csr->catatan   =  $request->input('catatan');



      if(!$csr->save()){
        return redirect()->route('csr.donasi.index')->with('error' , 'Gagal menambahkan CSR donasi.');
      }

      $donasi   =  new CsrDonasiModel;
      $donasi->csr_id   =  $csr->id;
      $donasi->jumlah   =  $request->input('jumlah');
      if(!$donasi->save())
        return redirect()->route('csr.donasi.index')->with('error' , 'Gagal menambahkan donasi.');

      return redirect()->route('csr.donasi.index')->with('success' , 'Berhasil menambahkan CSR donasi');
    }

    public function donasi_edit($id){
      $csr  =  CsrModel::findOrFail($id);
      if($csr->jenis_csr_id != '2'){
          return redirect()->route('csr.bibit.edit' , $csr->id);
      }
      $perusahaan   =  PerusahaanModel::all();
      $donasi   =  CsrDonasiModel::where('csr_id' , $csr->id)->first();

      return view('csr.donasi.edit' , ["csr" => $csr , "perusahaan" => $perusahaan , "donasi" => $donasi]);
    }

    public function donasi_update(CsrDonasiUpdateRequest $request){
      $valid  =  $request->validated();

      $csr  =  CsrModel::findOrFail($request->input('id'));
      if($csr->jenis_csr_id != '2'){
        return redirect()->route('csr.bibit.edit' , $csr->id);
      }
      $csr->perusahaan_id   =  $request->input('perusahaan_id');
      $csr->jenis_csr_id    =  2;
      $csr->judul   =  $request->input('judul');
      if($request->file('tanda_terima')){

        if(file_exists(public_path() . $csr->tanda_terima) && $csr->tanda_terima != NULL){
            unlink(public_path() . $csr->tanda_terima);
        }

        $image = $request->file('tanda_terima');
        $tanda_terima = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img/csr/tanda_terima/donasi');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
    		    $constraint->aspectRatio();
    		})->save($destinationPath.'/'.$tanda_terima);
        $csr->tanda_terima   =  "/img/csr/tanda_terima/donasi/" . $tanda_terima;
      }
      $csr->tanggal   =  $request->input('tanggal');
      $csr->catatan   =  $request->input('catatan');

      if(!$csr->save()){
          return redirect()->route('csr.donasi.index')->with('error' , 'Gagal update CSR donasi.');
      }

      $donasi   =  CsrDonasiModel::where('csr_id' , $csr->id)->first();

      $cek_bibit  =  CsrOutDonasiBibitModel::where('csr_id' , $csr->id)->get();
      $cek_kredit   =  CsrOutDonasiKreditModel::where('csr_id' , $csr->id)->get();
      if( (count($cek_bibit) > 0 || count($cek_kredit) > 0) && $donasi->jumlah != $request->input('jumlah')){
          return redirect()->route('csr.donasi.index')->with('error' , 'Tidak dapat mengupdate donasi yang telah digunakan');
      }

      $donasi->jumlah  =   $request->input('jumlah');

      if(!$donasi->save())
        return redirect()->route('csr.donasi.index')->with('error' , 'Tidak dapat mengupdate donasi.');

      return redirect()->route('csr.donasi.index')->with('success' , 'Berhasil update CSR donasi.');
    }

    public function donasi_delete($id){
      $csr =  CsrModel::findOrFail($id);

      if($csr->jenis_csr_id != '2')
        return redirect()->route('csr.bibit.delete' , $csr->id);

        $cek_bibit  =  CsrOutDonasiBibitModel::where('csr_id' , $csr->id)->get();
        $cek_kredit   =  CsrOutDonasiKreditModel::where('csr_id' , $csr->id)->get();
      if(count($cek_bibit) > 0 || count($cek_kredit) > 0 )
        return redirect()->route('csr.donasi.index')->with('error' , 'Tidak dapat menghapus donasi yang telah digunakan');

      $donasi   =  CsrDonasiModel::where('csr_id' , $csr->id)->first();

      if(file_exists(public_path() . $csr->tanda_terima)){
          unlink(public_path() . $csr->tanda_terima);
      }

      if(!$donasi->delete() || !$csr->delete())
        return redirect()->route('csr.donasi.index')->with('error' , 'Gagal menhapus CSR donasi.');

      return redirect()->route('csr.donasi.index')->with('success' , 'Berhasil menghapus CSR donasi.');
    }

    public function getinfo($id){
      $csr  =  CsrModel::join('csr_bibit' , 'csr_bibit.csr_id' , '='  , 'csr.id')->where('csr_bibit.bibit_id' , $id)->groupBy('csr.id')
      ->select('csr.id as id' , 'csr.judul as judul')
      ->get();
      return response()->json($csr);
    }

    public function getgudang($id , $bibit_id){
        $gudang   =  GudangBibitModel::join('csr_bibit' ,  'csr_bibit.gudang_bibit_id' , '=' , 'gudang_bibit.id' )
        ->where('csr_bibit.csr_id' , $id)
        ->where('csr_bibit.bibit_id'  , $bibit_id)
        ->select('gudang_bibit.id as id' , 'gudang_bibit.nama as nama')
        ->get();

        return response()->json($gudang);
    }

    public function getstock($csr_id , $bibit_id , $gudang_bibit_id){
        $stock  =  CsrBibitModel::where('csr_id' , $csr_id )->where('bibit_id' , $bibit_id)->where('gudang_bibit_id' , $gudang_bibit_id)->first();

        #echo $stock->csr_id;die();
        $stock->jumlah_tertanam   =  CsrOutBibitModel::where('csr_bibit_id' , $stock->csr_id)->where('bibit_id' , $bibit_id)->where('gudang_bibit_id' , $gudang_bibit_id)->sum('jumlah');
        return response()->json($stock);
    }
}
