<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\JenisTambangModel;
use App\Http\Requests\JenisTambangStoreRequest;
use App\Http\Requests\JenisTambangUpdateRequest;
use App\Models\TambangModel;

class JenisTambangController extends Controller
{
    //
    public function index(Request $request){
      $data   =  JenisTambangModel::all();
      if($request->ajax()){

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href=' . route('jenis-tambang.edit' , $row->id) . '>Edit</a>';
                $btn .= '<a href=' . route('jenis-tambang.delete' , $row->id) . '>Delete</a>';
                return $btn;
            })
            ->addColumn('tanggal' , function($row){
              $btn  =  date('Y-m-d H:i:s' , strtotime($row->created_at));
              return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }

      return view('jenis-tambang.index' , ['jenis_tambang' => $data]);
    }

    public function raw(Request $request){
      $data   =  JenisTambangModel::all();
      return view('jenis-tambang.raw' , ['jenis_tambang' => $data]);
    }

    public function create(Request $request){
      return view('jenis-tambang.create');
    }

    public function store(JenisTambangStoreRequest $request){
      $validator = $request->validated();

      $jenis_tambang  =  new JenisTambangModel;
      $jenis_tambang->jenis   =  $request->input('jenis');

      if($jenis_tambang->save()){
        return redirect()->route('jenis-tambang.index')->with('success' , 'Berhasil menambahkan jenis tambang.');
      }

      return redirect()->route('jenis-tambang.index')->with('error' , 'Gagal menambahkan jenis tambang.');
    }

    public function edit($id){
      $jenis_tambang  =  JenisTambangModel::findOrFail($id);

      return view('jenis-tambang.edit' , ["jenis_tambang" => $jenis_tambang]);
    }

    public function update(JenisTambangUpdateRequest $request){
      $validator = $request->validated();

      $jenis_tambang  =  JenisTambangModel::find($request->id);
      $jenis_tambang->jenis   =  $request->input('jenis');

      if($jenis_tambang->save()){
        return redirect()->route('jenis-tambang.index')->with('success' , 'Berhasil update jenis tambang.');
      }

      return redirect()->route('jenis-tambang.index')->with('error' , 'Gagal update jenis tambang.');
    }

    public function delete($id){
      $cek  =  TambangModel::where('jenis_tambang_id' , $id)->get();
      if(count($cek) == 0){
          $jenis_tambang  =  JenisTambangModel::find($id);
          if($jenis_tambang->delete()){
            return redirect()->route('jenis-tambang.index')->with('success' , 'Berhasil menghapus jenis tambang.');
          }
          return redirect()->route('jenis-tambang.index')->with('error' , 'Gagal menghapus jenis tambang.');
      }

      return redirect()->route('jenis-tambang.index')->with('error' , 'Gagal menghapus jenis tambang, karena masih digunakan pada data tambang.');
    }
}
