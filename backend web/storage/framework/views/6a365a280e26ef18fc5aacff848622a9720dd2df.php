<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Konsumsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Laporan Konsumsi</h2>

    <form method="POST" action="<?php echo e(route('laporan.konsumsi.filter')); ?>" class="mb-3">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="tipe">Filter Berdasarkan:</label>
            <select name="tipe" id="tipe" class="form-control w-25 d-inline-block">
                <option value="minggu" <?php echo e(isset($tipe) && $tipe == 'minggu' ? 'selected' : ''); ?>>Mingguan</option>
                <option value="bulan" <?php echo e(isset($tipe) && $tipe == 'bulan' ? 'selected' : ''); ?>>Bulanan</option>
            </select>
            <button type="submit" class="btn btn-primary ml-2">Filter</button>

            <?php if(isset($tipe)): ?>
                <a href="<?php echo e(route('laporan.konsumsi.pdf', ['tipe' => $tipe])); ?>" class="btn btn-danger ml-2" target="_blank">
                    Unduh PDF
                </a>
            <?php endif; ?>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Jumlah Validasi Dapur</th>
                <th>Jumlah Scan</th>
                <th>Sisa Makanan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($item->tanggal); ?></td>
                    <td><?php echo e(ucfirst(str_replace('_', ' ', $item->shift))); ?></td>
                    <td><?php echo e($item->jumlah_validasi_dapur); ?></td>
                    <td><?php echo e($item->jumlah_scan); ?></td>
                    <td><?php echo e($item->sisa_makanan ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/laporan/konsumsi.blade.php ENDPATH**/ ?>