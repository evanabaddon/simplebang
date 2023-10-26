<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BibitModel;
use App\Models\CsrBibitModel;
use App\Models\CsrOutBibitModel;
use DB;
use App\Models\GudangBibitModel;


class BankBibitController extends Controller
{
    //
    public function index(Request $request){

        $debit  =    CsrBibitModel::join('bibit' , 'bibit.id' , '=' , 'csr_bibit.bibit_id')
        ->join('csr' , 'csr.id' , '=' , 'csr_bibit.csr_id')
        ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_bibit.gudang_bibit_id')
        ->select(Db::raw('csr.judul as asal') , 
                        'bibit.jenis as bibit' , 'gudang_bibit.nama as gudang' , 'csr_bibit.jumlah' , 'bibit.harga' , Db::raw("'Debit' as tipe"), 'csr_bibit.created_at');
        
        if($request->gudang){
            $debit  =    $debit->where('csr_bibit.gudang_bibit_id' , $request->gudang);
        }
        $debit  =    $debit->get();

        $kredit    = CsrOutBibitModel::join('bibit' , 'bibit.id' , '=' , 'csr_out_bibit.bibit_id')
        ->join('csr_out' , 'csr_out.id' , '=' , 'csr_out_bibit.csr_out_id')
        ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_out_bibit.gudang_bibit_id')
        ->select(Db::raw('csr_out.judul as asal') , 'bibit.jenis as bibit' , 'gudang_bibit.nama as gudang' , 'csr_out_bibit.jumlah', 'bibit.harga' , Db::raw("'Kredit' as tipe") , 'csr_out_bibit.created_at');
        
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
        return view('bank-bibit.index' , ["history" => $history]);
    }

    public function mutasi($id){
        $bibit  =    BibitModel::findOrFail($id);
        $csr_bibit  =    CsrBibitModel::where('bibit_id' , $id)
        ->join('csr'  , 'csr.id' , '=' , 'csr_bibit.csr_id')
        ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_bibit.gudang_bibit_id')
        ->select('csr.id' , 'csr.judul' , 'csr_bibit.jumlah' , 'gudang_bibit.nama as gudang')
        ->get();

        $csr_out_bibit  =    CsrOutBibitModel::where('bibit_id' , $id)
        ->join('csr_out' , 'csr_out.id' , '=' , 'csr_out_bibit.csr_out_id')
        ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_out_bibit.gudang_bibit_id')
        ->select('csr_out.id' , 'csr_out.judul' , 'csr_out_bibit.jumlah' , 'gudang_bibit.nama as gudang')
        ->get();

        $total  =    CsrBibitModel::where('bibit_id' , $id)->sum('jumlah');
            $total_tanam    =    CsrOutBibitModel::where('bibit_id' , $id)->sum('jumlah');



        $response   =    ["debit" => $csr_bibit , "kredit" => $csr_out_bibit , "total" => $total , "total_tanam" => $total_tanam , "tersedia" => $total-$total_tanam];
        return response()->json($response);
    }
}
