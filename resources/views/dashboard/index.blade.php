@extends('template')
@section('content')
<div class="container-fluid wrap">
    @if (session('warning'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Kesalahan !</strong> Pastikan mengisi dengan benar dan tidak ada QTY bernilai 0.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form method="post" action="{{route('dashboard.store')}}" autocomplete="off">
    <div class="row">
        <div class="col-sm-12 form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" type="button">No Meja</span>
                </div>
                <input name="no_meja" type="text" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="clone">
        <div id="id0" class="row wrapper">
            <div class="col-md-3 col-sm-8 form-group">
                <select class="form-control select" name="menu_id[]" required>
                    @if($data['menu_all'] == FALSE)
                    <option value="">Pilih</option>
                    @else
                    <option value="" selected>Pilih</option>
                    @foreach($data['menu_all'] as $r)
                    <option value="{{$r->id}}">{{$r->nama_menu}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-2 col-sm-4 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <button id="btnmin-id0" class="btn btn-outline-secondary min" type="button"><i class="fa fa-minus"></i></button>
                    </div>
                    <input name="qty[]" type="text" value="0" class="form-control" min="1" readonly required>
                    <div class="input-group-append">
                      <button id="btnmin-id0" class="btn btn-outline-secondary plus" type="button"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" type="button">Harga (Rp) </span>
                    </div>
                    <input value="0" class="form-control pricetag" readonly required>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" type="button">Rp </span>
                    </div>
                    <input id="id0" name="harga[]" type="text" value="0" class="form-control zero-input" readonly required>
                    <input id="hide-id0" name="harga-jual[]" class="hidden-input" type="hidden" value="0" />
                </div>
            </div>
            <div class="col-md-1 col-sm-12 form-group">
                <a href="#" id="id0" class="btn btn-danger removeOrder">Hapus</a>
            </div>
        </div>
    </div>
    <div class="row orderUp">
        <div class="col-md-6 col-xs-12 mb-3">
            <div class="btn-group">
                <a href="#" class="btn btn-success addOrder">Tambah Pesanan</a>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 mb-3">
          <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" type="button">Total (Rp) </span>
              </div>
              <input type="text" value="0" class="form-control price" readonly required>
              <div class="input-group-append">
                <button class="btn btn-success" type="submit" value="Pesan"><i class="fas fa-paper-plane"></i> Pesan</button>
              </div>
          </div>
        </div>
    </div>
    @csrf
    </form>
</div>
@endsection
