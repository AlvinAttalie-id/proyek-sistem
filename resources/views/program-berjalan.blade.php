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
                
                    <form action="report/pengadaan_export_filter.php" method="get" class="d-inline">
                        <div class="form-row row mb-3">
                            <div class="col-md-5">
                                <label for="selectMonth">Tanggal Awal:</label>
                                <input type="date" class="form-control" name="tanggal_awal" required>
                            </div>
                            <div class="col-md-5">
                                <label for="selectMonth">Tanggal Akhir:</label>
                                <input type="date" class="form-control" name="tanggal_akhir" required>
                            </div>
                            <div class="col-md-5 pt-3">
                                <button type="submit" href="#" class="btn bg-gradient-primary btn-sm mb-0" name="cetak">+&nbsp; Cetak</button>
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
          <div class="card mb-4">
            <table class="table align-items-center mb-0 table-hover" id="pengadaanTable">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Pengadaan</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Proyek</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Barang</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Dibuat</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penanggung Jawab</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                </thead>
            </table>
            <div class=" w-full px-4 flex flex-wrap justify-content-between pt-3">
              <a href="#" class="btn bg-gradient-primary btn-sm"><i class="ti ti-plus"></i> Tambah Data</a>
              <a href="#" class="btn bg-gradient-success btn-sm"><i class="ti ti-printer"></i> Cetak Data</a>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  @endsection
