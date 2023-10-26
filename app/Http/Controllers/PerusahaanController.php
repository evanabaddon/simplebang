<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\PerusahaanViewModel;
use App\Models\JenisUsahaModel;
use App\Models\CsrModel;
use App\Http\Requests\PerusahaanStoreRequest;
use App\Http\Requests\PerusahaanUpdateRequest;
use App\Models\PemilikUsahaModel;
use App\Models\PerusahaanModel;
use Image;

class PerusahaanController extends Controller
{
  public function index(Request $request){
    $data   =  PerusahaanViewModel::all();
    if($request->ajax()){

      return Datatables::of($data)->addIndexColumn()
          ->addColumn('action', function($row){

              $btn = '<a href=' . route('perusahaan.edit' , $row->id) . '>Edit</a>';
              $btn .= '<a href=' . route('perusahaan.delete' , $row->id) . '>Delete</a>';
              return $btn;
          })
          ->addColumn('logo' , function($row){
            $logo   =  "<img src='/img/default.png' width=150>";
             if(file_exists(public_path() . $row->logo) && $row->logo != NULL){
                $logo   =  "<img src='" . $row->logo . "'>";
             }

             return $logo;
          })
          ->addColumn('tanggal' , function($row){
            $btn  =  date('Y-m-d H:i:s' , strtotime($row->created_at));
            return $btn;
          })
          ->rawColumns(['action' , 'logo'])
          ->make(true);
    }

    return view('perusahaan.index' , ["perusahaan" => $data ]);
  }

  public function create(Request $request){
    $jenis_usaha  =  JenisUsahaModel::all();
    return view('perusahaan.create' , ["jenis_usaha" => $jenis_usaha]);
  }

  public function detail($id){
    $perusahaan   =  PerusahaanModel::findOrFail($id);
    $pemilik  =  PemilikUsahaModel::findOrFail($perusahaan->pemilik_usaha_id);
    $jenis_usaha  =  JenisUsahaModel::findOrFail($perusahaan->jenis_usaha_id);

    return view('perusahaan.detail' , [
      'perusahaan' => $perusahaan,
      'pemilik' => $pemilik,
      'jenis_usaha' => $jenis_usaha
    ]);
  }

  public function store(PerusahaanStoreRequest $request){
    $validator = $request->validated();

    $pemilik_usaha  =  new PemilikUsahaModel;
    $pemilik_usaha->nama  =  $request->input('nama_pemilik');
    $pemilik_usaha->alamat = $request->input('alamat_pemilik');
    $pemilik_usaha->email   =  $request->input('email_pemilik');
    $pemilik_usaha->no_telepon  =  $request->input('telepon_pemilik');

    if($pemilik_usaha->save()){
      $perusahaan   =  new PerusahaanModel;
      $perusahaan->pemilik_usaha_id   =  $pemilik_usaha->id;
      $perusahaan->jenis_usaha_id   =  $request->input('jenis_usaha_id');
      $perusahaan->nama   =  $request->input('nama');
      $perusahaan->alamat   =  $request->input('alamat');
      $perusahaan->email  =  $request->input('email');
      $perusahaan->no_telepon   =  $request->input('no_telepon');
      if($request->file('logo')){
        $image = $request->file('logo');
        $logo = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img/logo_perusahaan');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
    		    $constraint->aspectRatio();
    		})->save($destinationPath.'/'.$logo);
        $perusahaan->logo   =  "/img/logo_perusahaan/" . $logo;
      }
      if($perusahaan->save()){
        return redirect()->route('perusahaan.index')->with('success' , 'Berhasil menambahkan data perusahaan.');
      }
      return redirect()->route('perusahaan.index')->with('error' , 'Gagal menambahkan data perusahaan.');
    }
    return redirect()->route('perusahaan.index')->with('error' , 'Gagal menambahkan data pemilik perusahaan.');
  }

  public function edit($id){
     $perusahaan  =  PerusahaanModel::findOrFail($id);
     $pemilik_usaha  =  PemilikUsahaModel::findOrFail($perusahaan->pemilik_usaha_id);
     $jenis_usaha  = JenisUsahaModel::all();

     return view('perusahaan.edit' , ["perusahaan" => $perusahaan , "pemilik_usaha" => $pemilik_usaha , "jenis_usaha" => $jenis_usaha]);
  }

  public function update(PerusahaanUpdateRequest $request){
    $validator  =  $request->validated();
    $perusahaan   =  PerusahaanModel::find($request->input('id'));
    $perusahaan->jenis_usaha_id   =  $request->input('jenis_usaha_id');
    $perusahaan->nama   =  $request->input('nama');
    $perusahaan->alamat   =  $request->input('alamat');
    $perusahaan->email  =  $request->input('email');
    $perusahaan->no_telepon   =  $request->input('no_telepon');
    if($request->file('logo')){
      if(file_exists(public_path() . $perusahaan->logo) && $perusahaan->logo != NULL){
        unlink(public_path() . $perusahaan->logo);
      }
      $image = $request->file('logo');
      $logo = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/img/logo_perusahaan');
      $imgFile = Image::make($image->getRealPath());
      $imgFile->resize(150, 150, function ($constraint) {
  		    $constraint->aspectRatio();
  		})->save($destinationPath.'/'.$logo);
      $perusahaan->logo   =  "/img/logo_perusahaan/" . $logo;
    }
    if($perusahaan->save()){
      $pemilik_usaha  =  PemilikUsahaModel::find($perusahaan->pemilik_usaha_id);
      $pemilik_usaha->nama  =  $request->input('nama_pemilik');
      $pemilik_usaha->alamat = $request->input('alamat_pemilik');
      $pemilik_usaha->email   =  $request->input('email_pemilik');
      $pemilik_usaha->no_telepon  =  $request->input('telepon_pemilik');
      if($pemilik_usaha->save()){
        return redirect()->route('perusahaan.index')->with('success' , 'Berhasil update data perusahaan.');
      }
      return redirect()->route('perusahaan.index')->with('error' , 'Gagal update data pemilik perusahaan');
    }
    return redirect()->route('perusahaan.index')->with('error' , 'Gagal update data perusahaan.');
  }

  public function delete($id){
    $perusahaan   =  PerusahaanModel::findOrFail($id);
    $pemilik_usaha  = PemilikUsahaModel::findOrFail($perusahaan->pemilik_usaha_id);

    $cek  =  CsrModel::where('perusahaan_id' , $perusahaan->id)->get();
    if(count($cek) == 0){
        if($pemilik_usaha->delete() && $perusahaan->delete()){
          return redirect()->route('perusahaan.index')->with('success' , 'Berhasil menghapus data perusahaan.');
        }
        return redirect()->route('perusahaan.index')->with('error' , 'Gagal menghapus data perusahaan.');
    }
    return redirect()->route('perusahaan.index')->with('error' , 'Gagal menghapus data perusahaan karena sedang digunakan pada data CSR');
  }

  public function delete_logo($id){
    $perusahaan   =  PerusahaanModel::findOrFail($id);
    if(file_exists(public_path() . $perusahaan->logo) && $perusahaan->logo != NULL){
      unlink(public_path() . $perusahaan->logo);
    }
    $perusahaan->logo   =  NULL;
    if(!$perusahaan->save()){
      return back()->with('error' , 'Gagal menghapus logo.');
    }
    return back();
  }
}
