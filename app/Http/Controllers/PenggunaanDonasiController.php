<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsrModel;
use App\Models\PerusahaanModel;
use App\Models\JenisCsrModel;
use App\Models\BibitModel;
use App\Models\GudangBibitModel;
use App\Models\CsrBibitModel;
use App\Models\CsrOutBibitModel;
use App\Models\CsrDonasiModel;
use App\Models\CsrOutDonasiModel;
use App\Models\CsrOutDonasiBibitModel;
use App\Models\CsrOutDonasiKreditModel;
use App\Http\Requests\DonasiKreditStoreRequest;
use App\Http\Requests\CsrOutDonasiKreditDonasiUpdateRequest;
use App\Http\Requests\DonasiKreditUpdateRequest;
use DB;

class PenggunaanDonasiController extends Controller
{
    //
    public function kredit_index(Request $request){
      $data   =  CsrOutDonasiModel::where('csr_out_donasi.jenis' , '2')
      ->get();

      foreach($data as $key => $val){
          $data[$key]->total  =  CsrOutDonasiKreditModel::where('csr_out_donasi_id' , $val->id)->sum('jumlah');
      }



      $total  =  CsrDonasiModel::all()->sum('jumlah');
      $kredit   =  CsrOutDonasiModel::where('jenis' , '2')->sum('total');

      $kreditBibit  = CsrOutDonasiModel::where('jenis' , '1')->sum('total');

      $saldo  =  $total - ($kredit + $kreditBibit);

      return view('penggunaan-donasi.kredit.index'  , ["data" => $data , 'total' => $total , 'kredit' => $kredit , 'kredit_bibit' => $kreditBibit , 'saldo' => $saldo]);
    }

    public function kredit_create(Request $request){
      $bibit  =  BibitModel::all();
      $perusahaan   =  PerusahaanModel::all();
      $gudang_bibit   =  GudangBibitModel::all();
      #echo "<pre>";
      $csr  =  CsrModel::where('jenis_csr_id' , 2)->get();
      #print_r($csr);die();
      return view('penggunaan-donasi.kredit.create' , ['csr' => $csr , 'bibit' => $bibit , 'perusahaan' => $perusahaan , 'gudang_bibit' => $gudang_bibit]);
    }

    public function saldo($id){
      $csr  =  CsrModel::findOrFail($id);
      $donasi   =  CsrDonasiModel::where('csr_id' , $id)->first();
      $total_donasi_bibit   =  CsrOutDonasiBibitModel::where('csr_id' , $id)->sum('jumlah_donasi');
      $total_donasi_kredit  =  CsrOutDonasiKreditModel::where('csr_id' , $id)->sum('jumlah');

      $saldo  =  $donasi->jumlah - ($total_donasi_bibit + $total_donasi_kredit);
      return response()->json(['saldo' => number_format($saldo,0,',','.') ]);
    }

    private function cek($csr_id , $total){
      $donasi   =  CsrDonasiModel::where('csr_id' , $csr_id)->first();
      $totalKreditBibit  =  CsrOutDonasiBibitModel::where('csr_id' , $csr_id)->sum('jumlah_donasi');
      $totalKredit  =  CsrOutDonasiKreditModel::where('csr_id' , $csr_id)->sum('jumlah');

      return ($donasi->jumlah - ($totalKreditBibit + $totalKredit + $total)) >= 0;
    }

