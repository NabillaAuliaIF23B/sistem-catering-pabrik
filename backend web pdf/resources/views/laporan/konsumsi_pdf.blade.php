<!DOCTYPE html>
<html>
<head>
    <title>Laporan Konsumsi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
    </style>
</head>
<body>
    <h3>Laporan Konsumsi - {{ ucfirst($tipe) }}</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Validasi</th>
                <th>Scan</th>
                <th>Sisa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->tanggal }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $row->shift)) }}</td>
                <td>{{ $row->jumlah_validasi_dapur }}</td>
                <td>{{ $row->jumlah_scan }}</td>
                <td>{{ $row->sisa_makanan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
