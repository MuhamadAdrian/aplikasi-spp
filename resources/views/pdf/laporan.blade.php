<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
</head>
    <style>
        *{
            margin: 0;
            padding: 0;
            left: 0;
            top: 0;
        }

        body{
            padding: 60px
        }
        td{
            padding: 2px 5px
        }
        .main table, .main td, .main th{
            border: 0.5px solid rgb(99, 99, 99);
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            text-align: left
        }
        table thead tr{
            background-color: rgb(95, 95, 95);
            color: white
        }
        .main td, .main th{
            padding: 10px 5px;
            width: inherit
        }
        .main th{
            text-align: center
        }
        .text-center{
            text-align: center !important
        }
        .mb-4{
            margin-bottom: 5px
        }
        .header{
            border-bottom: 4px double rgb(27, 27, 27)
        }
    </style>
<body>
    <div class="header" style="margin-bottom: 30px; padding-bottom: 15px">
        <div class="cop text-center">
            <h5 class="mb-4 text-head-cop" style="font-size: 18px">SMK NEGERI 2 KOTA BANDUNG</h5>
            <p class="mb-4 text-cop" style="font-size: 14px ">Jalan Ciliwung no.4</p>
            <p class="mb-4 text-cop" style="font-size: 14px">Kota Bandung</p>
            <p class="mb-4 text-cop" style="font-size: 14px">022 - 84758375</p>
        </div>
    </div>
    <div class="date-and-information" style="margin-bottom: 30px; display: flex">
        <div class="main-information">
            <table style="font-size: 14px">
                <tr>
                    <td>Data tahun</td>
                    <td>:</td>
                    <td>{{ $tahun }}</td>
                </tr>
                <tr>
                    <td>Data bulan</td>
                    <td>:</td>
                    <td>{{ $bulan }}</td>
                </tr>
                <tr>
                    <td>Total Pemasukan</td>
                    <td>:</td>
                    <td>@currency($total_pemasukan)</td>
                </tr>
                <tr>
                    <td>Total Tunggakan</td>
                    <td>:</td>
                    <td>@currency($total_tunggakan)</td>
                </tr>
            </table>
        </div>
        <p style="font-size: 14px; text-align:right;">
            <span>Tanggal Cetak : {{ now()->isoFormat("DD MMMM Y") }}</span>
        </p>
    </div>
    <div class="main">

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>SPP</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Uang Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histori as $data)
                <tr style="@if($data->status == "belum lunas") background-color: yellow @endif">
                    <td class="text-center" style="width: 100px">{{ \Carbon\Carbon::parse($data->tgl_bayar)->isoFormat("DD MMMM Y") }}</td>
                    <td>{{ $data->siswa->nama }}</td>
                    <td class="text-center" style="width: 60px">{{ $data->siswa->kelas->nama_kelas }}</td>
                    @if (!$data->spp)
                        <td class="text-center" style="width: 30px">Data SPP hilang</td>
                        @else
                        <td class="text-center" style="width: 30px">{{ $data->spp->tahun }}</td>
                    @endif
                    <td class="text-center" style="width: 60px">{{ $data->bulan_dibayar }}</td>
                    <td class="text-center" style="width: 30px">{{ $data->tahun_dibayar }}</td>
                    <td class="text-center" style="width: 70px">@currency($data->jumlah_masuk)</td>
                    <td class="text-center" style="width: 40px">{{ $data->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>