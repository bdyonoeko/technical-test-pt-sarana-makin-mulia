@extends('layouts.app')

@section('title', 'Daftar Permintaan Barang')

@section('content')
  <div class="p-5 mx-auto">
    <h1 class="text-center mb-5">Daftar Permintaan Barang</h1>

    {{-- pesan alert --}}
    @if (session()->has('pesan'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session()->get('pesan') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a href="{{ route('create') }}" class="btn btn-primary mb-3">Tambah Permintaan</a>

    <div class="table-responsive">
      <table id="table-data" class="table table-striped table-hover table-bordered display">
        <thead class="bg-info text-light">
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Departemen</th>
            <th>Tanggal Permintaan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($transactionItems as $transactionItem)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $transactionItem->user->name }}</td>
            <td>{{ $transactionItem->user->department }}</td>
            <td>{{ date('d M Y', strtotime($transactionItem->request_date)) }}</td>
            <td class="text-center align-middle">

              {{-- tombol show detail --}}
              <a href="{{ route('show', $transactionItem->id) }}" class="btn btn-secondary mb-2" title="Show Detail">
                <i class="bi-eye-fill"></i>
                Detail
              </a>

              {{-- tombol delete --}}
              {{-- <form action="{{ route('destroy', $transactionItem->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" title="Delete">
                  <i class="bi-trash"></i>
                </button>
              </form> --}}

              {{-- <a href="{{ route('destroy', $transactionItem->id) }}" class="btn btn-danger" title="Delete">
                <i class="bi-trash"></i>
              </a> --}}

            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

  </div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

{{-- style bootstrap  --}}
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
@endpush

@push('scripts')
  <script>
    $(document).ready(function(){
        $('#table-data').DataTable();
    });
  </script>
@endpush