<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Unduh Laporan PDF</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h4>Unduh Laporan Konsumsi PDF</h4>
  <form action="https://catering.kelompok47.my.id/laporan/pdf/download" method="POST" class="row g-3">
    <!-- Jika pakai token atau session, tambahkan token sebagai hidden input -->
    <!-- <input type="hidden" name="_token" value="CSRF_TOKEN"> -->

    <div class="col-md-3">
      <label for="filter" class="form-label">Lihat Berdasarkan</label>
      <select name="filter" id="filter" class="form-select" onchange="toggleFilter()" required>
        <option value="">-- Pilih --</option>
        <option value="minggu">Mingguan</option>
        <option value="bulan">Bulanan</option>
      </select>
    </div>

    <div class="col-md-3" id="form-minggu" style="display:none;">
      <label for="minggu" class="form-label">Tanggal Mulai Minggu</label>
      <input type="date" class="form-control" name="minggu" id="minggu">
    </div>

    <div class="col-md-3" id="form-bulan" style="display:none;">
      <label for="bulan" class="form-label">Pilih Bulan</label>
      <select name="bulan" id="bulan" class="form-select">
        <option value="">-- Pilih Bulan --</option>
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
      </select>
    </div>

    <div class="col-md-3 align-self-end">
      <button type="submit" class="btn btn-primary">Unduh PDF</button>
    </div>
  </form>
</div>

<script>
function toggleFilter() {
  const filter = document.getElementById('filter').value;
  document.getElementById('form-minggu').style.display = filter === 'minggu' ? 'block' : 'none';
  document.getElementById('form-bulan').style.display = filter === 'bulan' ? 'block' : 'none';
}
</script>
</body>
</html>
<?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/hrga/form.blade.php ENDPATH**/ ?>