<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\BibitModel;
use App\Models\CsrBibitModel;
use App\Models\CsrOutBibitModel;
use App\Models\CsrOutDonasiModel;
use App\Http\Requests\BibitStoreRequest;
use App\Http\Requests\BibitUpdateRequest;
use App\Models\CsrOutDonasiBibitModel;
use Image;
class BibitController extends Controller
{
    public function index(Request $request){
      if($request->ajax()){
        $data   =  BibitModel::all();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href=' . route('bibit.edit' , $row->id) . '>Edit</a>';
                $btn .= '<a href=' . route('bibit.delete' , $row->id) . '>Delete</a>';
                return $btn;
            })
            ->addColumn('tanggal' , function($row){
              $btn  =  date('Y-m-d H:i:s' , strtotime($row->created_at));
              return $btn;
            })
            ->addColumn('logo' , function($row){
              $logo   =  "<img src='/img/default.png' width=150>";
               if(file_exists(public_path() . $row->logo ) && $row->logo != NULL){
                  $logo   =  "<img src='" . $row->logo . "'>";
               }

               return $logo;
            })
            ->rawColumns(['action' , 'logo'])
            ->make(true);
      }

      $bibit  =  BibitModel::all();

      return view('bibit.index' , ["bibit" => $bibit]);
    }

    public function create(Request $request){
      return view('bibit.create');
    }

    public function store(BibitStoreRequest $request){
      $validator  =  $request->validated();
      $bibit  =  new BibitModel;
      $bibit->jenis   =  $request->input('jenis');
      $bibit->harga  =  $request->input('harga');
      if($request->file('logo')){
        $image = $request->file('logo');
        $logo = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img/logo_bibit');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
    		    $constraint->aspectRatio();
    		})->save($destinationPath.'/'.$logo);
        $bibit->logo   =  "/img/logo_bibit/" . $logo;
      }
      if($bibit->save()){
        return redirect()->route('bibit.index')->with('success' , 'Berhasil input data bibit.');
      }
      return redirect()->route('bibit.index')->with('error' , 'Gagal input data bibit.');
    }

    public function edit($id){
      $bibit  =  BibitModel::findOrFail($id);

      return view('bibit.edit' , ["bibit" => $bibit]);
    }

    public function delete_logo($id){
      $bibit  =  BibitModel::findOrFail($id);
      if($bibit->logo != NULL && file_exists(public_path() . $bibit->logo)){
        unlink(public_path() . $bibit->logo);
      }
      $bibit->logo  =  NULL;
      if($bibit->save()){
        return back();
      }
      return back()->with('error' , 'Gagal menghapus logo bibit.');
    }

    public function update(BibitUpdateRequest $request){
      $validator  =  $request->validated();
      $bibit  =  BibitModel::find($request->input('id'));
      $bibit->jenis   =  $request->input('jenis');
      $bibit->harga  =  $request->input('harga');
      if($request->file('logo')){
        if(file_exists(public_path() . $bibit->logo) && $bibit->logo != NULL){
          unlink(public_path() . $bibit->logo);
        }
        $image = $request->file('logo');
        $logo = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img/logo_bibit');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
    		    $constraint->aspectRatio();
    		})->save($destinationPath.'/'.$logo);
        $bibit->logo   =  "/img/logo_bibit/" . $logo;
      }
      if($bibit->save()){
        return redirect()->route('bibit.index')->with('success' , 'Berhasil update data bibit.');
      }
      return redirect()->route('bibit.index')->with('error' , 'Gagal update data bibit.');
    }

    public function delete($id){
      $bibit  =  BibitModel::findOrFail($id);

      $cek_csr_bibit  =  CsrBibitModel::where('bibit_id' , $bibit->id)->get();
      $cek_csr_out_bibit  =  CsrOutBibitModel::where('bibit_id' , $bibit->id)->get();
    //  $cek_csr_out_donasi_bibit   =  CsrOutDonasiBibitModel::where('bibit_id' , $bibit->id)->get();
      //$cek_csr_out_donasi   =  CsrOutDonasiModel::where('bibit_id' , $bibit->id)->get();

      if(count($cek_csr_bibit) == 0 && count($cek_csr_out_bibit) == 0 ){
        if(file_exists(public_path() . $bibit->logo) && $bibit->logo != NULL){
          unlink(public_path() . $bibit->logo);
        }
        $bibit->delete();
        return redirect()->route('bibit.index')->with('success' , 'Berhasil menghapus bibit.');
      }
      return redirect()->route('bibit.index')->with('error' , 'Gagal menghapus bibit karena data bibit sedang digunakan.');
    }
}
