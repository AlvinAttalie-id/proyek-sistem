@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <!-- Section Searching -->
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 class="breadcrumb-item text-sm font-weight-bolder text-dark active text-capitalize"
                                aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</h6>
                        </div>
                        <div class="form-row w-full px-4 flex flex-wrap">
                            <form action="{{ route('barang-keluar.index') }}" method="get" class="d-inline">
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
            <!-- Section Table -->
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
                        <table class="table align-items-center mb-0 table-hover" id="barangKeluarTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Kode Barang
                                    </th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nama Barang
                                    </th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Penanggung
                                        Jawab</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Jumlah
                                        Keluar</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Status</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder col-auto">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangKeluar as $id => $data)
                                    @if ($data->status !== 'Diajukan')
                                        <tr>
                                            <td class="text-center text-xs">{{ $id + 1 }}</td>
                                            <td class="text-center text-xs">{{ $data->kode_barang }}</td>
                                            <td class="text-center text-xs">{{ $data->DataBarang->nama_barang ?? 'N/A' }}
                                            </td>
                                            <td class="text-center text-xs">{{ $data->penanggung_jawab }}</td>
                                            <td class="text-center text-xs">{{ $data->barang_keluar }}</td>
                                            <td class="text-center text-xs">
                                                {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                                            <td class="text-center text-xs">
                                                <span class="badge text-white"
                                                    style="background-color:
                                        @if ($data->status == 'Diajukan') #f0ad4e;  /* warning color */
                                        @elseif($data->status == 'verifikasi') #5cb85c;  /* success color */
                                        @else #f44335;  /* default or other status color */ @endif">
                                                    {{ $data->status }}
                                                </span>
                                            </td>
                                            <td class="text-center text-xs">
                                                @if($data->status !== 'verifikasi')
                                                    <form action="{{ route('barang-keluar.destroy', ['barang_keluar' => $data->id]) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="mx-0 text-center" data-bs-toggle="tooltip" data-bs-original-title="Hapus Data">
                                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>                                            
                                        </tr>
                                        <!-- Edit Data Modal -->
                                        <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $data->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit
                                                            Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('barang-keluar.update', ['barang_keluar' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mt-4">
                                                                <div class="col-md-6">
                                                                    <label for="kode_barang{{ $data->id }}"
                                                                        class="form-control-label">Kode Barang</label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="kode_barang"
                                                                            class="form-control"
                                                                            id="kode_barang{{ $data->id }}"
                                                                            value="{{ $data->kode_barang }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="nama_barang{{ $data->id }}"
                                                                        class="form-control-label">Nama Barang</label>
                                                                    <div class="form-group">
                                                                        <select name="nama_barang" class="form-control"
                                                                            id="nama_barang{{ $data->id }}" required>
                                                                            <option value="" disabled>Select Kode
                                                                                Barang</option>
                                                                            @foreach ($barang as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $data->nama_barang == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->nama_barang }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="edit_penanggung_jawab{{ $data->id }}"
                                                                        class="form-control-label">Penanggung Jawab</label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="penanggung_jawab"
                                                                            class="form-control"
                                                                            id="edit_penanggung_jawab{{ $data->id }}"
                                                                            value="{{ $data->penanggung_jawab }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="edit_barang_keluar{{ $data->id }}"
                                                                        class="form-control-label">Jumlah Keluar</label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="barang_keluar"
                                                                            class="form-control"
                                                                            id="edit_barang_keluar{{ $data->id }}"
                                                                            value="{{ $data->barang_keluar }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="edit_tanggal{{ $data->id }}"
                                                                        class="form-control-label">Tanggal</label>
                                                                    <div class="form-group">
                                                                        <input type="date" name="tanggal"
                                                                            class="form-control"
                                                                            id="edit_tanggal{{ $data->id }}"
                                                                            value="{{ $data->tanggal }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="edit_status{{ $data->id }}"
                                                                        class="form-control-label">Status</label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="status"
                                                                            class="form-control"
                                                                            id="edit_status{{ $data->id }}"
                                                                            value="{{ $data->status }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="w-full px-0 flex flex-wrap justify-content-between pt-3">
                                                                <button type="submit"
                                                                    class="btn bg-gradient-primary btn-sm">
                                                                    <i class="ti ti-save"></i> Save Changes
                                                                </button>
                                                                <button type="reset"
                                                                    class="btn bg-gradient-success btn-sm">
                                                                    <i class="ti ti-printer"></i> Clear
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Button trigger modal -->
                        <div class="d-flex justify-content-between">
                            <!-- Pagination Links -->
                            <div class="mt-3">
                                {{ $barangKeluar->links('pagination::bootstrap-5') }}
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
                    <form action="{{ route('barang-keluar.store') }}" method="post">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="kode_barang" class="form-control-label">Kode Barang</label>
                                <div class="form-group">
                                    <input type="text" name="kode_barang" class="form-control" id="kode_barang"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_barang" class="form-control-label">Barang Barang</label>
                                <div class="form-group">
                                    <select name="nama_barang" class="form-control" id="nama_barang" required>
                                        <option value="" disabled selected>Select Kode Barang</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}"
                                                data-nama-barang="{{ $item->nama_barang }}">
                                                {{ $item->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="penanggung_jawab" class="form-control-label">Nama Penanggung Jawab</label>
                                <div class="form-group">
                                    <input type="text" name="penanggung_jawab" class="form-control"
                                        id="penanggung_jawab" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="barang_keluar" class="form-control-label">Jumlah Keluar</label>
                                <div class="form-group">
                                    <input type="text" name="barang_keluar" class="form-control" id="barang_keluar"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal" class="form-control-label">Tanggal</label>
                                <div class="form-group">
                                    <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-control-label">Status</label>
                                <div class="form-group">
                                    <input type="text" name="status" class="form-control" id="status" required>
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
