<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TambangViewModel;
use App\Models\JenisTambangModel;
use App\Http\Requests\TambangStoreRequest;
use App\Http\Requests\TambangUpdateRequest;
use App\Models\TambangModel;
use App\Models\PemilikTambangModel;
use App\Models\CsrOutModel;
use App\Models\FotoTambangModel;
use DataTables;
use Image;

class TambangController extends Controller
{
    //
    public function index(Request $request){
      $data   =  TambangViewModel::all();
      
      if($request->ajax()){

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href=' . route('tambang.edit' , $row->id) . '>Edit</a>';
                $btn .= '<a href=' . route('tambang.delete' , $row->id) . '>Delete</a>';
                return $btn;
            })
            ->addColumn('tanggal' , function($row){
              $btn  =  date('Y-m-d H:i:s' , strtotime($row->created_at));
              return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }

      foreach($data as $key => $value){
        $data[$key]['foto'] = FotoTambangModel::where('tambang_id' , $value->id)->get();
      }
      return view('tambang.index' , ["tambang" => $data]);
    }

    public function create(Request $request){
      $jenis_tambang  =  JenisTambangModel::all();
      return view('tambang.create' , ["jenis_tambang" => $jenis_tambang]);
    }

    public function store(TambangStoreRequest $request){
      $validator = $request->validated();

      $pemilik_tambang  =  new PemilikTambangModel;
      $pemilik_tambang->nama  =  $request->input('nama_pemilik');
      $pemilik_tambang->alamat  =  $request->input('alamat_pemilik');
      $pemilik_tambang->email   =  $request->input('email_pemilik');
      $pemilik_tambang->no_telepon  =  $request->input('telepon_pemilik');

      if($pemilik_tambang->save()){
        $tambang  =  new TambangModel;
        $tambang->pemilik_tambang_id  =  $pemilik_tambang->id;
        $tambang->jenis_tambang_id  =  $request->input('jenis_tambang_id');
        $tambang->nama  =  $request->input('nama');
        $tambang->alamat  =  $request->input('alamat');
        $tambang->luas  =  $request->input('luas');
        $tamabng->status_lahan  =  $request->input('status_lahan');
        $tambang->lokasi  =  $request->input('latitude') . "," . $request->input('longitude');
        if($tambang->save()){
          if($request->file('foto')){
            $key  =  1;
            foreach($request->file('foto') as $each){
              $image = $each;
              $foto = time() . "_" . $key .'.'.$image->getClientOriginalExtension();
              $destinationPath = public_path('/img/foto_tambang');
              $imgFile = Image::make($image->getRealPath());
              if($imgFile->resize(768, 472, function ($constraint) {
          		    $constraint->aspectRatio();
          		})->save($destinationPath.'/'.$foto)){
                $foto_tambang   =  new FotoTambangModel;
                $foto_tambang->tambang_id   =  $tambang->id;
                $foto_tambang->foto   =  "/img/foto_tambang/" . $foto;
                if(!$foto_tambang->save()){
                  return redirect()->route('tambang.index')->with('error' , 'Gagal menyimpan foto tambang.');
                }
              }else{
                return redirect()->route('tambang.index')->with('error' , 'Gagal upload foto tambang.');
              }
              $key   =   $key+1;
            }
            /**/
          }
            return redirect()->route('tambang.index')->with('success' , 'Berhasil menambahkan tambang.');
        }
        return redirect()->route('tambang.index')->with('error' , 'Gagal menambahkan data barang.');
      }

      return redirect()->route('tambang.index')->with('error' , 'Gagal menambahkan pemilik tambang.');

    }

    public function edit($id){
      $tambang  =  TambangModel::findOrFail($id);
      $pemilik_tambang  =  PemilikTambangModel::findOrFail($tambang->pemilik_tambang_id);
      $jenis_tambang  =  JenisTambangModel::all();
      $foto_tambang   =  FotoTambangModel::where('tambang_id' , $tambang->id)->get();

      return view('tambang.edit' , ["tambang" => $tambang , "pemilik_tambang" => $pemilik_tambang , "jenis_tambang" => $jenis_tambang , "foto_tambang" => $foto_tambang]);
    }

