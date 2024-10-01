@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <!-- Section Searching -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="breadcrumb-item text-sm font-weight-bolder text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</h6>
                    </div>
                    <div class="form-row w-full px-4 flex flex-wrap">
                        <form action="{{ route('barang.index') }}" method="get" class="d-inline">
                            <div class="form-row row mb-3">
                                <div class="col-md-5">
                                    <label for="tanggal_awal">Tanggal Awal:</label>
                                    <input type="date" class="form-control" name="tanggal_awal"
                                        value="{{ request('tanggal_awal') }}" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="tanggal_akhir">Tanggal Akhir:</label>
                                    <input type="date" class="form-control" name="tanggal_akhir"
                                        value="{{ request('tanggal_akhir') }}" required>
                                </div>
                                <div class="col-md-5 pt-3">
                                    <button type="submit" class="btn bg-gradient-primary btn-sm mb-0"
                                        name="search">Tampilkan</button>
                                    <button type="submit" class="btn bg-gradient-success btn-sm mb-0" name="report"
                                        value="1">Laporan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section Searching End -->

        <!-- Section Table DataBarang -->
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                <div class="table-responsive card mb-4">
                    <table class="table align-items-center mb-0 table-hover" id="barangTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Kode Barang</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nama Barang</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Harga Barang</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Jumlah Barang</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Status</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder col-auto">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barang as $id => $data)
                            <tr>
                                <td class="text-center text-xs">{{ $loop->iteration }}</td>
                                <td class="text-center text-xs">{{ $data->kodeBarang->kode_barang ?? 'N/A' }}</td>
                                <td class="text-center text-xs">{{ $data->nama_barang }}</td>
                                <td class="text-center text-xs">{{ number_format($data->harga_barang, 2) }}</td>
                                <td class="text-center text-xs">{{ $data->jumlah_barang }}</td>
                                <td class="text-center text-xs">{{ $data->tanggal->format('d-m-Y') }}</td>
                                <td class="text-center text-xs">
                                    <span class="badge text-white"
                                          style="background-color:
                                            @if($data->status == 'not available') #f0ad4e;  /* warning color */
                                            @elseif($data->status == 'available') #5cb85c;  /* success color */
                                            @else #cb0c9f;  /* default or other status color */
                                            @endif">
                                        {{ $data->status }}
                                    </span>
                                </td>
                                <td class="text-center text-xs">
                                    <!-- Edit Button -->
                                    <a href="#" class="mx-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                                        <i class="fas fa-edit text-secondary"></i>
                                    </a>
                                    <!-- Delete Form -->
                                    <form action="{{ route('barang.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="mx-1 text-center" data-bs-toggle="tooltip" title="Hapus Data">
                                            <i class="fas fa-trash text-secondary"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Data Modal -->
                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('barang.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="edit_kode_barang{{ $data->id }}">Kode Barang</label>
                                                        <select name="kode_barang" class="form-control" id="edit_kode_barang{{ $data->id }}" required>
                                                            @foreach($kodeBarang as $kode)
                                                                <option value="{{ $kode->id }}" {{ $data->kode_barang == $kode->id ? 'selected' : '' }}>
                                                                    {{ $kode->kode_barang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_nama_barang{{ $data->id }}">Nama Barang</label>
                                                        <input type="text" name="nama_barang" class="form-control" id="edit_nama_barang{{ $data->id }}" value="{{ $data->nama_barang }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_harga_barang{{ $data->id }}">Harga Barang</label>
                                                        <input type="text" name="harga_barang" class="form-control" id="edit_harga_barang{{ $data->id }}" value="{{ $data->harga_barang }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_jumlah_barang{{ $data->id }}">Jumlah Barang</label>
                                                        <input type="text" name="jumlah_barang" class="form-control" id="edit_jumlah_barang{{ $data->id }}" value="{{ $data->jumlah_barang }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_tanggal{{ $data->id }}">Tanggal</label>
                                                        <input type="date" name="tanggal" class="form-control" id="edit_tanggal{{ $data->id }}" value="{{ $data->tanggal->format('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_status{{ $data->id }}">Status</label>
                                                        <input type="text" name="status" class="form-control" id="edit_status{{ $data->id }}" value="{{ $data->status }}" required>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button type="submit" class="btn bg-gradient-primary btn-sm">
                                                        Simpan Perubahan
                                                    </button>
                                                    <button type="reset" class="btn bg-gradient-secondary btn-sm">
                                                        Bersihkan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Button trigger modal -->
                    <div class="d-flex justify-content-between">
                        <!-- Pagination Links -->
                        <div class="mt-3">
                            {{ $barang->links('pagination::bootstrap-5') }}
                        </div>
                        <!-- Button trigger modal -->
                        <div class="w-full px-4 flex flex-wrap justify-content-between pt-3">
                            <a class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section Table DataBarang End -->
    </div>
</main>

<!-- Add Data Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="kode_barang">Kode Barang</label>
                            <select name="kode_barang" class="form-control" id="kode_barang" required>
                                @foreach($kodeBarang as $kode)
                                    <option value="{{ $kode->id }}">{{ $kode->kode_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang" required>
                        </div>
                        <div class="col-md-6">
                            <label for="harga_barang">Harga Barang</label>
                            <input type="text" name="harga_barang" class="form-control" id="harga_barang" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah_barang">Jumlah Barang</label>
                            <input type="text" name="jumlah_barang" class="form-control" id="jumlah_barang" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn bg-gradient-primary btn-sm">
                            Tambah Data
                        </button>
                        <button type="reset" class="btn bg-gradient-secondary btn-sm">
                            Bersihkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
