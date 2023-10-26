<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BibitModel;
use App\Models\PerusahaanModel;
use App\Models\GudangBibitModel;
use App\Models\TambangModel;
use App\Models\CsrBibitModel;
use App\Http\Requests\PenanamanStoreRequest;
use App\Models\CsrOutModel;
use App\Models\DokumentasiModel;
use App\Models\CsrOutBibitModel;
use App\Http\Requests\PenanamanBibitUpdateRequest;
use App\Http\Requests\PenanamanUpdateRequest;
use Image;

class PenanamanController extends Controller
{
    //
    private function float2rat($n, $tolerance = 1.e-6) {
            $h1=1; $h2=0;
            $k1=0; $k2=1;
            $b = 1/$n;
            do {
                $b = 1/$b;
                $a = floor($b);
                $aux = $h1; $h1 = $a*$h1+$h2; $h2 = $aux;
                $aux = $k1; $k1 = $a*$k1+$k2; $k2 = $aux;
                $b = $b-$a;
            } while (abs($n-$h1/$k1) > $n*$tolerance);

            return "$h1/$k1";
        }
    public function index(){
        $data   =    CsrOutModel::join('tambang' , 'tambang.id' , '=' , 'csr_out.tambang_id')
        ->select('csr_out.id' , 'csr_out.judul as judul'  , 'tambang.nama as tambang' , 'csr_out.luas as luas_penanaman' , 'tambang.luas')
        ->get();
        foreach($data as $key => $each){
            $data[$key]->list_bibit     =    BibitModel::whereIn('id' , CsrOutBibitModel::where('csr_out_id' , $each->id)->select('bibit_id'))->get();
            $data[$key]->pecahan    =    $this->float2rat($each->luas_penanaman/$each->luas);
            $data[$key]->jumlah_bibit   =    CsrOutBibitModel::where('csr_out_id'  , $each->id)->sum('jumlah');
        }

        $widget     =   [
            "total_bibit" => CsrOutBibitModel::all()->sum('jumlah'),
            "total_tambang_tanam" => CsrOutModel::distinct('tambang_id')->count('tambang_id'),
            "total_luas" => TambangModel::sum('luas'),
            "total_luas_tanam" => CsrOutModel::sum('luas')
        ];
        

        return view('penanaman.index' , ["data" => $data , "widget" => $widget]);
    }

    public function create(){

        $bibit  =  BibitModel::whereIn('id' , CsrBibitModel::select('bibit_id')->groupBy('bibit_id'))->get();
        $perusahaan   =  PerusahaanModel::all();
        $gudang_bibit   =  GudangBibitModel::all();
        $tambang    =    TambangModel::all();
        return view('penanaman.create' , ["bibit" => $bibit , "perusahaan" => $perusahaan , "gudang_bibit" => $gudang_bibit , "tambang" => $tambang]);
    }

