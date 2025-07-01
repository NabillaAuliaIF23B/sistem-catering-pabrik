
<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2>Scan QR Absensi Makan</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success mt-3">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger mt-3">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div id="qr-reader" style="width: 100%; max-width: 400px;"></div>

    <form id="qr-form" action="<?php echo e(route('scan.makan.submit')); ?>" method="POST" class="mt-4">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="qr_code" id="qr_code">
        <button type="submit" class="btn btn-success mt-2 d-none" id="submitBtn">Submit Otomatis</button>
    </form>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        document.getElementById('qr_code').value = decodedText;
        document.getElementById('qr-form').submit();
        html5QrCode.stop();
    };

    const html5QrCode = new Html5Qrcode("qr-reader");

    // Pilih kamera belakang (biasanya ID kamera belakang mengandung 'back')
    Html5Qrcode.getCameras().then(cameras => {
        if (cameras && cameras.length) {
            const backCamera = cameras.find(camera => camera.label.toLowerCase().includes('back')) || cameras[0];
            html5QrCode.start(
                backCamera.id,
                {
                    fps: 10,
                    qrbox: {
                        width: 300,  // Lebarkan kotak scan
                        height: 300
                    }
                },
                qrCodeSuccessCallback
            ).catch(err => {
                console.error('Gagal mulai kamera:', err);
            });
        }
    }).catch(err => {
        console.error('Gagal mendapatkan kamera:', err);
    });
</script>
<?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/scan-makan.blade.php ENDPATH**/ ?>