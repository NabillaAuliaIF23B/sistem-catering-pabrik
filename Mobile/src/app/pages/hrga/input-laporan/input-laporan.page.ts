import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { ToastController } from '@ionic/angular';

@Component({
  standalone: false,
  selector: 'app-input-laporan',
  templateUrl: './input-laporan.page.html',
  styleUrls: ['./input-laporan.page.scss'],
})
export class InputLaporanPage implements OnInit {
  laporanForm: FormGroup;

  constructor(private fb: FormBuilder, private http: HttpClient, private toast: ToastController) {
    this.laporanForm = this.fb.group({
      tanggal: ['', Validators.required],
      shift: ['', Validators.required],
      jumlah_validasi_dapur: [0, [Validators.required, Validators.min(0)]],
      jumlah_scan: [0, [Validators.required, Validators.min(0)]],
      sisa_makanan: [0, [Validators.required, Validators.min(0)]]
    });

  }

  ngOnInit() {}

  async submitLaporan() {
    const formData = this.laporanForm.value;

    this.http.post('https://api.kelompok47.my.id/api/laporan-konsumsi', formData).subscribe(
      async (res: any) => {
        const toast = await this.toast.create({
          message: res.message,
          duration: 2000,
          color: 'success'
        });
        toast.present();
      },
      async (err) => {
        const toast = await this.toast.create({
          message: 'Gagal menyimpan data',
          duration: 2000,
          color: 'danger'
        });
        toast.present();
      }
    );
  }
}