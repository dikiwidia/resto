@extends('template')
@section('content')
<div class="container-fluid wrap">
    <div class="alert alert-success fade show" role="alert">
        <strong>Pesanan sedang diproses !</strong> mohon menunggu sejenak</span>
        </button>
    </div>
    <center>
        <a href="{{route('dashboard.index')}}" class="btn btn-lg btn-primary">Buat Pesanan Baru</a>
    </center>
</div>
@endsection
