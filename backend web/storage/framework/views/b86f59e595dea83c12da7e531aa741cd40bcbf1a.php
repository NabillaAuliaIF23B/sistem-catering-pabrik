<?php if($belumAmbil->count()): ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Karyawan</th>
            <th>Shift</th>
            <th>Tanggal</th>
            <th>Status Pesanan</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $belumAmbil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->karyawan->nama ?? '-'); ?></td>
                <td><?php echo e($shift); ?></td>
                <td><?php echo e(date('d-m-Y', strtotime($tanggal))); ?></td>
                <td><?php echo e($item->pesananMakanan->status ?? '-'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>
<?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/belum-ambil.blade.php ENDPATH**/ ?>