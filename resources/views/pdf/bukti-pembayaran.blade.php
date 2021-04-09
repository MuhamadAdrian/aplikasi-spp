<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembayaran</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            left: 0;
            top: 0
        }
        body{
            padding: 60px
        }
        .flex-container{
            display: flex;
        }
        .title{
            font-size: 18px;
            text-align: center;
            text-transform: uppercase;
            padding: 10px;
            font-weight: bold;
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            margin-bottom: 10px
        }
        td{
            padding: 5px 8px 5px 0px
        }
        .mb-4{
            margin-bottom: 5px
        }
        th{
            text-align: left
        }
    </style>
</head>
<body>
    <div class="header" style="margin-bottom: 10px; padding-bottom: 15px">
        <div style="text-align: center">
            <h5 class="mb-4 text-head-cop" style="font-size: 18px">SMK NEGERI 2 KOTA BANDUNG</h5>
            <p class="mb-4 text-cop" style="font-size: 14px ">Jalan Ciliwung no.4</p>
            <p class="mb-4 text-cop" style="font-size: 14px">Kota Bandung</p>
        </div>
    </div>
    <p class="title">Bukti Pembayaran SPP Siswa</p>

    <div class="flex-container" >
        <table>
            <tr>
                <td>No</td>
                <td>:</td>
                <td>{{ $histori->id }}/{{ now()->isoFormat("Y") }}/SPP/{{ $histori->siswa->nisn }}</td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>{{ $histori->siswa->nama }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td>{{ $histori->siswa->nisn }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $histori->siswa->kelas->nama_kelas }}</td>
            </tr>
        </table>
        <table style="margin-left: auto">
            <tr>
                <td>SPP Tahun</td>
                <td>:</td>
                <td>{{ $histori->spp->tahun }} - @currency($histori->spp->nominal)</td>
            </tr>
            <tr>
                <td>Tahun Bayar</td>
                <td>:</td>
                <td>{{ $histori->tahun_dibayar }}</td>
            </tr>
            <tr>
                <td>Bulan Bayar</td>
                <td>:</td>
                <td>{{ $histori->bulan_dibayar }}</td>
            </tr>
            <tr>
                <td>Tanggal Bayar</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($histori->tgl_bayar)->isoFormat("DD/MM/Y")  }}</td>
            </tr>
        </table>
    </div>

    <div style="width: 100%; border-bottom: 2px solid #333; margin: 10px 0"></div>
    
    <div style="padding: 20px 0 40px 0">
        <table style="width: 100%; text-align:left">
            <thead >
                <tr>
                    <th>Keterangan</th>
                    <th>Nominal Yang Harus Dibayar</th>
                    <th>Uang Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pembayaran SPP</td>
                    <td>@currency($histori->jumlah_dibayar)</td>
                    <td>@currency($histori->jumlah_masuk)</td>
                    @if ($histori->status == 'belum lunas')
                        <td >Menyicil</td>
                    @else
                        <td >Lunas</td>
                    @endif
                </tbody>
            </table>
    </div>
    
    <div class="flex-container" style="padding-top: 40px">
        <div style="margin-left: auto; width: 200px">
            <div>
                <p>Bandung, {{ now()->isoFormat('DD MMMM Y') }}</p>
                <div style="height: 100px; border-bottom: 2px solid #333"></div>
                <p style="margin-top: 5px">{{ $histori->petugas->nama_petugas }}</p>
            </div>
        </div>
    </div>

    <div style="width: 100%; border-bottom: 2px dotted #333; margin: 10px 0"></div>
</body>
</html>