    public function update(TambangUpdateRequest $request){
      $validator = $request->validated();

      $tambang  =  TambangModel::find($request->input('id'));
      $tambang->jenis_tambang_id  =  $request->input('jenis_tambang_id');
      $tambang->nama  =  $request->input('nama');
      $tambang->alamat  =  $request->input('alamat');
      $tambang->luas  =  $request->input('luas');
      $tambang->lokasi  =  $request->input('latitude') . "," . $request->input('longitude');
      $tambang->status_lahan  =  $request->input('status_lahan');

      if($request->file('foto')){
        $key  =  1;
        foreach($request->file('foto') as $each){
          $image = $each;
          $foto = time() . "_" . $key .'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/img/foto_tambang');
          $imgFile = Image::make($image->getRealPath());
          if($imgFile->resize(768, 472, function ($constraint) {
      		    $constraint->aspectRatio();
      		})->save($destinationPath.'/'.$foto)){
            $foto_tambang   =  new FotoTambangModel;
            $foto_tambang->tambang_id   =  $tambang->id;
            $foto_tambang->foto   =  "/img/foto_tambang/" . $foto;
            if(!$foto_tambang->save()){
              return redirect()->route('tambang.index')->with('error' , 'Gagal menyimpan foto tambang.');
            }
          }else{
            return redirect()->route('tambang.index')->with('error' , 'Gagal upload foto tambang.');
          }
          $key   =   $key+1;
        }
        /**/
      }

      if($tambang->save()){
        $pemilik_tambang  =  PemilikTambangModel::find($tambang->pemilik_tambang_id);
        $pemilik_tambang->nama  =  $request->input('nama_pemilik');
        $pemilik_tambang->alamat  =  $request->input('alamat_pemilik');
        $pemilik_tambang->email   =  $request->input('email_pemilik');
        $pemilik_tambang->no_telepon  =  $request->input('telepon_pemilik');

        if($pemilik_tambang->save()){
          return redirect()->route('tambang.index')->with('success' , 'Berhasil update data tambang.');
        }
        return redirect()->route('tambang.index')->with('error' , 'Gagal update data pemilik tambang');
      }

      return redirect()->route('tambang.index')->with('error' , 'Gagal update data tambang.');
    }

    public function delete($id){
      $tambang  =  TambangModel::findOrFail($id);
      $pemilik  =  PemilikTambangModel::findOrFail($tambang->pemilik_tambang_id);
      $cek  =  CsrOutModel::where('tambang_id' , $id)->get();
      if(count($cek) == 0){
        if($tambang->delete() && $pemilik->delete()){
          return redirect()->route('tambang.index')->with('success' , 'Berhasil menghapus data tambang.');
        }
        return redirect()->route('tambang.index')->with('error' , 'Gagal menhapus data tambang.');
      }

      return redirect()->route('tambang.index')->with('error' , 'Tidak dapat menghapus data tambang karena masih digunakan pada data CSR.');
    }

    public function delete_foto($id){
      $foto   =  FotoTambangModel::findOrFail($id);
      if(file_exists(public_path() . $foto->foto) && $foto->foto  != NULL){
        unlink(public_path() . $foto->foto);
      }
      if($foto->delete()){
        return back()->with('success' , 'Berhasil menghapus foto tambang.');
      }
      return back()->with('error' , 'Gagal menghapus foto tambang.');
    }

    public function getinfo($id){
      $tambang = TambangModel::findOrFail($id);
      $tambang->luas_tertanam  = CsrOutModel::where('tambang_id' , $tambang->id)->sum('luas');

      return response()->json($tambang);
    }
}
