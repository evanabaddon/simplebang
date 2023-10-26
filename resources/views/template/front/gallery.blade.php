@extends('template.front.layout')

@section('content')
<main>

  <div class="container my-5" >
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h3 class="display-7  lh-1 mb-3">Galeri Penanaman</h3>

            <div class="fotorama" data-nav="thumbs">
              @foreach($foto as $each)
              	<img src="{{ $each->file }}" data-caption="{{ $each->judul }}"/>
              @endforeach
            </div>

        </div>
      </div>
  
</main>
@endsection
