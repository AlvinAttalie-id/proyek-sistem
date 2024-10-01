@extends('layouts.user_type.auth')
@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Section Searching -->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="breadcrumb-item text-sm font-weight-bolder text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</h6>
                    </div>
                    <div class="form-row w-full px-4 flex flex-wrap">
                        <form action="{{ route('skm.index') }}" method="get" class="d-inline">
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
                    <table class="table align-items-center mb-0 table-hover" id="barangMasukTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Penilaian Pegawai</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Penilaian Kegiatan</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Penilaian Program</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Total Penilaian</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Keterangan</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder col-auto">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($skm as $id => $data)
                            <tr>
                                <td class="text-center text-xs">{{ $id + 1 }}</td>
                                <td class="text-center text-xs">
                                    @switch($data->nilai1)
                                        @case(1)
                                            tidak bagus
                                            @break
                                        @case(2)
                                            kurang bagus
                                            @break
                                        @case(3)
                                            cukup bagus
                                            @break
                                        @case(4)
                                            bagus
                                            @break
                                        @case(5)
                                            sangat bagus
                                            @break
                                        @default
                                            nilai tidak valid
                                    @endswitch
                                </td>
                                
                                <td class="text-center text-xs">
                                    @switch($data->nilai2)
                                        @case(1)
                                            tidak bagus
                                            @break
                                        @case(2)
                                            kurang bagus
                                            @break
                                        @case(3)
                                            cukup bagus
                                            @break
                                        @case(4)
                                            bagus
                                            @break
                                        @case(5)
                                            sangat bagus
                                            @break
                                        @default
                                            nilai tidak valid
                                    @endswitch
                                </td>
                                
                                <td class="text-center text-xs">
                                    @switch($data->nilai3)
                                        @case(1)
                                            tidak bagus
                                            @break
                                        @case(2)
                                            kurang bagus
                                            @break
                                        @case(3)
                                            cukup bagus
                                            @break
                                        @case(4)
                                            bagus
                                            @break
                                        @case(5)
                                            sangat bagus
                                            @break
                                        @default
                                            nilai tidak valid
                                    @endswitch
                                </td>
                                <td class="text-center text-xs">
                                    <span class="badge text-white
                                        @if ($data->total_nilai >= 1 && $data->total_nilai <= 3) bg-danger
                                        @elseif ($data->total_nilai >= 4 && $data->total_nilai <= 6) bg-warning
                                        @elseif ($data->total_nilai >= 7 && $data->total_nilai <= 9) bg-info
                                        @elseif ($data->total_nilai >= 10 && $data->total_nilai <= 12) bg-info
                                        @elseif ($data->total_nilai >= 13 && $data->total_nilai <= 15) bg-success
                                        @else bg-secondary
                                        @endif">
                                        @if ($data->total_nilai >= 1 && $data->total_nilai <= 3)
                                            tidak bagus
                                        @elseif ($data->total_nilai >= 4 && $data->total_nilai <= 6)
                                            kurang bagus
                                        @elseif ($data->total_nilai >= 7 && $data->total_nilai <= 9)
                                            cukup bagus
                                        @elseif ($data->total_nilai >= 10 && $data->total_nilai <= 12)
                                            bagus
                                        @elseif ($data->total_nilai >= 13 && $data->total_nilai <= 15)
                                            sangat bagus
                                        @else
                                            nilai tidak valid
                                        @endif
                                    </span>
                                </td>                           
                                <td class="text-center text-xs">{{ $data->keterangan}}</td>
                                <td class="text-center text-xs">
                                    <a href="#" class="mx-0 text-center" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                                        <i class="fas fa-user-edit text-secondary"></i>
                                    </a>
                                    <form action="{{ route('skm.destroy', ['skm' => $data->id]) }}" method="POST" style="display:inline;">
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
                                            <form action="{{ route('skm.update', ['skm' => $data->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <label for="edit_nilai1{{ $data->id }}" class="form-control-label">Penilaian Pegawai</label>
                                                        <select name="nilai1" class="form-control" id="edit_nilai1{{ $data->id }}" required>
                                                            <option value="5" {{ $data->nilai1 == 5 ? 'selected' : '' }}>Sangat Bagus</option>
                                                            <option value="4" {{ $data->nilai1 == 4 ? 'selected' : '' }}>Bagus</option>
                                                            <option value="3" {{ $data->nilai1 == 3 ? 'selected' : '' }}>Cukup</option>
                                                            <option value="2" {{ $data->nilai1 == 2 ? 'selected' : '' }}>Kurang Bagus</option>
                                                            <option value="1" {{ $data->nilai1 == 1 ? 'selected' : '' }}>Tidak Bagus</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_nilai2{{ $data->id }}" class="form-control-label">Penilaian Kegiatan</label>
                                                        <select name="nilai2" class="form-control" id="edit_nilai2{{ $data->id }}" required>
                                                            <option value="5" {{ $data->nilai2 == 5 ? 'selected' : '' }}>Sangat Bagus</option>
                                                            <option value="4" {{ $data->nilai2 == 4 ? 'selected' : '' }}>Bagus</option>
                                                            <option value="3" {{ $data->nilai2 == 3 ? 'selected' : '' }}>Cukup</option>
                                                            <option value="2" {{ $data->nilai2 == 2 ? 'selected' : '' }}>Kurang Bagus</option>
                                                            <option value="1" {{ $data->nilai2 == 1 ? 'selected' : '' }}>Tidak Bagus</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_nilai3{{ $data->id }}" class="form-control-label">Penilaian Program</label>
                                                        <select name="nilai3" class="form-control" id="edit_nilai3{{ $data->id }}" required>
                                                            <option value="5" {{ $data->nilai3 == 5 ? 'selected' : '' }}>Sangat Bagus</option>
                                                            <option value="4" {{ $data->nilai3 == 4 ? 'selected' : '' }}>Bagus</option>
                                                            <option value="3" {{ $data->nilai3 == 3 ? 'selected' : '' }}>Cukup</option>
                                                            <option value="2" {{ $data->nilai3 == 2 ? 'selected' : '' }}>Kurang Bagus</option>
                                                            <option value="1" {{ $data->nilai3 == 1 ? 'selected' : '' }}>Tidak Bagus</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_tanggal_awal{{ $data->id }}" class="form-control-label">Tanggal Keluar</label>
                                                        <div class="form-group">
                                                            <input type="date" name="tanggal_awal" class="form-control" id="edit_tanggal_awal{{ $data->id }}" value="{{ $data->tanggal_awal }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="edit_tanggal_akhir{{ $data->id }}" class="form-control-label">Tanggal Keluar</label>
                                                        <div class="form-group">
                                                            <input type="date" name="tanggal_akhir" class="form-control" id="edit_tanggal_akhir{{ $data->id }}" value="{{ $data->tanggal_akhir }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="edit_keterangan{{ $data->id }}" class="form-control-label">Keterangan</label>
                                                        <div class="form-group">
                                                            <textarea name="keterangan" class="form-control" id="edit_keterangan{{ $data->id }}" rows="3" required>{{ $data->keterangan }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn bg-gradient-primary">Simpan</button>
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
                            {{ $skm->links('pagination::bootstrap-5') }}
                        </div>
                        <!-- Button trigger modal -->
                        <div class="w-full px-4 flex flex-wrap justify-content-between pt-3">
                            <a class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDataModal">
                                Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Data Modal -->
    <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('skm.store') }}" method="POST">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="nilai1" class="form-control-label">Penilaian Pegawai</label>
                                <select name="nilai1" class="form-control" id="nilai1" required>
                                    <option value="5">Sangat Bagus</option>
                                    <option value="4">Bagus</option>
                                    <option value="3">Cukup</option>
                                    <option value="2">Kurang Bagus</option>
                                    <option value="1">Tidak Bagus</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nilai2" class="form-control-label">Penilaian Kegiatan</label>
                                <select name="nilai2" class="form-control" id="nilai2" required>
                                    <option value="5">Sangat Bagus</option>
                                    <option value="4">Bagus</option>
                                    <option value="3">Cukup</option>
                                    <option value="2">Kurang Bagus</option>
                                    <option value="1">Tidak Bagus</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nilai3" class="form-control-label">Penilaian Program</label>
                                <select name="nilai3" class="form-control" id="nilai3" required>
                                    <option value="5">Sangat Bagus</option>
                                    <option value="4">Bagus</option>
                                    <option value="3">Cukup</option>
                                    <option value="2">Kurang Bagus</option>
                                    <option value="1">Tidak Bagus</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_awal" class="form-control-label">Tanggal Keluar</label>
                                <div class="form-group">
                                    <input type="date" name="tanggal_awal" class="form-control" id="tanggal_awal" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_akhir" class="form-control-label">Tanggal Keluar</label>
                                <div class="form-group">
                                    <input type="date" name="tanggal_akhir" class="form-control" id="tanggal_akhir" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="form-control-label">Keterangan</label>
                                <div class="form-group">
                                    <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
