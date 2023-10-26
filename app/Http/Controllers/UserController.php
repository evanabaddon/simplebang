<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\UsersViewModel;
use App\Models\RoleModel;
use App\Models\UsersModel;
use App\Models\AuthModel;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //
    public function index(Request $request){
      $data = UsersViewModel::all();
        if($request->ajax()){

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn  =  '<div class="flex justify-center items-center">
                                            <a class="flex items-center mr-3" href="' . route('users.edit' , $row->id) . '"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> Edit </a>
                                            <a class="flex items-center text-theme-6" href="' . route('users.delete' , $row->id) . '" data-toggle="modal" data-target="#delete-confirmation-modal"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Delete </a>
                                        </div>';
                    return $btn;
                })
                ->addColumn('tanggal' , function($row){
                  $btn  =  date('Y-m-d H:i:s' , strtotime($row->created_at));
                  return $btn;
                })
                ->addColumn('stats' , function($row){
                  $status   =  '<div class="flex items-center justify-center text-theme-9"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> Active </div>';
                  if($row->is_active != 'Aktif'){
                    $status   =  '<div class="flex items-center justify-center text-theme-6"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> Inactive </div>';
                  }
                  return $status;
                })
                ->rawColumns(['action' , 'stats'])
                ->make(true);
        }

        return view('users.index' , ['users' => $data]);
    }

    public function create(Request $request){
      $roles  =  RoleModel::all();
      return view('users.create' , ["roles" => $roles]);
    }

    public function store(UserStoreRequest $request){
      $validator = $request->validated();
      $user   =  new UsersModel;
      $user->nik  =  $request->input('nik');
      $user->nama   =  $request->input('nama');
      $user->alamat   =  $request->input('alamat');
      $user->email  =  $request->input('email');
      $user->no_telepon   =  $request->input('no_telepon');

      if($user->save()){
          $auth   =  new AuthModel;
          $auth->user_id  =  $user->id;
          $auth->role_id  =  $request->input('role_id');
          $auth->is_active  =  "1";
          $auth->username   =  $request->input('username');
          $auth->password   =  Hash::make($request->input('password'));

          if($auth->save()){
            return redirect()->route('users.index')->with("success" , "Berhasil menambahkan user.");
          }
          return redirect()->route('users.index')->with("error" , "Gagal menambahkan user.");
      }

      return redirect()->route('users.index')->with("error" , "Gagal menambahkan user.");
    }

    public function edit($id ,Request $request){
      $user   =  UsersModel::findOrFail($id);

      $user   =  UsersModel::join('auth' , 'auth.user_id' , '=' , 'users.id')
      ->where("users.id" , $id)
      ->select('users.id' , 'users.nama' , 'users.alamat' , 'users.email' , 'users.no_telepon' , 'auth.username'  , 'auth.is_active' , 'users.nik' , 'auth.role_id' , DB::raw("auth.id AS auth_id"))
      ->first();

      $role   =  RoleModel::all();

      return view('users.edit' , ["user" => $user , "roles" => $role]);
    }

    public function update(UserUpdateRequest $request){
      $validator = $request->validated();

      $user   =  UsersModel::findOrFail($request->input('id'));
      $user->nik  =  $request->input('nik');
      $user->nama   =  $request->input('nama');
      $user->alamat   =  $request->input('alamat');
      $user->email  =  $request->input('email');
      $user->no_telepon   =  $request->input('no_telepon');

      if($user->save()){
          $auth   =  AuthModel::findOrFail($request->input('auth_id'));
          $auth->user_id  =  $user->id;
          $auth->role_id  =  $request->input('role_id');
          $auth->is_active  =  "1";
          $auth->username   =  $request->input('username');
          if($request->input('password'))
            $auth->password   =  Hash::make($request->input('password'));

          if($auth->save()){
            return redirect()->route('users.index')->with("success" , "Berhasil update user.");
          }
          return redirect()->route('users.index')->with("error" , "Gagal update user.");
      }

      return redirect()->route('users.index')->with("error" , "Gagal update user.");
    }

    public function delete($id , Request $request){
      $user   =  UsersModel::findOrFail($id)->delete();
      $auth   =  AuthModel::where('user_id' , $id)->delete();

      if($auth && $user){
        return redirect()->route('users.index')->with('success' , 'Berhasil menghapus user.');
      }
      return redirect()->route('users.index')->with('error' , 'Gagal menghapus user');
    }
}
