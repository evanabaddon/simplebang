<?php

namespace App\Http\Controllers;

use App\Models\UsersViewModel;
use App\Models\TambangViewModel;
use App\Models\FotoTambangModel;
use App\Models\PerusahaanViewModel;
use App\Models\BibitModel;
use App\Models\GudangBibitModel;
use App\Models\CsrModel;
use App\Models\CsrBibitModel;
use App\Models\CsrOutModel;
use App\Models\CsrOutBibitModel;
use App\Exports\TambangExport;

use Excel;

use DB;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index(Request $request){

        return view('laporan.index' , ["request" => $request]);
    }

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


    private function get_model($modul , $keyword , $tanggal){

        $data   =    UsersViewModel::all();
        if($tanggal){
            $start  =    date('Y-m-d H:i:s'  , strtotime(explode('-' , $tanggal)[0]));  
            $end    =    date('Y-m-d H:i:s' , strtotime(explode('-' , $tanggal)[1])); 
        }
        switch($modul){
            default:
            break;

            case '1':
            $data   =  TambangViewModel::where('id' , '!=' , 'NULL');
            if($keyword){
                $data   =    $data->where('nama' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('jenis' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('status_lahan' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('nama_pemilik' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('alamat' , 'LIKE' , '%' . $keyword , '%')
                ->orWhere('luas'  , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('email' , 'LIKE' , '% ' . $keyword . '%')
                ->orWhere('no_telepon' , 'LIKE' , '%' . $keyword . '%');
            }

            if($tanggal){
                $data   =    $data->whereBetween('created_at' , [$start , $end]);
            }
            $data   =    $data->get();
              foreach($data as $key => $value){
                $data[$key]['foto'] = FotoTambangModel::where('tambang_id' , $value->id)->get();
              }

            break;

            case '2':
            $data   =  PerusahaanViewModel::where('id' , '!=' , 'NULL');

            if($keyword){
                $data   =    $data->where('nama' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('jenis' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('nama_pemilik' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('alamat' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('email' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('no_telepon' , 'LIKE' , '%' . $keyword . '%');
            }

            if($tanggal){
                $data   =    $data->whereBetween('created_at' , [$start , $end]);
            }

            $data   =    $data->get();
            break;

            case '3':
            $data   =  BibitModel::where('id' , '!=' , 'NULL');
            if($keyword){
                $data   =    $data->where('jenis' , 'LIKE' , '%' . $keyword . '%');
            }

            if($tanggal){
                $data   =    $data->whereBetween('created_at' , [$start , $end]);
            }

            $data   =    $data->get(); 
            break;

            case '4':
            $data   =    GudangBibitModel::where('id' , '!=' , 'NULL');
            if($keyword){
                $data   =    $data->where('nama' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('pemilik' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('alamat' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('no_telepon' , 'LIKE' , '%' . $keyword . '%');

            }

            if($tanggal){
                $data   =    $data->whereBetween('created_at' , [$start , $end]);
            }
            $data   =    $data->get();
            break;


            case '5':
            $data   =  CsrModel::join('perusahaan' , 'perusahaan.id' , '=' , 'csr.perusahaan_id')
              ->join('jenis_csr' , 'jenis_csr.id' , '=' , 'csr.jenis_csr_id')
              #->join('csr_bibit' , 'csr_bibit.csr_id' , '=' , 'csr.id')
              ->select('csr.id' , 'perusahaan.nama as nama_perusahaan' , 'jenis_csr.jenis as jenis_csr' , 'csr.judul' , 'csr.catatan' , 'csr.tanggal')
              ->where('csr.jenis_csr_id' , 1);

            if($keyword){
                $data   =    $data->where('perusahaan.nama' , 'LIKE' , '%' . $keyword . '%')
                ->where('csr.jenis_csr_id' , 1)
                ->orWhere('csr.judul' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('csr.catatan' , 'LIKE' , '%' . $keyword . '%');

            }

            if($tanggal){
                $data   =    $data->whereBetween('csr.tanggal' , [$start , $end]);
            }


            $data   =    $data->get();

              foreach($data as $key => $value){
                  $data[$key]->bibit  =  BibitModel::whereIn('id' , CsrBibitModel::where('csr_id' , $value->id)->get('bibit_id'))->get();
                  $data[$key]->jumlah_bibit   =  CsrBibitModel::where('csr_id' , $value->id)->sum('jumlah');
              }

            break;

            case '6':
            $data   =    CsrOutModel::join('tambang' , 'tambang.id' , '=' , 'csr_out.tambang_id')
                ->select('csr_out.id' , 'csr_out.judul as judul'  , 'tambang.nama as tambang' , 'csr_out.luas as luas_penanaman' , 'tambang.luas' , 'csr_out.tanggal');
            
            if($keyword){
                $data   =    $data->where('csr_out.judul' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('tambang.nama' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('csr_out.luas' , 'LIKE' , '%' . $keyword . '%')
                ->orWhere('tambang.luas' , 'LIKE' , '%' . $keyword . '%');

            }

            if($tanggal){
                $data   =    $data->whereBetween('csr_out.tanggal' , [$start , $end]);
            }

            $data   =    $data->get();

                foreach($data as $key => $each){
                    $data[$key]->list_bibit     =    BibitModel::whereIn('id' , CsrOutBibitModel::where('csr_out_id' , $each->id)->select('bibit_id'))->get();
                    $data[$key]->pecahan    =    $this->float2rat($each->luas_penanaman/$each->luas);
                    $data[$key]->jumlah_bibit   =    CsrOutBibitModel::where('csr_out_id'  , $each->id)->sum('jumlah');
                }
            break;


            case '7':
            $debit  =    CsrBibitModel::join('bibit' , 'bibit.id' , '=' , 'csr_bibit.bibit_id')
                ->join('csr' , 'csr.id' , '=' , 'csr_bibit.csr_id')
                ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_bibit.gudang_bibit_id')
                ->select(Db::raw('csr.judul as asal') , 'bibit.jenis as bibit' , 'gudang_bibit.nama as gudang' , 'csr_bibit.jumlah' , 'bibit.harga' , Db::raw("'Debit' as tipe"), 'csr_bibit.created_at');
                
                
                

                $kredit    = CsrOutBibitModel::join('bibit' , 'bibit.id' , '=' , 'csr_out_bibit.bibit_id')
                ->join('csr_out' , 'csr_out.id' , '=' , 'csr_out_bibit.csr_out_id')
                ->join('gudang_bibit' , 'gudang_bibit.id' , '=' , 'csr_out_bibit.gudang_bibit_id')
                ->select(Db::raw('csr_out.judul as asal') , 'bibit.jenis as bibit' , 'gudang_bibit.nama as gudang' , 'csr_out_bibit.jumlah' , 'bibit.harga' , Db::raw("'Kredit' as tipe") , 'csr_out_bibit.created_at');
                
                
                $debit  =    $debit->get();
                $kredit     =    $kredit->get();

                $debit = collect($debit->toArray());
                $kredit     =   collect($kredit->toArray());

                $data    =    $debit->merge($kredit)->sortByDesc('created_at');
            break;
                
        }

        return $data;
        
    }

    public function data(Request $request){
        $modul  =    $request->modul;
        $keyword        =    $request->keyword;
        $tanggal    =    $request->tanggal;
        #echo $tanggal;die();
        $data   =    $this->get_model($modul , $keyword , $tanggal);
        
        return view('laporan.index' , ["data" => $data , "modul" => $modul , "request" => $request]);
    }

    public function xls(Request $request , $modul , $keyword , $tanggal){
            $tanggal    =    base64_decode($tanggal);
            
             $data   =    $this->get_model($modul , $keyword , $tanggal);

             $name     =    "";

             switch($modul){
                default:
                    $name  =    "users";
                break;

                case '1':
                    $name  =    "ex-tambang";
                break;

                case '2':
                    $name  =    "perusahaan";
                break;

                case '3':
                    $name  =    "bibit-pohon";
                break;

                case '4':
                    $name  =    "kebun-bibit";
                break;

                case '5':
                    $name  =    'csr';
                break;

                case '6':
                    $name  =    "penanaman";
                break;

                case '7':
                    $name  =    "bank-bibit";
                break;

             }
        
            return Excel::download(new TambangExport($data),  $name . '-' . strtotime(date('Y-m-d H:i:s')) .  '.xlsx');
    }
}
