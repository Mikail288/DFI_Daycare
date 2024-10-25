<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Anak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    @if(empty($child) || empty($histories))
        <p>Data tidak tersedia</p>
    @else
        <h1>Riwayat {{ $child->nama }}</h1>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Makan</th>
                    <th>Susu</th>
                    <th>Air Putih</th>
                    <th>BAK</th>
                    <th>BAB</th>
                    <th>Tidur</th>
                    <th>Kondisi Anak</th>
                    <th>Kegiatan Outdoor</th>
                    <th>Kegiatan Indoor</th>
                    <th>Obat</th>
                    <th>Makanan Camilan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($history->tanggal)->format('d/m/Y') }}</td>
                        <td>
                            Pagi: {{ $history->makan_pagi ?? 'Belum' }}<br>
                            Siang: {{ $history->makan_siang ?? 'Belum' }}<br>
                            Sore: {{ $history->makan_sore ?? 'Belum' }}
                        </td>
                        <td>
                            Pagi: {{ $history->susu_pagi ?? '-' }} ml<br>
                            Siang: {{ $history->susu_siang ?? '-' }} ml<br>
                            Sore: {{ $history->susu_sore ?? '-' }} ml
                        </td>
                        <td>
                            Pagi: {{ $history->air_putih_pagi ?? '-' }} ml<br>
                            Siang: {{ $history->air_putih_siang ?? '-' }} ml<br>
                            Sore: {{ $history->air_putih_sore ?? '-' }} ml
                        </td>
                        <td>
                            Pagi: {{ $history->bak_pagi ?? '-' }} X<br>
                            Siang: {{ $history->bak_siang ?? '-' }} X<br>
                            Sore: {{ $history->bak_sore ?? '-' }} X
                        </td>
                        <td>
                            Pagi: {{ $history->bab_pagi ?? '-' }} X<br>
                            Siang: {{ $history->bab_siang ?? '-' }} X<br>
                            Sore: {{ $history->bab_sore ?? '-' }} X
                        </td>
                        <td>
                            Pagi: {{ $history->tidur_pagi ?? '-' }} X<br>
                            Siang: {{ $history->tidur_siang ?? '-' }} X<br>
                            Sore: {{ $history->tidur_sore ?? '-' }} X
                        </td>
                        <td>{{ $history->kondisi ?? '-' }}</td>
                        <td>
                            @php
                                $kegiatanOutdoor = json_decode($history->kegiatan_outdoor, true) ?? [];
                            @endphp
                            @if(count($kegiatanOutdoor) > 0)
                                @foreach($kegiatanOutdoor as $kegiatan)
                                    - {{ $kegiatan }}<br>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @php
                                $kegiatanIndoor = json_decode($history->kegiatan_indoor, true) ?? [];
                            @endphp
                            @if(count($kegiatanIndoor) > 0)
                                @foreach($kegiatanIndoor as $kegiatan)
                                    - {{ $kegiatan }}<br>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            Pagi: {{ $history->obat_pagi ?? '-' }}<br>
                            Siang: {{ $history->obat_siang ?? '-' }}<br>
                            Sore: {{ $history->obat_sore ?? '-' }}
                        </td>
                        <td>
                            @php
                                $camilanPagi = json_decode($history->makanan_camilan_pagi, true) ?? [];
                                $camilanSiang = json_decode($history->makanan_camilan_siang, true) ?? [];
                                $camilanSore = json_decode($history->makanan_camilan_sore, true) ?? [];
                            @endphp
                            Pagi: <br>
                            @if(count($camilanPagi) > 0)
                                @foreach($camilanPagi as $camilan)
                                    - {{ $camilan }}<br>
                                @endforeach
                            @else
                                - <br>
                            @endif
                            Siang:<br>
                            @if(count($camilanSiang) > 0)
                                @foreach($camilanSiang as $camilan)
                                    - {{ $camilan }}<br>
                                @endforeach
                            @else
                                - <br>
                            @endif
                            Sore:<br>
                            @if(count($camilanSore) > 0)
                                @foreach($camilanSore as $camilan)
                                    - {{ $camilan }}<br>
                                @endforeach
                            @else
                                - <br>
                            @endif
                        </td>
                        <td>{{ $history->keterangan ?? 'Tidak ada' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
