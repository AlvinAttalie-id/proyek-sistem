<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengadaan Barang</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
        }

        .rangkasurat {
            width: 980px;
            margin: 0 auto;
            background-color: #fff;
            border-bottom: 5px solid black;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .signature-container {
            margin-top: 20px;
            padding: 10px;
            position: relative;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td> <img src="{{ asset('assets/img/kalsel-logo.png') }}" width="50px"> </td>
                <td class="tengah">
                    <h2>DINAS PEMBERDAYAAN PEREMPUAN PERLINDUNGAN ANAK</h2>
                    <h2>DAN KELUARGA BERENCANA</h2>
                    <b>Jalan Dharma Praja Kawasan Perkantoran Pemerintah Provinsi Kalimantan Selatan</b>
                </td>
            </tr>
        </table>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h2>Laporan Data Barang Keluar</h2>

                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Periode: {{ request('tanggal_awal') }} - {{ request('tanggal_akhir') }}</h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Kode Barang</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Nama Supplier</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Jumlah Masuk</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Status</th>
                            </tr>
                            @foreach($barangKeluar as $index => $item)
                            <tr>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $index + 1 }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $item->kode_barang }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $item->nama_barang }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $item->penanggung_jawab }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $item->barang_keluar }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">{{ $item->status }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="signature-container">
                            <div style="width: 30%; float: right; text-align: right;">
                                <div class="text-left" style="text-align: center;">
                                    <script>
                                        // JavaScript code to get the current date
                                        var today = new Date();

                                        // Array of month names in Indonesian
                                        var monthNames = [
                                            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                                        ];

                                        // Formatting the date as "Banjarbaru, DD Month YYYY"
                                        var formattedDate =
                                            "Banjarbaru, " +
                                            today.getDate() + " " +
                                            monthNames[today.getMonth()] + " " +
                                            today.getFullYear();

                                        // Displaying the formatted date in the HTML
                                        document.write(formattedDate);
                                    </script>
                                    <br>Menyetujui 
                                    <br>Pengelola Biaya Proses
                                </div>
                                <div style="height: 100px;"></div>
                                <div class="text-left" style="text-align: center;">
                                    (.................................................................................)
                                    <br>Hj. Murnianti, S.H.
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    window.print();
</script>