    public function store(PenanamanStoreRequest $request){
        $request->validated();
        $total_bibit    =   count($request->bibit_id);
        $total_csr  =    count($request->csr_id);
        $total_gudang   =    count($request->gudang_bibit);
        $total_jumlah   =    count($request->jumlah);

        if($total_bibit != $total_csr || $total_bibit != $total_gudang || $total_bibit != $total_jumlah || $total_csr != $total_gudang || $total_csr != $total_jumlah || $total_gudang != $total_jumlah)
            return back()->withErrors(['Data bibit pohon tidak valid']);

        foreach($request->bibit_id as $key => $each){
             $total     =    CsrBibitModel::where('csr_id' , $request->csr_id[$key])->where('bibit_id' , $request->bibit_id[$key])->where('gudang_bibit_id' , $request->gudang_bibit[$key])->sum('jumlah');
             $tertanam  =    CsrOutBibitModel::where('csr_bibit_id' , $request->csr_id[$key])->where('bibit_id' , $request->bibit_id[$key])->where('gudang_bibit_id' , $request->gudang_bibit[$key])->sum('jumlah');

             if($request->jumlah[$key] > ($total - $tertanam))
                return back()->withErrors(['Stock bibit kurang.']);
                 
        }

        $luas_tambang   =    TambangModel::findOrFail($request->tambang_id);
        $luas_tanam     =    CsrOutModel::where('tambang_id' , $request->tambang_id)->sum('luas');

        if($request->luas > ($luas_tambang->luas - $luas_tanam))
            return back()->withErrors(['Area penanaman melebihi area yang tersedia.']);

            #die();

        $csr_out    =    new CsrOutModel;
        $csr_out->tambang_id = $request->tambang_id;
        $csr_out->judul = $request->judul;
        $csr_out->luas  =    $request->luas;
        $csr_out->tanggal = date('Y-m-d' , strtotime($request->tanggal));

        if(!$csr_out->save())
            return back()->withErrors(['Gagal input penanaman.']);

        if($request->foto){
            foreach($request->foto as $key => $each){
                $dok    =    new DokumentasiModel;
                $dok->csr_out_id = $csr_out->id;
                $file = time() . "_" . $key .'.' .$each->getClientOriginalExtension();
                $destinationPath = public_path('/img/penanaman');
                $imgFile = Image::make($each->getRealPath());
                $imgFile->resize(1280, 720, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$file);
                $dok->file   =  "/img/penanaman/" . $file;
                $dok->save();
            }
        }

        foreach($request->bibit_id as $key => $each){
              $csr_out_bibit    =    new CsrOutBibitModel;  
              $csr_out_bibit->csr_out_id = $csr_out->id;
              $csr_out_bibit->csr_bibit_id = $request->csr_id[$key];
              $csr_out_bibit->bibit_id = $request->bibit_id[$key];
              $csr_out_bibit->jumlah    =    $request->jumlah[$key];
              $csr_out_bibit->gudang_bibit_id = $request->gudang_bibit[$key];
              $csr_out_bibit->save();
        } 

        return redirect()->route('penanaman.index')->with("success" , 'Berhasil menambahkan penanaman bibit pohon.');  
    }

    public function edit($id){
        $bibit  =  BibitModel::whereIn('id' , CsrBibitModel::select('bibit_id')->groupBy('bibit_id'))->get();
        $perusahaan   =  PerusahaanModel::all();
        $gudang_bibit   =  GudangBibitModel::all();
        $tambang    =    TambangModel::all();

        $csr_out    =    CsrOutModel::findOrFail($id);

        $csr_out_bibit   =   CsrOutBibitModel::join('csr' , 'csr.id' , '=' , 'csr_out_bibit.csr_bibit_id')
        ->join('bibit' , 'bibit.id' , '=' , 'csr_out_bibit.bibit_id')
        ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_out_bibit.gudang_bibit_id')
        ->where('csr_out_bibit.csr_out_id' , $csr_out->id)
        ->select('csr_out_bibit.id' , 'bibit.jenis' , 'bibit.id as bibit_id' , 'csr.id as csr_id' , 'gudang_bibit.id as gudang_bibit_id' , 'csr_out_bibit.jumlah' , 'csr.judul'  , 'gudang_bibit.nama')
        ->get();

        $dokumentasi    =    DokumentasiModel::where('csr_out_id' , $id)->get();
        
        return view('penanaman.edit' , ["csr_out_bibit" => $csr_out_bibit , "csr_out" => $csr_out , "bibit" => $bibit , "perusahaan" => $perusahaan , "gudang_bibit" => $gudang_bibit , "tambang" => $tambang , 'dokumentasi' => $dokumentasi]);
    }

    public function delete_dokumentasi($id){
        $dok    =    DokumentasiModel::findOrFail($id);
        if(file_exists(public_path() . $dok->file) && $dok->file != NULL ){
            unlink(public_path() . $dok->file);
        }

        $dok->delete();

        return back();
    }

    public function update_bibit(PenanamanBibitUpdateRequest $request){
        $request->validated();

        $csr_out_bibit  =    CsrOutBibitModel::findOrFail($request->id);
        $total_csr      =    CsrBibitModel::where('csr_id' , $csr_out_bibit->csr_bibit_id)->where('bibit_id' , $csr_out_bibit->bibit_id)->where('gudang_bibit_id' , $csr_out_bibit->gudang_bibit_id)->sum('jumlah');
        
        $total_csr_out  =    CsrOutBibitModel::where('csr_bibit_id' , $csr_out_bibit->csr_bibit_id)->where('bibit_id' , $csr_out_bibit->bibit_id)->where('gudang_bibit_id' , $csr_out_bibit->gudang_bibit_id)->sum('jumlah') - $csr_out_bibit->jumlah;


        if($total_csr - ($total_csr_out + $request->jumlah) < 0){
            return back()->withErrors(['Stock bibit kurang.']);
        }

        $csr_out_bibit->jumlah  =    $request->jumlah;

        $csr_out_bibit->save();

        return back();
    }

