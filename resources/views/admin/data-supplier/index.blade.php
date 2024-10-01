@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <!-- Section Table Data Supplier -->
            <div class="row">
                <!-- Section Searching -->
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 class="breadcrumb-item text-sm font-weight-bolder text-dark active text-capitalize"
                                aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</h6>
                        </div>
                        <div class="form-row w-full px-4 flex flex-wrap">
                            <form action="{{ route('data-supplier.index') }}" method="get" class="d-inline">
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
            <div class="col-12">
                <div class="table-responsive card mb-4">
                    <table class="table align-items-center mb-0 table-hover" id="supplierTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nama Supplier
                                </th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Alamat Supplier
                                </th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Email Supplier
                                </th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nomor Telepon
                                </th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal Aktif
                                </th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal Berakhir
                                </th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Status</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSupplier as $id => $supplier)
                                <tr>
                                    <td class="text-center text-xs">
                                        {{ $id + 1 }}</td>
                                    <td class="text-center text-xs">
                                        {{ $supplier->nama_supplier }}</td>
                                    <td class="text-center text-xs">
                                        {{ $supplier->alamat_supplier }}</td>
                                    <td class="text-center text-xs">
                                        {{ $supplier->email_supplier }}</td>
                                    <td class="text-center text-xs">
                                        {{ $supplier->nomor_telepon }}</td>
                                    <td class="text-center text-xs">
                                        {{ $supplier->tanggal_awal }}</td>
                                    <td class="text-center text-xs">
                                        {{ $supplier->tanggal_akhir }}</td>
                                        <td class="text-center text-xs">
                                            <span class="badge text-white"
                                                  style="background-color:
                                                    @if($supplier->status == 'tidak aktif') #f0ad4e;  /* warning color */
                                                    @elseif($supplier->status == 'Aktif') #5cb85c;  /* success color */
                                                    @else #cb0c9f;  /* default or other status color */
                                                    @endif">
                                                {{ $supplier->status }}
                                            </span>
                                        </td>

                                    <td class="text-center text-xs">
                                        <!-- Edit Button triggers its own modal -->
                                        <a href="#" class="mx-0 text-center" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $supplier->id }}">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <form
                                            action="{{ route('data-supplier.destroy', ['data_supplier' => $supplier->id]) }}"
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
                                <div class="modal fade" id="editModal{{ $supplier->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $supplier->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $supplier->id }}">Edit Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('data-supplier.update', ['data_supplier' => $supplier->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <label for="edit_nama_supplier{{ $supplier->id }}"
                                                                class="form-control-label">Nama Supplier</label>
                                                            <div class="form-group">
                                                                <input type="text" name="nama_supplier"
                                                                    class="form-control"
                                                                    id="edit_nama_supplier{{ $supplier->id }}"
                                                                    value="{{ $supplier->nama_supplier }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="edit_alamat_supplier{{ $supplier->id }}"
                                                                class="form-control-label">Alamat Supplier</label>
                                                            <div class="form-group">
                                                                <input type="text" name="alamat_supplier"
                                                                    class="form-control"
                                                                    id="edit_alamat_supplier{{ $supplier->id }}"
                                                                    value="{{ $supplier->alamat_supplier }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="edit_email_supplier{{ $supplier->id }}"
                                                                class="form-control-label">Email Supplier</label>
                                                            <div class="form-group">
                                                                <input type="email" name="email_supplier"
                                                                    class="form-control"
                                                                    id="edit_email_supplier{{ $supplier->id }}"
                                                                    value="{{ $supplier->email_supplier }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="edit_nomor_telepon{{ $supplier->id }}"
                                                                class="form-control-label">Nomor Telepon</label>
                                                            <div class="form-group">
                                                                <input type="text" name="nomor_telepon"
                                                                    class="form-control"
                                                                    id="edit_nomor_telepon{{ $supplier->id }}"
                                                                    value="{{ $supplier->nomor_telepon }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="edit_tanggal_awal{{ $supplier->id }}"
                                                                class="form-control-label">Tanggal Awal</label>
                                                            <div class="form-group">
                                                                <input type="date" name="tanggal_awal"
                                                                    class="form-control"
                                                                    id="edit_tanggal_awal{{ $supplier->id }}"
                                                                    value="{{ $supplier->tanggal_awal }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="edit_tanggal_akhir{{ $supplier->id }}"
                                                                class="form-control-label">Tanggal Akhir</label>
                                                            <div class="form-group">
                                                                <input type="date" name="tanggal_akhir"
                                                                    class="form-control"
                                                                    id="edit_tanggal_akhir{{ $supplier->id }}"
                                                                    value="{{ $supplier->tanggal_akhir }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="edit_status{{ $supplier->id }}"
                                                                class="form-control-label">Status</label>
                                                            <div class="form-group">
                                                                <input type="text" name="status"
                                                                    class="form-control"
                                                                    id="edit_status{{ $supplier->id }}"
                                                                    value="{{ $supplier->status }}" required>
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-full px-4 flex flex-wrap justify-content-between pt-3">
                        <a class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                            Tambah Data
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <!-- Create Data Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Create Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('data-supplier.store') }}" method="POST">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="create_nama_supplier" class="form-control-label">Nama Supplier</label>
                                    <div class="form-group">
                                        <input type="text" name="nama_supplier" class="form-control"
                                            id="create_nama_supplier" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="create_alamat_supplier" class="form-control-label">Alamat Supplier</label>
                                    <div class="form-group">
                                        <input type="text" name="alamat_supplier" class="form-control"
                                            id="create_alamat_supplier" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="create_email_supplier" class="form-control-label">Email Supplier</label>
                                    <div class="form-group">
                                        <input type="email" name="email_supplier" class="form-control"
                                            id="create_email_supplier" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="create_nomor_telepon" class="form-control-label">Nomor Telepon</label>
                                    <div class="form-group">
                                        <input type="text" name="nomor_telepon" class="form-control"
                                            id="create_nomor_telepon" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="create_tanggal_awal" class="form-control-label">Tanggal Awal</label>
                                    <div class="form-group">
                                        <input type="date" name="tanggal_awal" class="form-control"
                                            id="create_tanggal_awal" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="create_tanggal_akhir" class="form-control-label">Tanggal Akhir</label>
                                    <div class="form-group">
                                        <input type="date" name="tanggal_akhir" class="form-control"
                                            id="create_tanggal_akhir" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="create_status" class="form-control-label">Status</label>
                                    <div class="form-group">
                                        <input type="text" name="status" class="form-control"
                                            id="create_status" required>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
