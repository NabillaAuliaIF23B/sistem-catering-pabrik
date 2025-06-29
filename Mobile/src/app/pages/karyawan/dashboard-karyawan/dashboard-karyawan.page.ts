import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { interval, Subscription } from 'rxjs';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { Storage } from '@ionic/storage-angular';

@Component({
  standalone: false,
  selector: 'app-dashboard-karyawan',
  templateUrl: './dashboard-karyawan.page.html',
  styleUrls: ['./dashboard-karyawan.page.scss'],
})
export class DashboardKaryawanPage implements OnInit {

  qrString: string = '';
  private timerSub!: Subscription;

  constructor(
    private http: HttpClient,
    private router: Router,
  private storage: Storage) {}
    
  removeFocusBeforeNavigate() {
    document.activeElement instanceof HTMLElement && document.activeElement.blur();
  }

  async ngOnInit() {
    await this.storage.create();
    this.timerSub = interval(15000).subscribe(() => {
      this.loadQr();
    });
    this.loadQr();
  }

  async loadQr() {
  const token = localStorage.getItem('token');


  if (!token) {
    console.error('Token tidak ditemukan.');
    return;
  }

  this.http.get(`${environment.apiUrl}/qr-data`, {
  headers: { Authorization: `Bearer ${token}` }
}).subscribe(
  (res: any) => {
    if (res && res.data) {
      this.qrString = JSON.stringify(res.data);
      //console.log('QR Data:', res.data); // ✅ tampil di console browser
    } else {
      console.warn('Respon tidak valid:', res);
      this.qrString = '';
    }
  },
  (error) => {
    console.error('Gagal ambil QR:', error);
    this.qrString = '';
  }
);


/*
  this.http.get('https://catering.kelompok47.my.id/api/qr-data', {
    headers: { Authorization: `Bearer ${token}` }
  }).subscribe(
    (res: any) => {
      this.qrString = JSON.stringify(res.data); // pastikan backend kirim `data`
    },
    (error) => {
      console.error('Gagal ambil QR:', error);
      this.qrString = ''; // untuk cegah error angularx-qrcode
    }
  );*/
}
}