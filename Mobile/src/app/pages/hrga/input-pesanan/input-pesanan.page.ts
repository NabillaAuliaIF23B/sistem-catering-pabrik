import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AlertController } from '@ionic/angular';
import { Geolocation } from '@capacitor/geolocation';
import { AuthService } from 'src/app/services/auth.service';

function getDistanceFromLatLonInMeters(lat1: number, lon1: number, lat2: number, lon2: number): number {
  const R = 6371e3; // Radius bumi dalam meter
  const toRad = (deg: number) => deg * (Math.PI / 180);
  const dLat = toRad(lat2 - lat1);
  const dLon = toRad(lon2 - lon1);
  const a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
    Math.sin(dLon / 2) * Math.sin(dLon / 2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  return R * c;
}

@Component({
  standalone: false,
  selector: 'app-input-pesanan',
  templateUrl: './input-pesanan.page.html',
  styleUrls: ['./input-pesanan.page.scss'],
})
export class InputPesananPage implements OnInit {
  form!: FormGroup;
  jarak: number | null = null;
  lokasiKantor: { latitude: number; longitude: number } | null = null;

  constructor(
    private fb: FormBuilder,
    private alertCtrl: AlertController,
    private api: AuthService
  ) {}

  ngOnInit() {
    this.form = this.fb.group({
      tanggal: ['', Validators.required],
      shift: ['', Validators.required],
      jumlah_pesanan: ['', [Validators.required, Validators.min(1)]],
      latitude: [''],
      longitude: [''],
    });
    this.getUserLocation();
  }

  async submit() {
    const data = this.form.value;

    if (this.form.invalid) {
      const alert = await this.alertCtrl.create({
        header: 'Validasi Gagal',
        message: 'Semua field wajib diisi dengan benar.',
        buttons: ['OK'],
      });
      await alert.present();
      return;
    }

    this.api.getLokasiKantor().subscribe({
      next: async (lokasi) => {
        const KANTOR_LAT = Number(lokasi.latitude);
        const KANTOR_LNG = Number(lokasi.longitude);
        this.lokasiKantor = { latitude: KANTOR_LAT, longitude: KANTOR_LNG };
        console.log(`📍 Lokasi kantor: ${KANTOR_LAT}, ${KANTOR_LNG}`);

        try {
          const coordinates = await Geolocation.getCurrentPosition();
          const userLat = coordinates.coords.latitude;
          const userLng = coordinates.coords.longitude;
          console.log(`📍 Lokasi user: ${userLat}, ${userLng}`);

          const distance = getDistanceFromLatLonInMeters(userLat, userLng, KANTOR_LAT, KANTOR_LNG);
          this.jarak = parseFloat(distance.toFixed(2)); // Simpan jarak dibulatkan
          console.log('📏 Raw distance:', distance);
          console.log('📏 Rounded distance:', this.jarak);

          // Validasi batas jarak
          if (this.jarak >= 100) {
            console.log("❌ Jarak terlalu jauh, tampilkan alert!");
            const alert = await this.alertCtrl.create({
              header: 'Di Luar Area',
              message: `Input pesanan hanya bisa dilakukan di lokasi perusahaan (maks 100 meter).<br><br>
                Lokasi Anda terdeteksi: ${this.jarak.toFixed(2)} meter dari kantor.`,
              buttons: ['OK'],
              backdropDismiss: false,
            });
            await alert.present();
            window.location.href = '/dashboard-hrga';
            return;
          }
          console.log("✅ Jarak valid, lanjut submit ke server...");

          // Kirim ke server
          this.api.tambahPesanan(data).subscribe({
            next: async (res) => {
              const alert = await this.alertCtrl.create({
                header: 'Berhasil',
                message: 'Pesanan makanan berhasil disimpan.',
                buttons: ['OK'],
              });
              await alert.present();
              this.form.reset();
              this.jarak = null;
            },
            error: async (err) => {
              const alert = await this.alertCtrl.create({
                header: 'Gagal',
                message: 'Terjadi kesalahan: ' + (err?.error?.message ?? 'Tidak diketahui'),
                buttons: ['OK'],
              });
              await alert.present();
            },
          });
        } catch (error) {
          console.error('❌ Gagal mendapatkan lokasi:', error);
          const alert = await this.alertCtrl.create({
            header: 'Lokasi Gagal',
            message: 'Gagal mendapatkan lokasi. Pastikan GPS aktif dan izin sudah diberikan.',
            buttons: ['OK'],
          });
          await alert.present();
        }
      },
      error: async () => {
        const alert = await this.alertCtrl.create({
          header: 'Gagal Ambil Lokasi Kantor',
          message: 'Tidak bisa mengambil titik lokasi kantor dari server.',
          buttons: ['OK'],
        });
        await alert.present();
      },
    });
  }

  async getUserLocation() {
    try {
      const coordinates = await Geolocation.getCurrentPosition();
      const lat = coordinates.coords.latitude;
      const lng = coordinates.coords.longitude;

      this.form.patchValue({
        latitude: lat,
        longitude: lng,
      });

      this.api.getLokasiKantor().subscribe({
        next: (lokasi) => {
          const kantorLat = Number(lokasi.latitude);
          const kantorLng = Number(lokasi.longitude);
          this.lokasiKantor = { latitude: kantorLat, longitude: kantorLng };

          const distance = getDistanceFromLatLonInMeters(lat, lng, kantorLat, kantorLng);
          this.jarak = parseFloat(distance.toFixed(2));
          console.log('📏 Jarak dihitung saat buka:', this.jarak);
        },
        error: (err) => {
          console.error('❌ Gagal ambil lokasi kantor:', err);
        },
      });
    } catch (error) {
      console.error('❌ Gagal mendapatkan lokasi pengguna:', error);
    }
  }
}
