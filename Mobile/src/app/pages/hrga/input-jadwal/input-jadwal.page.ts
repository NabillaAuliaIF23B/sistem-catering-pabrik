import { Component, OnInit } from '@angular/core';
import { ToastController } from '@ionic/angular';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  standalone: false,
  selector: 'app-input-jadwal',
  templateUrl: './input-jadwal.page.html',
  styleUrls: ['./input-jadwal.page.scss'],
})
export class InputJadwalPage implements OnInit {
  karyawans: any[] = [];
  id_karyawan: number[] = [];
  tanggal: string = '';
  shift: string = '';

  constructor(
    private toastController: ToastController,
    private authService: AuthService
  ) { }


  ngOnInit() {
    this.authService.getKaryawans().subscribe({
      next: (res) => {
        this.karyawans = res;
      },
      error: (err) => {
        console.error('Gagal ambil data karyawan', err);
      }
    });
  }

  async submitJadwal() {
    // Validasi manual tambahan jika perlu
    if (!this.id_karyawan || this.id_karyawan.length === 0) {
      const toast = await this.toastController.create({
        message: 'Pilih minimal satu karyawan',
        duration: 2000,
        color: 'warning',
      });
      toast.present();
      return;
    }
    if (!this.tanggal) {
      const toast = await this.toastController.create({
        message: 'Tanggal wajib diisi',
        duration: 2000,
        color: 'warning',
      });
      toast.present();
      return;
    }
    if (!this.shift) {
      const toast = await this.toastController.create({
        message: 'Shift wajib dipilih',
        duration: 2000,
        color: 'warning',
      });
      toast.present();
      return;
    }

    const tanggalMysql = new Date(this.tanggal).toISOString().slice(0, 10);
    
    const data = {
      id_karyawan: this.id_karyawan,
      tanggal: tanggalMysql,
      shift: this.shift,
    };

    this.authService.createJadwalShift(data).subscribe({
      next: async (res: any) => {
        const toast = await this.toastController.create({
          message: 'Jadwal shift berhasil disimpan',
          duration: 2000,
          color: 'success',
        });
        toast.present();

        // Reset form
        this.id_karyawan = [];
        this.tanggal = '';
        this.shift = '';
      },
      error: async (err: any) => {
        const toast = await this.toastController.create({
          message: 'Gagal simpan jadwal: ' + (err.error?.message || 'Error'),
          duration: 3000,
          color: 'danger',
        });
        toast.present();
      },
    });
  }
}