    public function delete_bibit($id){
        CsrOutBibitModel::findOrFail($id)->delete();
        return back();
    }

    public function update(PenanamanUpdateRequest $request){
        $request->validated();
        if($request->bibit_id && $request->csr_id && $request->gudang_bibit && $request->jumlah){
            $total_bibit    =   count($request->bibit_id);
            $total_csr  =    count($request->csr_id);
            $total_gudang   =    count($request->gudang_bibit);
            $total_jumlah   =    count($request->jumlah);

            if($total_bibit != $total_csr || $total_bibit != $total_gudang || $total_bibit != $total_jumlah || $total_csr != $total_gudang || $total_csr != $total_jumlah || $total_gudang != $total_jumlah)
                return back()->withErrors(['Data bibit pohon tidak valid']);

            foreach($request->bibit_id as $key => $each){
                 $total     =    CsrBibitModel::where('csr_id' , $request->csr_id[$key])->where('bibit_id' , $request->bibit_id[$key])->where('gudang_bibit_id' , $request->gudang_bibit[$key])->sum('jumlah');
                 $tertanam  =    CsrOutBibitModel::where('csr_bibit_id' , $request->csr_id[$key])->where('bibit_id' , $request->bibit_id[$key])->where('gudang_bibit_id' , $request->gudang_bibit[$key])
                 ->where('id' , '!='  , $request->csr_out_id)
                 ->sum('jumlah');

                 if($request->jumlah[$key] > ($total - $tertanam))
                    return back()->withErrors(['Stock bibit kurang.']);
                     
            }
        }

        $luas_tambang   =    TambangModel::findOrFail($request->tambang_id);
        $luas_tanam     =    CsrOutModel::where('tambang_id' , $request->tambang_id)->where('id' , '!=' , $request->csr_out_id)->sum('luas');

        if($request->luas > ($luas_tambang->luas - $luas_tanam))
            return back()->withErrors(['Area penanaman melebihi area yang tersedia.']);

            #die();

        $csr_out    =    CsrOutModel::findOrFail($request->csr_out_id);
        $csr_out->tambang_id = $request->tambang_id;
        $csr_out->judul = $request->judul;
        $csr_out->luas  =    $request->luas;
        $csr_out->tanggal = date('Y-m-d' , strtotime($request->tanggal));

        if(!$csr_out->save())
            return back()->withErrors(['Gagal input penanaman.']);

        if($request->foto){
            foreach($request->foto as $key => $each){
                $dok    =    new DokumentasiModel;
                $dok->csr_out_id = $csr_out->id;
                $file = time() . "_" . $key .'.' .$each->getClientOriginalExtension();
                $destinationPath = public_path('/img/penanaman');
                $imgFile = Image::make($each->getRealPath());
                $imgFile->resize(1280, 720, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$file);
                $dok->file   =  "/img/penanaman/" . $file;
                $dok->save();
            }
        }
        if($request->bibit_id && $request->csr_id && $request->gudang_bibit && $request->jumlah){
            foreach($request->bibit_id as $key => $each){
                  $csr_out_bibit    =    new CsrOutBibitModel;  
                  $csr_out_bibit->csr_out_id = $csr_out->id;
                  $csr_out_bibit->csr_bibit_id = $request->csr_id[$key];
                  $csr_out_bibit->bibit_id = $request->bibit_id[$key];
                  $csr_out_bibit->jumlah    =    $request->jumlah[$key];
                  $csr_out_bibit->gudang_bibit_id = $request->gudang_bibit[$key];
                  $csr_out_bibit->save();
            }   
        }
        
        return redirect()->route('penanaman.index')->with('success' , 'Berhasil memperbarui data penanaman bibit pohon.');
    }

    public function delete($id){
        $csr_out    =    CsrOutModel::findOrFail($id);
        $dokumentasi    =    DokumentasiModel::where('csr_out_id' , $id)->get();
        foreach($dokumentasi as $each){
               if($each->file != "" && file_exists(public_path() . $each->file)){
                    unlink(public_path() . $each->file);
               }
               DokumentasiModel::findOrFail($each->id)->delete(); 
        }
        $csr_out_bibit  =    CsrOutBibitModel::where('csr_out_id' , $id)->delete();
        $csr_out->delete();

        return redirect()->route('penanaman.index')->with('success' , 'Berhasil menghapus data penanaman bibit pohon.');
    }
}
