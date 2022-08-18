@extends('layouts.app')

@section('title', 'Tambah Permintaan Barang')

@section('content')
  <div class="p-5 mx-auto">
    <h1 class="text-center mb-5">Form Permintaan Barang</h1>

    {{-- form input peminta  --}}
    <form action="{{ route('store') }}" method="post">
      @csrf

      {{-- peminta  --}}
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="nik" class="form-label">NIK Peminta : </label>
          <select class="form-select" aria-label="Default select example" id="nik" name="nik" onchange="pilih_nik()">
            <option selected>Pilih NIK Peminta</option>

            {{-- daftar nik  --}}
            @foreach ($users as $user)
            <option value="{{ $user->nik }}">{{ $user->nik }}</option>
            @endforeach

          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label for="name" class="form-label">Nama : </label>
          <input type="text" class="form-control" id="name" disabled>
        </div>
        <div class="col-md-4 mb-3">
          <label for="department" class="form-label">Departemen : </label>
          <input type="text" class="form-control" id="department" disabled>
        </div>
      </div>

      {{-- tgl permintaan --}}
      <div class="row mb-3">
        <div class="col-md-4 mb-3">
          <label for="request_date" class="form-label">Tanggal Permintaan : </label>
          <input type="datetime-local" class="form-control" id="request_date" name="request_date">
        </div>
      </div>

      {{-- daftar barang --}}
      <div class="row mb-1">
        <div class="table-responsive">
          <table id="table-data" class="table table-striped table-hover table-bordered display">
            <thead class="bg-info text-light">
              <tr>
                <th>Barang</th>
                <th>Lokasi</th>
                <th>Tersedia</th>
                <th>Kuantiti</th>
                <th>Satuan</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              <tr>

                {{-- pilih barang --}}
                <td>

                  <select class="form-select" aria-label="Default select example" id="id" name="id[]">
                    <option selected>Pilih Barang</option>
        
                    {{-- daftar kode-barang  --}}
                    @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->code . ' - ' . $item->name }}</option>
                    @endforeach
        
                  </select>

                </td>

                <td>
                  <input type="text" class="form-control" id="location" disabled>
                </td>

                <td>
                  <input type="text" class="form-control" id="available" disabled>
                </td>

                {{-- quantity --}}
                <td>
                  <input type="text" class="form-control" id="quantity" name="quantity[]">
                </td>

                <td>
                  <input type="text" class="form-control" id="unit" disabled>
                </td>

                {{-- description --}}
                <td>
                  <input type="text" class="form-control" id="description" name="description[]" value="-">
                </td>

                <td class="align-middle">
                  <span class="badge rounded-pill bg-success">Terpenuhi</span>
                </td>

                {{-- tombol remove form --}}
                <td class="text-center align-middle">
                  <a href="#" class="text-danger remove" id="remove-button">
                    <i class="bi-trash"></i>
                  </a>
                </td>

              </tr>
    
            </tbody>
          </table>
        </div>
      </div>

      {{-- tombol tambah form  --}}
      <div class="mb-3">
        {{-- <button class="btn btn-success" id="add-button" title="Tambah Form Barang"><i class="bi bi-plus-circle"></i> Tambah</button> --}}
        <a href="#" class="btn btn-success addRow" id="add-button">Tambah</a>
      </div>

      <div class="text-center">
        <button type="reset" class="btn btn-outline-secondary">Batal</button>
        <button type="submit" class="btn btn-primary">Proses</button>
      </div>

    </form>

  </div>
@endsection

@push('scripts')
  {{-- jquery ajax link cdn --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

  {{-- tambah form  --}}
  <script type="text/javascript">
    $('.addRow').on('click', function(){
      addRow();
    });

    function addRow(){
      let tr = '<tr>' +
                  '<td>' +

                    '<select class="form-select" aria-label="Default select example" id="id" name="id[]">' +
                      '<option selected>Pilih Barang</option>' +
          
                      '@foreach ($items as $item)' +
                      '<option value="{{ $item->id }}">{{ $item->code . ' - ' . $item->name }}</option>' +
                      '@endforeach' +
          
                    '</select>' +

                  '</td>' +

                  '<td>' +
                    '<input type="text" class="form-control" id="location" disabled>' +
                  '</td>' +

                  '<td>' +
                    '<input type="text" class="form-control" id="available" disabled>' +
                  '</td>' +

                  '<td>' +
                    '<input type="text" class="form-control" id="quantity" name="quantity[]">' +
                  '</td>' +

                  '<td>' +
                    '<input type="text" class="form-control" id="unit" disabled>' +
                  '</td>' +

                  '<td>' +
                    '<input type="text" class="form-control" id="description" name="description[]" value="-">' +
                  '</td>' +

                  '<td class="align-middle">' +
                    '<span class="badge rounded-pill bg-success">Terpenuhi</span>' +
                  '</td>' +

                  '<td class="text-center align-middle">' +
                    '<a href="#" class="text-danger remove" id="remove-button">' +
                      '<i class="bi-trash"></i>' +
                    '</a>' +
                  '</td>' +

                '</tr>';
      $('tbody').append(tr);
    }
  </script>

  {{-- remove form --}}
  <script>
    $('tbody').on('click', '.remove', function(){
      $(this).parent().parent().remove();
    });
  </script>
@endpush