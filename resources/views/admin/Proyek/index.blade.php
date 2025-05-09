@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
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
                            <form action="{{ route('proyek.index') }}" method="get" class="d-inline">
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

            <!-- Section Table Proyek -->
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                                {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive card mb-4">
                        <table class="table align-items-center mb-0 table-hover" id="proyekTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Kode Proyek
                                    </th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nama Proyek
                                    </th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Penanggung
                                        Jawab</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Bidang</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Keterangan
                                    </th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Anggaran
                                    </th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Status</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Progress
                                    </th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Detail</th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Lampiran
                                    </th>
                                    <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proyek as $id => $data)
                                    <tr>
                                        <td class="text-center text-xs">{{ $id + 1 }}</td>
                                        <td class="text-center text-xs">{{ $data->kode_proyek }}</td>
                                        <td class="text-center text-xs">{{ $data->nama_proyek }}</td>
                                        <td class="text-center text-xs">{{ $data->penanggung_jawab }}</td>
                                        <td class="text-center text-xs">{{ $data->bidang }}</td>
                                        <td class="text-center text-xs">{{ $data->tanggal->format('d-m-Y') }}</td>
                                        <td class="text-center text-xs">
                                            @if (empty($data->total_harga))
                                                telah diisi
                                            @else
                                                belum diisi
                                            @endif
                                        </td>
                                        <td class="text-center text-xs">
                                            @if (empty($data->keterangan))
                                                telah diisi
                                            @else
                                                belum diisi
                                            @endif
                                        </td>
                                        <td class="text-center text-xs">
                                            <span
                                                class="badge text-white 
                                        @if ($data->status == 'Done') bg-info 
                                        @elseif($data->status == 'Available') bg-success 
                                        @else bg-primary @endif">
                                                {{ $data->status }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                @php
                                                    // Menghitung persentase progress berdasarkan status kolom
                                                    $progress = 0;

                                                    // Cek apakah kolom barang terisi
                                                    if (!empty($data->nama_barang)) {
                                                        $progress += 25;
                                                    }

                                                    // Cek apakah kolom jumlah terisi
                                                    if (!empty($data->jumlah)) {
                                                        $progress += 35; // Menambahkan 35% jika jumlah terisi, total menjadi 60%
                                                    }

                                                    // Cek apakah kolom foto terisi
                                                    if (!empty($data->foto)) {
                                                        $progress += 40; // Menambahkan 40% jika foto terisi, total menjadi 100%
                                                    }
                                                @endphp
                                                <span class="me-2 text-xs font-weight-bold">{{ $progress }}%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width: {{ $progress }}%;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="text-center "><a href="{{ route('proyek.detail', $data->id) }}"
                                                class="mx-0 text-center">
                                                <i class="fa fa-id-badge text-secondary"></i>
                                            </a> </td>
                                        <td class="text-center "><a href="{{ route('proyek.report', $data->id) }}"
                                                class="mx-0 text-center">
                                                <i class="fa fa-print text-secondary"></i>
                                            </a> </td>
                                        <td class="text-center text-xs">
                                            <!-- Edit Button triggers its own modal -->
                                            <a href="#" class="mx-0 text-center" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $data->id }}">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <form action="{{ route('proyek.destroy', ['proyek' => $data->id]) }}"
                                                method="POST" style="display:inline; color:white;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="mx-0 text-center" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Hapus Data">
                                                    <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                </button>
                                            </form>
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
                                                    <form action="{{ route('proyek.update', ['proyek' => $data->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="update_type" value="projec">
                                                        <div class="row mt-4">
                                                            <div class="col-md-12">
                                                                <label for="edit_kode_proyek{{ $data->id }}"
                                                                    class="form-control-label">Kode Proyek</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="kode_proyek"
                                                                        class="form-control"
                                                                        id="edit_kode_proyek{{ $data->id }}"
                                                                        value="{{ $data->kode_proyek }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="edit_nama_proyek{{ $data->id }}"
                                                                    class="form-control-label">Nama Proyek</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="nama_proyek"
                                                                        class="form-control"
                                                                        id="edit_nama_proyek{{ $data->id }}"
                                                                        value="{{ $data->nama_proyek }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="edit_penanggung_jawab{{ $data->id }}"
                                                                    class="form-control-label">Penanggung Jawab</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="penanggung_jawab"
                                                                        class="form-control"
                                                                        id="edit_penanggung_jawab{{ $data->id }}"
                                                                        value="{{ $data->penanggung_jawab }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="edit_bidang{{ $data->id }}"
                                                                    class="form-control-label">Bidang</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="bidang"
                                                                        class="form-control"
                                                                        id="edit_bidang{{ $data->id }}"
                                                                        value="{{ $data->bidang }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="edit_bidang{{ $data->id }}"
                                                                    class="form-control-label">keterangan</label>
                                                                <div class="form-group">
                                                                    <textarea name="keterangan" class="form-control" id="keterangan{{ $data->id }}"
                                                                        value="{{ $data->keterangan }}" rows="4" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="w-full px-0 flex flex-wrap justify-content-between pt-3">
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
                                {{ $proyek->links('pagination::bootstrap-5') }}
                            </div>
                            <!-- Button trigger modal -->
                            <div class="w-full px-4 flex flex-wrap justify-content-between pt-3">
                                <a class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
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
                    <form action="{{ route('proyek.store') }}" method="post">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="kode_proyek" class="form-control-label">Kode Proyek</label>
                                <div class="form-group">
                                    <input type="text" name="kode_proyek" class="form-control" id="kode_proyek"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="nama_proyek" class="form-control-label">Nama Proyek</label>
                                <div class="form-group">
                                    <input type="text" name="nama_proyek" class="form-control" id="nama_proyek"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="penanggung_jawab" class="form-control-label">Penanggung Jawab</label>
                                <div class="form-group">
                                    <input type="text" name="penanggung_jawab" class="form-control"
                                        id="penanggung_jawab" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="bidang" class="form-control-label">Bidang</label>
                                <div class="form-group">
                                    <input type="text" name="bidang" class="form-control" id="bidang" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="tanggal" class="form-control-label">Tanggal</label>
                                <div class="form-group">
                                    <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="form-control-label">Keterangan</label>
                                <div class="form-group">
                                    <textarea name="keterangan" class="form-control" id="keterangan" rows="4" required></textarea>
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
@endsection
