<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Proyek</title>
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
                <td><img src="{{ asset('assets/img/kalsel-logo.png') }}" width="50px"></td>
                <td class="tengah">
                    <h2>DINAS PEMBERDAYAAN PEREMPUAN PERLINDUNGAN ANAK DAN KELUARGA BERENCANA</h2>
                    <b>Jalan Dharma Praja Kawasan Perkantoran Pemerintah Provinsi Kalimantan Selatan</b>
                </td>
            </tr>
        </table>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h2>Laporan Data Proyek</h2>
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Kode Proyek</th>
                        <td>{{ $proyek->kode_proyek }}</td>
                    </tr>
                    <tr>
                        <th>Nama Proyek</th>
                        <td>{{ $proyek->nama_proyek }}</td>
                    </tr>
                    <tr>
                        <th>Penanggung Jawab</th>
                        <td class="">{{ $proyek->penanggung_jawab }}</td>
                    </tr>
                    <tr>
                        <th>Bidang</th>
                        <td>{{ $proyek->bidang }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $proyek->tanggal->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $proyek->status }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $proyek->keterangan ?? 'belum diisi' }}</td>
                    </tr>
                </table>
                <!-- Signature and print script -->
                <div class="signature-container">
                    <div style="width: 30%; float: right; text-align: right;">
                        <div class="text-left" style="text-align: center;">
                            <script>
                                var today = new Date();
                                var monthNames = [
                                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                                ];
                                var formattedDate =
                                    "Banjarbaru, " +
                                    today.getDate() + " " +
                                    monthNames[today.getMonth()] + " " +
                                    today.getFullYear();
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
</body>
</html>
<script>
    window.print();
</script>
