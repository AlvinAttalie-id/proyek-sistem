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
                        <form action="{{ route('anggaran-keluar.index') }}" method="get" class="d-inline">
                            <div class="form-row row mb-3">
                                <div class="col-md-5">
                                    <label for="tanggal_awal">Tanggal Awal:</label>
                                    <input type="date" class="form-control" name="tanggal_awal" value="{{ request('tanggal_awal') }}" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="tanggal_akhir">Tanggal Akhir:</label>
                                    <input type="date" class="form-control" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" required>
                                </div>
                                <div class="col-md-5 pt-3">
                                    <button type="submit" class="btn bg-gradient-primary btn-sm mb-0" name="search">Tampilkan</button>
                                    <button type="submit" class="btn bg-gradient-success btn-sm mb-0" name="report" value="1">Laporan</button>
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
                @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                <div class="card mb-4">
                    <table class="table align-items-center mb-0 table-hover" id="anggaranKeluarTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Kode Proyek</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal Keluar</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Jumlah Keluar</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Keterangan</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Status</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder col-auto">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggaranKeluar as $id => $data)
                            <tr>
                                <td class="text-center text-xs">{{ $id + 1 }}</td>
                                <td class="text-center text-xs">{{ $data->kode_proyek }}</td>
                                <td class="text-center text-xs">{{ \Carbon\Carbon::parse($data->tanggal_keluar)->format('d-m-Y') }}</td>
                                <td class="text-center text-xs">Rp. {{ number_format($data->jumlah_keluar, 2, ',', '.') }}</td>
                                <td class="text-center text-xs">{{ $data->keterangan }}</td>
                                <td class="text-center text-xs">
                                    <span class="badge text-white"
                                          style="background-color:
                                            @if($data->status == 'Reject') #f0ad4e;  /* warning color */
                                            @elseif($data->status == 'verifikasi') #5cb85c;  /* success color */
                                            @else #cb0c9f;  /* default or other status color */
                                            @endif">
                                        {{ $data->status }}
                                    </span>
                                </td>
                                <td class="text-center text-xs">
                                    <!-- Edit Button triggers its own modal -->
                                    <a href="#" class="mx-0 text-center" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                                        <i class="fas fa-user-edit text-secondary"></i>
                                    </a>
                                    <form action="{{ route('anggaran-keluar.destroy', ['anggaran_keluar' => $data->id]) }}" method="POST" style="display:inline;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="mx-0 text-center" data-bs-toggle="tooltip" data-bs-original-title="Hapus Data">
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
                                            <form action="{{ route('anggaran-keluar.update', ['anggaran_keluar' => $data->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <label for="edit_kode_proyek{{ $data->id }}" class="form-control-label">Kode Proyek</label>
                                                        <div class="form-group">
                                                            <input type="text" name="kode_proyek" class="form-control" id="edit_kode_proyek{{ $data->id }}" value="{{ $data->kode_proyek }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_tanggal_keluar{{ $data->id }}" class="form-control-label">Tanggal Keluar</label>
                                                        <div class="form-group">
                                                            <input type="date" name="tanggal_keluar" class="form-control" id="edit_tanggal_keluar{{ $data->id }}" value="{{ $data->tanggal_keluar }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_jumlah_keluar{{ $data->id }}" class="form-control-label">Jumlah Keluar</label>
                                                        <div class="form-group">
                                                            <input type="number" step="0.01" name="jumlah_keluar" class="form-control" id="edit_jumlah_keluar{{ $data->id }}" value="{{ $data->jumlah_keluar }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_keterangan{{ $data->id }}" class="form-control-label">Keterangan</label>
                                                        <div class="form-group">
                                                            <input type="text" name="keterangan" class="form-control" id="edit_keterangan{{ $data->id }}" value="{{ $data->keterangan }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_status{{ $data->id }}" class="form-control-label">Status</label>
                                                        <div class="form-group">
                                                            <input type="text" name="status" class="form-control" id="edit_status{{ $data->id }}" value="{{ $data->status }}" required readonly>
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

                    <div class="d-flex justify-content-between">
                        <!-- Pagination Links -->
                        <div class="mt-3">
                            {{ $anggaranKeluar->links('pagination::bootstrap-5') }}
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
    </div>
</main>

<!-- Add Data Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('anggaran-keluar.store') }}" method="post">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="kode_proyek" class="form-control-label">Kode Proyek</label>
                            <div class="form-group">
                                <input type="text" name="kode_proyek" class="form-control" id="kode_proyek" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_keluar" class="form-control-label">Tanggal Keluar</label>
                            <div class="form-group">
                                <input type="date" name="tanggal_keluar" class="form-control" id="tanggal_keluar" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah_keluar" class="form-control-label">Jumlah Keluar</label>
                            <div class="form-group">
                                <input type="number" step="0.01" name="jumlah_keluar" class="form-control" id="jumlah_keluar" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="keterangan" class="form-control-label">keterangan</label>
                            <div class="form-group">
                                <input type="text" name="keterangan" class="form-control" id="keterangan" required>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-0 flex flex-wrap justify-content-between pt-3">
                        <button type="submit" class="btn bg-gradient-primary btn-sm">
                            <i class="ti ti-save"></i> Save
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
