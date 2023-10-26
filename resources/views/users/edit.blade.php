@extends('template.layout')
@section('title' , 'Edit Pengguna')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('users.index') }}" class="breadcrumb--active"> Daftar Pengguna</a> </div>
                    <!-- END: Breadcrumb -->
                    @include('template.search')
                    @include('template.notification')
                    @include('template.account')
                </div>
                <!-- END: Top Bar -->
                @if ($errors->any())
                <div class="rounded-md px-5 py-4 mb-2 bg-theme-6 text-white">
                   <div class="flex items-center">
                       <div class="font-medium text-lg">Terjadi Kesalahan</div>
                   </div>
                   <ul>
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
               @endif
                <div class="intro-y flex items-center mt-8">

                </div>
                <div class="grid grid-cols-12">

                    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Edit Pengguna
                                </h2>
                            </div>
                            <form class="" action="{{ route('users.update') }}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $user->id }}">
                              <input type="hidden" name="auth_id" value="{{ $user->auth_id }}">
                              <div class="p-5">
                                  <div class="grid grid-cols-12 gap-5">

                                      <div class="col-span-12 xl:col-span-9">
                                          <div class="mt-3">
                                              <label>NIK</label>
                                              <input type="text" name="nik" class="input w-full border  mt-2"  placeholder="16 Digit NIK" value="{{ $user->nik }}">
                                          </div>
                                          <div class="mt-3">
                                              <label>NAMA</label>
                                              <input type="text" name="nama" class="input w-full border  mt-2"  placeholder="Nama" value="{{ $user->nama }}">
                                          </div>
                                          <div class="mt-3">
                                              <label>ALAMAT</label>
                                              <textarea name="alamat" class="input w-full border  mt-2" placeholder="Alamat">{{ $user->alamat }}</textarea>
                                          </div>
                                          <div class="mt-3">
                                              <label>EMAIL</label>
                                              <input type="email" name="email" class="input w-full border  mt-2"  placeholder="Email" value="{{ $user->email }}">
                                          </div>
                                          <div class="mt-3">
                                              <label>TELEPON</label>
                                              <input type="text" name="no_telepon" class="input w-full border  mt-2"  placeholder="Nomor Telepon" value="{{ $user->no_telepon }}">
                                          </div>
                                          <div class="mt-3">
                                              <label>ROLE</label>
                                              <select class="input w-full border  mt-2" name="role_id">
                                                @foreach($roles as $each)
                                                  <option value="{{ $each->id }}" @if($user->role_id == $each->id) selected @endif>{{ $each->role }}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="mt-3">
                                              <label>USERNAME</label>
                                              <input type="text" name="username" class="input w-full border  mt-2"  placeholder="Username" value="{{ $user->username }}">
                                          </div>
                                          <div class="mt-3">
                                              <label>PASSWORD</label>
                                              <input type="password" name="password" class="input w-full border  mt-2"  placeholder="********">
                                          </div>
                                          <div class="mt-3">
                                              <label>PASSWORD CONFIRMATION</label>
                                              <input type="password" name="password_confirmation" class="input w-full border  mt-2"  placeholder="********">
                                          </div>
                                          <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Save</button>
                                      </div>
                                  </div>
                              </div>
                            </form>

                        </div>
                        <!-- END: Display Information -->
                    </div>
                </div>
            </div>
            <!-- END: Content -->
@endsection
@section('js')

@endsection