    public function kredit_store(DonasiKreditStoreRequest $request){

      $request->validated();
      foreach(array_unique($request->input('donasi')['csr_id']) as $each){
        $total  =  array_sum($request->input('total')['jumlah'][$each]);
        if(!$this->cek($each,$total)){
            $csr  =  CsrModel::findOrFail($each);
            return back()->withErrors(['Penggunaan donasi ' . $csr->judul . ' telah melebihi limit, periksa kembali nominal yang anda input.']);
        }
      }

      if(count($request->input('donasi')['csr_id']) != count($request->input('donasi')['jumlah']) || count($request->input('donasi')['jumlah']) != count($request->input('donasi')['keterangan']))
            return back()->withErrors(['Data tidak valid.']);

      $total_kredit   =  array_sum($request->input('donasi')['jumlah']);

      $donasi   =  new CsrOutDonasiModel;
      $donasi->judul  =  $request->input('judul');
      $donasi->jenis  =  2;
      $donasi->total  =  $total_kredit;
      $donasi->catatan  =  $request->input('catatan');

      if(!$donasi->save())
        return redirect()->route('penggunaan-donasi.kredit.index')->with('error' , 'Gagal menambahkan penggunaan donasi.');

      foreach($request->input('donasi')['csr_id'] as $key => $value){
          $kredit   =  new CsrOutDonasiKreditModel;
          $kredit->csr_out_donasi_id  =  $donasi->id;
          $kredit->csr_id   =  $value;
          $kredit->jumlah   = $request->input('donasi')['jumlah'][$key];
          $kredit->keterangan =    $request->input('donasi')['keterangan'][$key];
          if(!$kredit->save())
            return redirect()->route('penggunaan-donasi.kredit.index')->with('error' , 'Gagal menambahkan penggunaan kredit.');
      }

      return redirect()->route('penggunaan-donasi.kredit.index')->with('success' , 'Berhasil menambahkan penggunaan donasi.');
    }

    public function kredit_edit($id){

      $donasi   =  CsrOutDonasiModel::findOrFail($id);
      if($donasi->jenis != 2){
        return back();
      }
      $perusahaan   =  PerusahaanModel::all();
      $csr  =  CsrModel::where('jenis_csr_id' , 2)->get();
      $kredit   =  CsrOutDonasiKreditModel::where('csr_out_donasi_id' , $donasi->id)
      ->join('csr' , 'csr.id' , '=' , 'csr_out_donasi_kredit.csr_id')
      ->select('csr.id as csr_id' , 'csr.judul' , 'csr_out_donasi_kredit.*')
      ->get();

      return view('penggunaan-donasi.kredit.edit' , ['csr' => $csr ,  'perusahaan' => $perusahaan , "donasi" => $donasi , "kredit" => $kredit ]);
    }

    public function kredit_donasi_update(CsrOutDonasiKreditDonasiUpdateRequest $request){
        $request->validated();
        $total  =  CsrDonasiModel::where('csr_id' , $request->csr_id)->first();
        $kredit   =  CsrOutDonasiKreditModel::where('csr_id' , $request->csr_id)->where('id' , '!=' , $request->id)->sum('jumlah');
        $bibit  = CsrOutDonasiBibitModel::where('csr_id' , $request->csr_id)->sum('jumlah_donasi');
        $csr  =  CsrModel::findOrFail($request->csr_id);
        $saldo  =  $total->jumlah - ($kredit + $bibit );

        if($request->jumlah > $saldo){
            return back()->withErrors(['Penggunaan donasi ' . $csr->judul . ' telah melebihi limit, periksa kembali nominal yang anda input.']);
        }

        $kredit   =  CsrOutDonasiKreditModel::findOrFail($request->id);
        $old_jumlah   =  $kredit->jumlah;
        $kredit->csr_id = $request->csr_id;
        $kredit->jumlah =  $request->jumlah;
        $kredit->keterangan = $request->keterangan;
        if(!$kredit->save())
          return back()->withErrors(['Gagal update kredit donasi.']);


        $donasi   =  CsrOutDonasiModel::findOrFail($kredit->csr_out_donasi_id);
        $donasi->total =    $donasi->total - $old_jumlah + $request->jumlah;
        $donasi->save();

        if(!$donasi->save())
          return back()->withErrors(['Gagal update kredit donasi.']);

        return back()->withSuccess(['Berhasil update kredit donasi.']);
    }

