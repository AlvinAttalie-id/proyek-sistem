@extends('layouts.user_type.auth')
@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Section Searching -->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="breadcrumb-item text-sm font-weight-bolder text-dark active text-capitalize" aria-current="page">
                            {{ str_replace('-', ' ', Request::path()) }}
                        </h6>
                    </div>
                    <div class="form-row w-full px-4 flex flex-wrap">
                        <form action="{{ route('pengajuan-barang.index') }}" method="get" class="d-inline">
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

        <!-- Section Table -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <table class="table align-items-center mb-0 table-hover" id="barangKeluarTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Kode Barang</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nama Barang</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Penanggung Jawab</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Jumlah Keluar</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Status</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder col-auto">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangKeluar as $id => $data)
                            @if($data->status == 'Diajukan')
                                    <tr>
                                        <td class="text-center text-xs">{{ $id + 1 }}</td>
                                        <td class="text-center text-xs">{{ $data->kode_barang }}</td>
                                        <td class="text-center text-xs">{{ $data->DataBarang->nama_barang ?? 'N/A' }}</td>
                                        <td class="text-center text-xs">{{ $data->penanggung_jawab }}</td>
                                        <td class="text-center text-xs">{{ $data->barang_keluar }}</td>
                                        <td class="text-center text-xs">{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                                        <td class="text-center text-xs">
                                            <span class="badge text-white" style="background-color:
                                                @if($data->status == 'Diajukan') #f0ad4e; /* warning color */
                                                @elseif($data->status == 'verifikasi') #5cb85c; /* success color */
                                                @else #cb0c9f; /* default or other status color */
                                                @endif">
                                                {{ $data->status }}
                                            </span>
                                        </td>
                                        <td class="text-center text-xs">
                                            <form action="{{ route('barang-keluar.verifikasi', $data->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn bg-gradient-success btn-sm mb-0" onclick="return confirm('Yakin ingin memverifikasi?')">
                                                    <i class="ti ti-check"></i> Verifikasi
                                                </button>
                                            </form>
                                            <!-- Form for rejecting the item -->
                                            <form action="{{ route('barang-keluar.tolak', $data->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn bg-gradient-danger btn-sm mb-0" onclick="return confirm('Yakin ingin menolak?')">
                                                    <i class="ti ti-x"></i> Tolak
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <!-- Pagination Links -->
                        <div class="mt-3">
                            {{ $barangKeluar->links('pagination::bootstrap-5') }}
                        </div>
                        <!-- Button trigger modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
