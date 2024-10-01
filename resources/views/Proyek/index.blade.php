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
                        <form action="{{ route('masyarakat.index') }}" method="get" class="d-inline">
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
        <!-- Section Searching End -->

        <!-- Section Table Masyarakat -->
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                <div class="table-responsive card mb-4">
                    <table class="table align-items-center mb-0 table-hover" id="masyarakatTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nama</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Alamat</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nomor HP</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Pekerjaan</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($masyarakat as $index => $data)
                            <tr>
                                <td class="text-center text-xs">{{ $index + 1 }}</td>
                                <td class="text-center text-xs">{{ $data->nama }}</td>
                                <td class="text-center text-xs">{{ $data->alamat }}</td>
                                <td class="text-center text-xs">{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                                <td class="text-center text-xs">{{ $data->nomor_hp }}</td>
                                <td class="text-center text-xs">{{ $data->pekerjaan }}</td>
                                <td class="text-center text-xs">
                                    <a href="#" class="mx-0 text-center" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                                        <i class="fas fa-user-edit text-secondary"></i>
                                    </a>
                                    <form action="{{ route('masyarakat.destroy', ['masyarakat' => $data->id]) }}" method="POST" style="display:inline; color:white;">
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
                                            <form action="{{ route('masyarakat.update', ['masyarakat' => $data->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <label for="edit_nama{{ $data->id }}" class="form-control-label">Nama</label>
                                                        <div class="form-group">
                                                            <input type="text" name="nama" class="form-control" id="edit_nama{{ $data->id }}" value="{{ $data->nama }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_alamat{{ $data->id }}" class="form-control-label">Alamat</label>
                                                        <div class="form-group">
                                                            <input type="text" name="alamat" class="form-control" id="edit_alamat{{ $data->id }}" value="{{ $data->alamat }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_tanggal{{ $data->id }}" class="form-control-label">Tanggal</label>
                                                        <div class="form-group">
                                                            <input type="date" name="tanggal" class="form-control" id="edit_tanggal{{ $data->id }}" value="{{ \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_nomor_hp{{ $data->id }}" class="form-control-label">Nomor HP</label>
                                                        <div class="form-group">
                                                            <input type="text" name="nomor_hp" class="form-control" id="edit_nomor_hp{{ $data->id }}" value="{{ $data->nomor_hp }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_pekerjaan{{ $data->id }}" class="form-control-label">Pekerjaan</label>
                                                        <div class="form-group">
                                                            <input type="text" name="pekerjaan" class="form-control" id="edit_pekerjaan{{ $data->id }}" value="{{ $data->pekerjaan }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-full px-0 flex flex-wrap justify-content-between pt-3">
                                                    <button type="submit" class="btn bg-gradient-primary btn-sm">
                                                        <i class="fas fa-heart"></i> Save Changes
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
                    <div class="d-flex justify-content-between">
                        <!-- Pagination Links -->
                        <div class="mt-3">
                            {{ $masyarakat->links('pagination::bootstrap-5') }}
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
                <form action="{{ route('masyarakat.store') }}" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="nama" class="form-control-label">Nama</label>
                            <div class="form-group">
                                <input type="text" name="nama" class="form-control" id="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-control-label">Alamat</label>
                            <div class="form-group">
                                <input type="text" name="alamat" class="form-control" id="alamat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-control-label">Tanggal</label>
                            <div class="form-group">
                                <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nomor_hp" class="form-control-label">Nomor HP</label>
                            <div class="form-group">
                                <input type="text" name="nomor_hp" class="form-control" id="nomor_hp" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-control-label">Pekerjaan</label>
                            <div class="form-group">
                                <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" required>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-0 flex flex-wrap justify-content-between pt-3">
                        <button type="submit" class="btn bg-gradient-primary btn-sm">
                            <i class="fas fa-heart"></i> Save Changes
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