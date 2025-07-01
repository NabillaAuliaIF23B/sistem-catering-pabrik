<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scan QR Makan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>
<body>
    <h2>Scan QR Makanan</h2>

    <!-- Loading message saat submit -->
    <div id="loadingMessage" style="display:none; color: green; font-weight: bold;">
        Memproses scan, mohon tunggu...
    </div>

    <!-- Notifikasi pesan dari session -->
    <?php if(session('message')): ?>
        <div class="alert" style="margin-top:10px; color: red;">
            <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?>

    <label for="cameraSelect">Pilih Kamera:</label>
    <select id="cameraSelect"></select>

    <!-- Area scan QR -->
    <div id="reader" style="width: 100%; max-width: 350px; margin-top: 10px;"></div>

    <!-- Form tersembunyi -->
    <form id="scanForm" action="<?php echo e(route('scan.qr.submit')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id_karyawan" id="id_karyawan">
    </form>

    <script>
        const readerElementId = "reader";
        const cameraSelect = document.getElementById('cameraSelect');
        let html5QrCode;
        let currentCameraId = null;
        let hasScanned = false; // Kunci agar tidak double submit

        function onScanSuccess(decodedText) {
            if (hasScanned) return;

            try {
                const data = JSON.parse(decodedText);
                const idKaryawan = data.id_karyawan;

                if (!idKaryawan) {
                    alert("QR Code tidak valid. ID karyawan tidak ditemukan.");
                    return;
                }

                hasScanned = true;
                document.getElementById('loadingMessage').style.display = 'block';
                document.getElementById('id_karyawan').value = idKaryawan;
                document.getElementById('scanForm').submit();

                if (html5QrCode) {
                    html5QrCode.stop().then(() => html5QrCode.clear());
                }
            } catch (e) {
                alert("QR Code bukan format JSON yang dikenali.");
            }
        }

        function onScanError(errorMessage) {
            // Bisa diabaikan atau ditampilkan untuk debug
        }

        function startScanner(cameraId) {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear().then(() => {
                        html5QrCode.start(cameraId, { fps: 10, qrbox: 250 }, onScanSuccess, onScanError);
                    });
                }).catch(err => console.error("Gagal menghentikan kamera:", err));
            } else {
                html5QrCode = new Html5Qrcode(readerElementId);
                html5QrCode.start(cameraId, { fps: 10, qrbox: 250 }, onScanSuccess, onScanError);
            }
        }

        // Dapatkan daftar kamera
        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                cameraSelect.innerHTML = '';

                devices.forEach((device, index) => {
                    const option = document.createElement('option');
                    option.value = device.id;

                    const label = device.label.toLowerCase();
                    if (label.includes('back') || label.includes('environment')) {
                        option.text = 'Kamera Belakang';
                    } else if (label.includes('front') || label.includes('user')) {
                        option.text = 'Kamera Depan';
                    } else {
                        option.text = `Kamera ${index + 1}`;
                    }

                    cameraSelect.appendChild(option);
                });

                // Pilih default kamera belakang jika ada
                const defaultCamera = devices.find(d =>
                    d.label.toLowerCase().includes('back') ||
                    d.label.toLowerCase().includes('environment')
                ) || devices[0];

                currentCameraId = defaultCamera.id;
                cameraSelect.value = currentCameraId;
                startScanner(currentCameraId);

                cameraSelect.addEventListener('change', function () {
                    currentCameraId = this.value;
                    startScanner(currentCameraId);
                });
            } else {
                alert("Tidak ada kamera ditemukan.");
            }
        }).catch(err => {
            console.error("Gagal mendapatkan kamera:", err);
            alert("Tidak dapat mengakses kamera. Pastikan browser memiliki izin kamera dan menggunakan HTTPS atau localhost.");
        });
    </script>
</body>
</html>


<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scan QR Makan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>
<body>
    <h2>Scan QR Makanan</h2>

    <?php if(session('message')): ?>
        <div class="alert"><?php echo e(session('message')); ?></div>
    <?php endif; ?>

    <label for="cameraSelect">Pilih Kamera:</label>
    <select id="cameraSelect"></select>

    <div id="reader" style="width: 100%; max-width: 350px;"></div>

    <form id="scanForm" action="<?php echo e(route('scan.qr.submit')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id_karyawan" id="id_karyawan">
    </form>

    <script>
        const readerElementId = "reader";
        const cameraSelect = document.getElementById('cameraSelect');
        let html5QrCode;
        let currentCameraId = null;

        function onScanSuccess(decodedText) {
            try {
                const data = JSON.parse(decodedText); // QR code HARUS format JSON
                const idKaryawan = data.id_karyawan;

                if (!idKaryawan) {
                    alert("QR Code tidak valid. ID karyawan tidak ditemukan.");
                    return;
                }

                document.getElementById('id_karyawan').value = idKaryawan;
                document.getElementById('scanForm').submit();
            } catch (e) {
                alert("QR Code bukan format yang dikenali (bukan JSON).");
            }
        }

        function onScanError(errorMessage) {
            // Bisa diabaikan, untuk logging
        }

        function startScanner(cameraId) {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear().then(() => {
                        html5QrCode.start(cameraId, { fps: 10, qrbox: 250 }, onScanSuccess, onScanError);
                    });
                }).catch(err => console.error("Gagal menghentikan kamera:", err));
            } else {
                html5QrCode = new Html5Qrcode(readerElementId);
                html5QrCode.start(cameraId, { fps: 10, qrbox: 250 }, onScanSuccess, onScanError);
            }
        }

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                cameraSelect.innerHTML = '';

                devices.forEach((device, index) => {
                    const option = document.createElement('option');
                    option.value = device.id;

                    const label = device.label.toLowerCase();
                    if (label.includes('back') || label.includes('environment')) {
                        option.text = 'Kamera Belakang';
                    } else if (label.includes('front') || label.includes('user')) {
                        option.text = 'Kamera Depan';
                    } else {
                        option.text = `Kamera ${index + 1}`;
                    }

                    cameraSelect.appendChild(option);
                });

                const defaultCamera = devices.find(d =>
                    d.label.toLowerCase().includes('back') ||
                    d.label.toLowerCase().includes('environment')
                ) || devices[0];

                currentCameraId = defaultCamera.id;
                cameraSelect.value = currentCameraId;
                startScanner(currentCameraId);

                cameraSelect.addEventListener('change', function () {
                    currentCameraId = this.value;
                    startScanner(currentCameraId);
                });
            } else {
                alert("Tidak ada kamera ditemukan.");
            }
        }).catch(err => {
            console.error("Gagal mendapatkan kamera:", err);
            alert("Tidak dapat mengakses kamera. Pastikan browser memiliki izin kamera.");
        });
    </script>
</body>
</html>--><?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/scan.blade.php ENDPATH**/ ?>