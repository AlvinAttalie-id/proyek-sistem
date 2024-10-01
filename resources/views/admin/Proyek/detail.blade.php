@extends('layouts.user_type.auth')

@section('content')
<main>
    <body>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Project Details</h5>
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 text-center">
                                    @if($proyek->foto)
                                        <!-- Menampilkan gambar yang disimpan sebagai longblob -->
                                        <img class="w-100 border-radius-lg shadow-lg mx-auto"
                                             src="data:image/jpeg;base64,{{ base64_encode($proyek->foto) }}"
                                             alt="Gambar Proyek">
                                    @else
                                        <!-- Placeholder image jika tidak ada foto -->
                                        <img class="w-100 border-radius-lg shadow-lg mx-auto"
                                             src="https://images.unsplash.com/photo-1616627781431-23b776aad6b2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1884&amp;q=80"
                                             alt="chair">
                                    @endif
                                </div>                                
                                <div class="col-lg-5 mx-auto">
                                    <blockquote class="blockquote">
                                    <h3 class="mt-lg-0 mt-4">{{ $proyek->nama_proyek }}</h3>
                                    </blockquote>
                                    <br>
                                    <h4 class="mb-0">Penanggung Jawab</h4>
                                    <h5>{{ $proyek->penanggung_jawab }}</h5>
                                    <h6>{{ $proyek->bidang }}</h6>
                                    <h6>{{ $proyek->tanggal }}</h6>
                                    <br>
                                    <h5 class="mt-0">Keterangan</h5>
                                    <p>
                                        {{ $proyek->keterangan ?? 'belum diisi' }}
                                    </p>
                                    <br />
                                    <div class="row mt-4">
                                </div>
                            </div>
                            <div class="table-responsive card mb-4 mt-4">
                                <h2>Laporan Data Proyek</h2>
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Kode Proyek</th>
                                        <td>{{ $proyek->kode_proyek }}</td>
                                    </tr>
                                    <tr>
                                        <th>Barang</th>
                                        <td>{{ $proyek->DataBarang->nama_barang ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah</th>
                                        <td>{{ $proyek->jumlah ?? 'belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Anggaran Keluar</th>
                                        <td>{{ $proyek->total_harga ?? 'belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $proyek->status }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</main>
@endsection
{{-- <script>
    window.print();
</script> --}}
