@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Section Searching -->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="breadcrumb-item text-sm font-weight-bolder text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</h6>
                    </div>
                    <div class="form-row w-full px-4 flex flex-wrap">
                        <form action="report/pengadaan_export_filter.php" method="get" class="d-inline">
                            <div class="form-row row mb-3">
                                <div class="col-md-5">
                                    <label for="selectMonth">Tanggal Awal:</label>
                                    <input type="date" class="form-control" name="tanggal_awal" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="selectMonth">Tanggal Akhir:</label>
                                    <input type="date" class="form-control" name="tanggal_akhir" required>
                                </div>
                                <div class="col-md-5 pt-3">
                                    <button type="submit" href="#" class="btn bg-gradient-primary btn-sm mb-0" name="cetak">+&nbsp; Cetak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section Barang Masuk End -->
        <!-- Section Table Keluar -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <table class="table align-items-center mb-0 table-hover" id="pengadaanTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Kode Barang</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Jenis Barang</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 col-auto">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kodeBarang as $no => $data)
                            <tr>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $no + 1 }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $data->kode_barang }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $data->jenis_barang }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    <!-- Edit Button triggers its own modal -->
                                    <a href="#" class="mx-0 text-center" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                                        <i class="fas fa-user-edit text-secondary"></i>
                                    </a>
                                    <form action="{{ route('kode-barang.destroy', ['kode_barang' => $data->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="mx-0 text-center" data-bs-toggle="tooltip" data-bs-original-title="Hapus User">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
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
                                            <form action="{{ route('kode-barang.update', ['kode_barang' => $data->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <label for="edit_kode_barang{{ $data->id }}" class="form-control-label">Kode Barang</label>
                                                        <div class="form-group">
                                                            <input type="text" name="kode_barang" class="form-control" id="edit_kode_barang{{ $data->id }}" value="{{ $data->kode_barang }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_jenis_barang{{ $data->id }}" class="form-control-label">Jenis Barang</label>
                                                        <div class="form-group">
                                                            <input type="text" name="jenis_barang" class="form-control" id="edit_jenis_barang{{ $data->id }}" value="{{ $data->jenis_barang }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-full px-0 flex flex-wrap justify-content-between pt-3">
                                                    <button type="submit" class="btn bg-gradient-primary btn-sm">
                                                        <i class="ti ti-save"></i> Save Changes
                                                    </button>
                                                    <button type="reset" class="btn bg-gradient-success btn-sm">
                                                        <i class="ti ti-printer"></i> Clear
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
                    <div class="w-full px-4 flex flex-wrap justify-content-between pt-3">
                        <a class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Add Data Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kode-barang.store') }}" method="post">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="kode_barang" class="form-control-label">Kode Barang</label>
                            <div class="form-group">
                                <input type="text" name="kode_barang" class="form-control" id="kode_barang" placeholder="PB/BHPK" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_barang" class="form-control-label">Jenis Barang</label>
                            <div class="form-group">
                                <input type="text" name="jenis_barang" class="form-control" id="jenis_barang" placeholder="Bahan Baku" required>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-0 flex flex-wrap justify-content-between pt-3">
                        <button type="submit" class="btn bg-gradient-primary btn-sm">
                            <i class="ti ti-plus"></i> Tambah Data
                        </button>
                        <button type="reset" class="btn bg-gradient-success btn-sm">
                            <i class="ti ti-printer"></i> Clear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
