@extends('layouts.user_type.auth')

@section('content')
    <div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Users</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">No</th>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Name</th>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Email</th>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Phone</th>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Alamat</th>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Bidang</th>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal Aktif</th>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Tanggal Habi</th>
                                        <th class="text-uppercase text-dark text-center text-xs font-weight-bolder">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userManagement as $id => $data)

                                    <tr>
                                        <td class="text-center text-xs">{{ $id + 1 }}</td>
                                        <td class="text-center text-xs">{{ $data->name }}</td>
                                        <td class="text-center text-xs">{{ $data->email }}</td>
                                        <td class="text-center text-xs">
                                            @if(empty($data->phone))
                                                belum diisi
                                            @else
                                                {{$data->phone}}
                                            @endif
                                        </td>
                                        <td class="text-center text-xs">
                                            @if(empty($data->location))
                                                belum diisi
                                            @else
                                                {{$data->location}}
                                            @endif
                                        </td>
                                        <td class="text-center text-xs">
                                            @if(empty($data->bidang))
                                                belum diisi
                                            @else
                                                {{ $data->bidang}}
                                            @endif
                                        </td>
                                        <td class="text-center text-xs">
                                            @if(empty($data->tanggal_awal))
                                                belum diisi
                                            @else
                                                {{ $data->tanggal_awal}}
                                            @endif
                                        </td>
                                        <td class="text-center text-xs">
                                            @if(empty($data->tanggal_akhir))
                                                belum diisi
                                            @else
                                                {{ $data->tanggal_akhir}}
                                            @endif
                                        </td>
                                        <td class="text-center text-xs">
                                            
                                        </td>
                                    </tr>
                            @endforeach
                                </tbody>
                            </table>
                            <div class="w-full px-4 flex flex-wrap justify-between pt-3">

                                <a href="#" class="btn bg-gradient-success btn-sm"><i class="ti ti-printer"></i> Cetak
                                    Data</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
