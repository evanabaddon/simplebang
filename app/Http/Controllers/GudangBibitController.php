<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GudangBibitModel;
use DataTables;
use App\Http\Requests\GudangBibitStoreRequest;
use App\Http\Requests\GudangBibitUpdateRequest;
use App\Models\CsrBibitModel;
use App\Models\CsrOutBibitModel;
use App\Models\CsrOutDonasiModel;

class GudangBibitController extends Controller
{
    public function index(Request $request){
      if($request->ajax()){
        $data   =  GudangBibitModel::all();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href=' . route('gudang-bibit.edit' , $row->id) . '>Edit</a>';
                $btn .= '<a href=' . route('gudang-bibit.delete' , $row->id) . '>Delete</a>';
                return $btn;
            })
            ->addColumn('tanggal' , function($row){
              $btn  =  date('Y-m-d H:i:s' , strtotime($row->created_at));
              return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      $gudang_bibit   =  GudangBibitModel::all();

      return view('gudang-bibit.index' , ["gudang_bibit" => $gudang_bibit]);
    }

    public function create(Request $request){
      return view('gudang-bibit.create');
    }

    public function store(GudangBibitStoreRequest $request){
      $valid  =  $request->validated();
      $gudang   =  new GudangBibitModel;
      $gudang->nama   =  $request->input('nama');
      $gudang->alamat   =  $request->input('alamat');
      $gudang->pemilik  =  $request->pemilik;
      $gudang->no_telepon   =  $request->input('no_telepon');
      $gudang->lokasi   =  $request->input('latitude') . "," . $request->input('longitude');
      if($gudang->save()){
        return redirect()->route('gudang-bibit.index')->with('success' , 'Berhasil menambahkan gudang bibit.');
      }
      return redirect()->route('gudang-bibit.index')->with('error' , 'Gagal menambahkan gudang bibit.');
    }

    public function edit($id){
      $gudang_bibit   =  GudangBibitModel::findOrFail($id);

      return view('gudang-bibit.edit' , ["gudang_bibit" => $gudang_bibit]);
    }

    public function update(GudangBibitUpdateRequest $request){
      $valid  =  $request->validated();
      $gudang   =  GudangBibitModel::findOrFail($request->input('id'));
      $gudang->nama   =  $request->input('nama');
      $gudang->alamat   =  $request->input('alamat');
      $gudang->pemilik  =  $request->pemilik;
      $gudang->no_telepon   =  $request->input('no_telepon');
      $gudang->lokasi   =  $request->input('latitude') . "," . $request->input('longitude');

      if($gudang->save()){
        return redirect()->route('gudang-bibit.index')->with('success' , 'Berhasil update data gudang bibit.');
      }
      return redirect()->route('gudang-bibit.index')->with('error' , 'Gagal update data gudang bibit.');
    }

    public function delete($id){
      $gudang   =  GudangBibitModel::findOrFail($id);
      $cek_csr_bibit  =  CsrBibitModel::where('gudang_bibit_id' , $id)->get();



      if(count($cek_csr_bibit) == 0){
        if($gudang->delete()){
          return redirect()->route('gudang-bibit.index')->with('success' , 'Berhasil menghapus data gudang bibit.');
        }
        return redirect()->route('gudang-bibit.index')->with('error' , 'Gagal menghapus data gudang bibit.');
      }
      return redirect()->route('gudang-bibit.index')->with('error' , 'Gagal menghapus data gudang bibit, data gunakan masih digunakan pada proses lain.');
    }
}
