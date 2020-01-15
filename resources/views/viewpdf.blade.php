<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style type="text/css">
        table td, table th{
            border:1px solid black;
        }
    </style>
</head>

<body>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Kembali</th>
                <th>Kode Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Jumlah Hari</th>
                <th>Total Denda</th>
                <th>Petugas</th>
                <th>Angoota</th>
                <th>Buku</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1 @endphp
            @foreach ($pengembalian as $data)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->kode_kembali }}</td>
            <td>{{ $data->peminjaman->kode_pinjam }}</td>
            <td>{{ $data->peminjaman->jatuh_tempo }}</td>
            <td>{{ $data->jumlah_hari }}</td>
            <td>{{ $data->total_denda }}</td>
            <td>{{ $data->petugas->nama }}</td>
            <td>{{ $data->anggota->nama }}</td>
            <td>
                <ol>
                    @foreach ($data->peminjaman->buku as $value)
                        <li>{{$value->judul}}</li>
                    @endforeach
                </ol>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
