@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="breadcrumb-item text-sm font-weight-bolder text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</h6>
                </div>
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-hover">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Dana Masuk</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Dana Keluar</th>
                                <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggaran as $no => $data)
                                <tr>
                                    <td class="text-uppercase text-secondary text-center text-xs font-weight-bolder">{{ $no + 1 }}</td>
                                    <td class="text-uppercase text-success text-center text-xs font-weight-bolder">Rp. {{ number_format($data->dana_masuk, 2, ',', '.') }}</td>
                                    <td class="text-uppercase text-danger text-center text-xs font-weight-bolder">Rp. {{ number_format($data->dana_keluar, 2, ',', '.') }}</td>
                                    <td class="text-uppercase text-success text-center text-xs font-weight-bolder">Rp. {{ number_format($data->total_dana, 2, ',', '.') }}</td>
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
                                                <form action="{{ route('anggaran.update', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="dana_masuk{{ $data->id }}" class="form-label">Dana Masuk</label>
                                                        <input type="text" class="form-control" id="dana_masuk{{ $data->id }}" name="dana_masuk" value="{{ $data->dana_masuk }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="dana_keluar{{ $data->id }}" class="form-label">Dana Keluar</label>
                                                        <input type="text" class="form-control" id="dana_keluar{{ $data->id }}" name="dana_keluar" value="{{ $data->dana_keluar }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-full px-4 flex flex-wrap justify-content-between pt-3">
                      <button class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Data Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('anggaran.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="dana_masuk" class="form-label">Dana Masuk</label>
                        <input type="text" class="form-control" id="dana_masuk" name="dana_masuk" required>
                    </div>
                    <div class="mb-3">
                        <label for="dana_keluar" class="form-label">Dana Keluar</label>
                        <input type="text" class="form-control" id="dana_keluar" name="dana_keluar" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
