@extends('layouts.app')

@section('title', 'Detail Transaksi Permintaan Barang')

@section('content')
<div class="p-5 mx-auto">
  <h1 class="text-center mb-5">Detail Transaksi Permintaan Barang</h1>

    {{-- pesan alert --}}
    @if (session()->has('pesan'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session()->get('pesan') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Daftar Permintaan Barang</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
      </ol>
      <hr>
    </nav>

    {{-- peminta  --}}
    <div class="mb-4">
      <div class="row">

        <div class="col-md">
          <div class="row">
            <div class="col-4">NIK</div>
            <div class="col">: {{ $transactionItem->user->nik }}</div>
          </div>
        </div>

        <div class="col-md">
          <div class="row">
            <div class="col-4">Departemen</div>
            <div class="col">: {{ $transactionItem->user->department }}</div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md">
          <div class="row">
            <div class="col-4">Nama</div>
            <div class="col">: {{ $transactionItem->user->name }}</div>
          </div>
        </div>

        <div class="col-md">
          <div class="row">
            <div class="col-4">Tanggal Permintaan</div>
            <div class="col">: {{ date('d M Y H:i', strtotime($transactionItem->request_date)) }}</div>
          </div>
        </div>

      </div>
    </div>

    {{-- daftar barang --}}
    <div class="row mb-1">
      <div class="table-responsive">
        <table id="table-data" class="table table-striped table-hover table-bordered display">
          <thead class="bg-info text-light">
            <tr>
              <th>#</th>
              <th>Barang</th>
              <th>Lokasi</th>
              <th>Tersedia</th>
              <th>Kuantiti Dipinjam</th>
              <th>Satuan</th>
              <th>Keterangan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($transactionDetails as $transactionDetail)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transactionDetail->item->code . ' - ' .$transactionDetail->item->name }}</td>
                <td>{{ $transactionDetail->item->location->code .' - '. $transactionDetail->item->location->name }}</td>
                <td>{{ $transactionDetail->item->available }}</td>
                <td>{{ $transactionDetail->quantity }}</td>
                <td>{{ $transactionDetail->item->unit }}</td>
                <td>{{ $transactionDetail->description }}</td>

                <td class="align-middle">
                  <span class="badge rounded-pill bg-success">Terpenuhi</span>
                </td>

                {{-- tombol remove form --}}
                <td class="text-center align-middle">
                  <form action="{{ route('destroyTransactionDetail', $transactionDetail->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" title="Delete">
                      <i class="bi-trash"></i>
                    </button>
                  </form>
                </td>

              </tr>
            @endforeach
  
          </tbody>
        </table>
      </div>
    </div>

</div>
@endsection