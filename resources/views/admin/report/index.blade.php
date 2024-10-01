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
                        <form action="{{ route('proyek.index') }}" method="get" class="d-inline">
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

        <!-- Section Table Proyek -->
        <div class="row">
            <div class="col-12">
                <div class="table-responsive card mb-4">
                    <table class="table align-items-center mb-0 table-hover" id="proyekTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Kode Proyek</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Nama Proyek</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Penanggung Jawab</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Bidang</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Keterangan</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proyek as $id => $data)
                            <tr>
                                <td class="text-uppercase text-dark text-center text-xs font-weight-bolder">{{ $id + 1 }}</td>
                                <td class="text-uppercase text-dark text-center text-xs font-weight-bolder">{{ $data->kode_proyek }}</td>
                                <td class="text-uppercase text-dark text-center text-xs font-weight-bolder">{{ $data->nama_proyek }}</td>
                                <td class="text-uppercase text-dark text-center text-xs font-weight-bolder">{{ $data->penanggung_jawab }}</td>
                                <td class="text-uppercase text-dark text-center text-xs font-weight-bolder">{{ $data->bidang }}</td>
                                <td class="text-uppercase text-dark text-center text-xs font-weight-bolder">{{ $data->tanggal->format('d-m-Y') }}</td>
                                <td class="text-uppercase text-dark text-center text-xs font-weight-bolder">
                                    @if(empty($data->keterangan))
                                        belum diisi
                                    @else
                                        telah diisi
                                    @endif
                                </td>
                                
                                <td class="text-uppercase text-dark text-center text-xs font-weight-bolder">{{ $data->status }}</td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
