<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Survey Kepuasan Masyarakat</title>
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

        th,
        td {
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

        /* Media print untuk memastikan ukuran canvas stabil saat cetak */
        @media print {
            canvas {
                display: block;
                width: 500px;
                height: 300px;
                margin: 0 auto;
            }
        }

        /* Menetapkan ukuran tetap pada canvas untuk tampilan normal (di layar) */
        canvas {
            display: block;
            width: 500px;
            height: 300px;
            margin: 0 auto;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td><img src="{{ asset('assets/img/kalsel-logo.png') }}" width="50px"></td>
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
                <h2>Laporan Data Survey Kepuasan Masyarakat</h2>

                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Periode: {{ request('tanggal_awal') }} - {{ request('tanggal_akhir') }}</h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No</th>
                                <th>Penilaian Pegawai</th>
                                <th>Penilaian Kegiatan</th>
                                <th>Penilaian Program</th>
                                <th>Total Penilaian</th>
                                <th>Keterangan</th>
                            </tr>
                            @foreach ($skm as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
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
                                    <td>
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
                                    <td>
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
                                    <td>
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
                                    </td>
                                    <td>{{ $data->keterangan }}</td>
                            @endforeach
                        </table>
                    </div>

                    <!-- Diagram Penilaian -->
                    <div>
                        <h3>Diagram Penilaian Survey Kepuasan Masyarakat</h3>
                        <canvas id="surveyChart"></canvas>
                    </div>

                    <div class="signature-container">
                        <div style="width: 30%; float: right; text-align: right;">
                            <div class="text-left" style="text-align: center;">
                                <script>
                                    var today = new Date();
                                    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
                                        "November", "Desember"
                                    ];
                                    var formattedDate = "Banjarbaru, " + today.getDate() + " " + monthNames[today.getMonth()] + " " + today
                                    .getFullYear();
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

    <!-- Script to create the chart -->
    <script>
        var ctx = document.getElementById('surveyChart').getContext('2d');
        var surveyChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Tidak Bagus (1-3)', 'Kurang Bagus (4-6)', 'Cukup Bagus (7-9)', 'Bagus (10-12)',
                    'Sangat Bagus (13-15)'
                ],
                datasets: [{
                    label: 'Distribusi Penilaian',
                    data: [12, 28, 40, 35, 25], // Contoh data penilaian
                    backgroundColor: ['#ff9999', '#66b3ff', '#99ff99', '#ffcc99', '#c2c2f0'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Supaya grafik tetap proporsional
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });

        // Print the document
        window.print();
    </script>
</body>

</html>
