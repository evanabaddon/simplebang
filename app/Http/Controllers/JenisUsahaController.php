<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUsahaModel;
use App\Models\PerusahaanModel;
use App\Http\Requests\JenisUsahaStoreRequest;
use App\Http\Requests\JenisUsahaUpdateRequest;
use DataTables;

class JenisUsahaController extends Controller
{
    //
    public function index(Request $request){
      if($request->ajax()){
        $data   =  JenisUsahaModel::all();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href=' . route('jenis-usaha.edit' , $row->id) . '>Edit</a>';
                $btn .= '<a href=' . route('jenis-usaha.delete' , $row->id) . '>Delete</a>';
                return $btn;
            })
            ->addColumn('tanggal' , function($row){
              $btn  =  date('Y-m-d H:i:s' , strtotime($row->created_at));
              return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }

      $jenis_usaha  =  JenisUsahaModel::all();

      return view('jenis-usaha.index' , ["jenis_usaha" => $jenis_usaha]);
    }

    public function create(Request $request){
      return view('jenis-usaha.create');
    }

    public function store(JenisUsahaStoreRequest $request){
      $validator = $request->validated();

      $jenis_usaha  =  new JenisUsahaModel;
      $jenis_usaha->jenis   =  $request->input('jenis');

      if($jenis_usaha->save()){
         return redirect()->route('jenis-usaha.index')->with('success' , 'Berhasil menambahkan jenis usaha.');
      }
      return redirect()->route('jenis_usaha.index')->with('error' , 'Gagal menambahkan jenis usaha.');
    }

    public function edit($id){
      $jenis_usaha  =  JenisUsahaModel::findOrFail($id);

      return view('jenis-usaha.edit' , ["jenis_usaha" => $jenis_usaha]);
    }

    public function update(JenisUsahaUpdateRequest $request){
      $validator  =  $request->validated();
      $jenis_usaha  =  JenisUsahaModel::find($request->input('id'));
      $jenis_usaha->jenis   =  $request->input('jenis');
      if($jenis_usaha->save()){
        return redirect()->route('jenis-usaha.index')->with('success' , 'Berhasil update data jenis usaha.');
      }
      return redirect()->route('jenis-usaha.index')->with('error' , 'Gagal update data jenis usaha.');
    }

    public function delete($id){
      $jenis_usaha  =  JenisUsahaModel::findOrFail($id);
      $cek  =  PerusahaanModel::where('jenis_usaha_id' , $id)->get();
      if(count($cek) == 0){
          if($jenis_usaha->delete()){
            return redirect()->route('jenis-usaha.index')->with('success' , 'Berhasil menghapus data jenis usaha.');
          }
          return redirect()->route('jenis-usaha.index')->with('error' , 'Gagal menghapus data jenis usaha');
      }

      return redirect()->route('jenis-usaha.index')->with('error' , 'Gagal menghapus jenis usaha, karena jenis usaha terkait masih digunakan pada data usaha.');
    }
}