    public function kredit_update(DonasiKreditUpdateRequest $request){
      $request->validated();
      $donasi   =  CsrOutDonasiModel::findOrFail($request->id);
      if($donasi->jenis != 2){
        return back();
      }
      $donasi->judul  =  $request->input('judul');
      $donasi->jenis  =  2;

      $donasi->catatan  =  $request->input('catatan');
      if($request->donasi && $request->total){
        foreach(array_unique($request->input('donasi')['csr_id']) as $each){
          $total  =  array_sum($request->input('total')['jumlah'][$each]);
          if(!$this->cek($each,$total)){
              $csr  =  CsrModel::findOrFail($each);
              return back()->withErrors(['Penggunaan donasi ' . $csr->judul . ' telah melebihi limit, periksa kembali nominal yang anda input.']);
          }
        }

        if(count($request->input('donasi')['csr_id']) != count($request->input('donasi')['jumlah']) || count($request->input('donasi')['jumlah']) != count($request->input('donasi')['keterangan']))
              return back()->withErrors(['Data tidak valid.']);

        $total_kredit   =  array_sum($request->input('donasi')['jumlah']);
        $donasi->total  =  $donasi->total + $total_kredit;

        foreach($request->input('donasi')['csr_id'] as $key => $value){
            $kredit   =  new CsrOutDonasiKreditModel;
            $kredit->csr_out_donasi_id  =  $donasi->id;
            $kredit->csr_id   =  $value;
            $kredit->jumlah   = $request->input('donasi')['jumlah'][$key];
            $kredit->keterangan =    $request->input('donasi')['keterangan'][$key];
            if(!$kredit->save())
              return redirect()->route('penggunaan-donasi.kredit.index')->with('error' , 'Gagal menambahkan penggunaan kredit.');
        }
      }

      if(!$donasi->save())
        return redirect()->route('penggunaan-donasi.kredit.index')->with('error' , 'Gagal menambahkan penggunaan donasi.');

      return redirect()->route('penggunaan-donasi.kredit.index')->with('success' , 'Berhasil menambahkan penggunaan donasi.');
    }

    public function kredit_donasi_delete($id){
        $kredit   =  CsroutDonasiKreditModel::findOrFail($id);
        $donasi   =  CsrOutDonasiModel::findOrFail($kredit->csr_out_donasi_id);
        $donasi->total  =  $donasi->total - $kredit->jumlah;

        if(!$donasi->save())
            return back()->withErrors(['Gagal update total kredit donasi.']);

        if(!$kredit->delete())
          return back()->withErrors('Gagal menghapus kredit donasi');

        return back();
    }

    public function kredit_delete($id){
      $donasi   =  CsrOutDonasiModel::findOrFail($id);
      if($donasi->jenis != '2'){
          return back();
      }

      $kredit   =  CsrOutDonasiKreditModel::where('csr_out_donasi_id' , $donasi->id);

      if(!$kredit->delete() || !$donasi->delete())
        return redirect()->route('penggunaan-donasi.kredit.index')->with('error' , 'Gagal menghapus penggunaan donasi.');

      return redirect()->route('penggunaan-donasi.kredit.index')->with('success' , 'Berhasil menghapus penggunaan donasi.');
    }


    ///// BIBIT

    public function bibit_index(Request $request){
      $data   =  CsrOutDonasiModel::where('csr_out_donasi.jenis' , '1')
      ->get();

      foreach($data as $key => $val){
          $data[$key]->total  =  CsrOutDonasiBibitModel::where('csr_out_donasi_id' , $val->id)->sum('jumlah');
      }



      $total  =  CsrDonasiModel::all()->sum('jumlah');
      $kredit   =  CsrOutDonasiModel::where('jenis' , '2')->sum('total');

      $kreditBibit  = CsrOutDonasiModel::where('jenis' , '1')->sum('total');

      $saldo  =  $total - ($kredit + $kreditBibit);

      return view('penggunaan-donasi.bibit.index'  , ["data" => $data , 'total' => $total , 'kredit' => $kredit , 'kredit_bibit' => $kreditBibit , 'saldo' => $saldo]);
    }
}
