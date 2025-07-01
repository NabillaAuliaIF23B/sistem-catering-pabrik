<div class="container">
    <h2>Ringkasan Karyawan</h2>

    <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Informasi Karyawan</div>  
        <div class="card-body">
            <p style="display: flex; align-items: baseline;">
                <span style="font-size: 28px; font-weight: bold;"><?php echo e($jumlahKeseluruhan); ?></span>
                <span style="font-size: 12px; margin-left: 6px;">Total Karyawan</span>
            </p>

            <p class="card-text">Karyawan Aktif: <?php echo e($jumlahAktif); ?></p> 
            <p class="card-text">Karyawan Nonaktif: <?php echo e($jumlahNonAktif); ?></p>  
        </div>
    </div>
</div>

<div class="card-body">
  <h5 class="card-title">
    Jumlah keseluruhan dari shift 1 sampai 3 : <?php echo e($jumlahKeseluruhan); ?>

  </h5>

  <p class="text-muted">Tanggal: <?php echo e($tanggalHariIni); ?></p>

  <p class="card-text">shift 1 = <?php echo e($totalPerShift->get('1', 0)); ?></p>
  <p class="card-text">shift 2 = <?php echo e($totalPerShift->get('2', 0)); ?></p>
  <p class="card-text">shift 3 = <?php echo e($totalPerShift->get('3', 0)); ?></p>  
</div>
<?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/index.blade.php ENDPATH**/ ?>