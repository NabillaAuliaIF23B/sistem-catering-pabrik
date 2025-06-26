<!DOCTYPE html>
<html>
<head>
    <title>Laporan Konsumsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2 class="mb-4">Laporan Konsumsi</h2>

    <form method="POST" action="{{ url('/laporan/filter') }}" class="mb-3">
    @csrf
    <div class="form-group d-flex align-items-center">
        <label for="tipe" class="me-2">Filter:</label>
        <select name="tipe" id="tipe" class="form-select w-auto me-2">
            <option value="minggu" {{ (old('tipe', $tipe ?? '') === 'minggu') ? 'selected' : '' }}>Per Minggu</option>
            <option value="bulan" {{ (old('tipe', $tipe ?? '') === 'bulan') ? 'selected' : '' }}>Per Bulan</option>
        </select>

        <input type="date" name="tanggal_minggu" class="form-control w-auto me-2" value="{{ request('tanggal_minggu') }}">
        <input type="month" name="bulan_manual" class="form-control w-auto me-2" value="{{ request('bulan_manual') }}">

        <button class="btn btn-primary me-2">Tampilkan</button>

        @if(isset($tipe))
            <a href="{{ url('/laporan/pdf?tipe=' . $tipe . '&tanggal_minggu=' . request('tanggal_minggu') . '&bulan_manual=' . request('bulan_manual')) }}"
               target="_blank" class="btn btn-danger">Unduh PDF</a>
        @endif
    </div>
</form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Validasi Dapur</th>
                <th>Scan</th>
                <th>Sisa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $row)
                <tr>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $row->shift)) }}</td>
                    <td>{{ $row->jumlah_validasi_dapur }}</td>
                    <td>{{ $row->jumlah_scan }}</td>
                    <td>{{ $row->sisa_makanan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
