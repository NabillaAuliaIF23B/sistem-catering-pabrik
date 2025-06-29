import { Component, OnInit } from '@angular/core';

import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
@Component({
  standalone: false,
  selector: 'app-dashboard-hrga',
  templateUrl: './dashboard-hrga.page.html',
  styleUrls: ['./dashboard-hrga.page.scss'],
})
export class DashboardHrgaPage implements OnInit {
  total = 0;
  shift1 = 0;
  shift2 = 0;
  shift3 = 0;
  tanggal = '';

  totalSudah: number = 0;
  tanggalHariIni: string = '';

  

  constructor(
    private router: Router,
    private api: AuthService,
  ) { }

  removeFocusBeforeNavigate() {
    document.activeElement instanceof HTMLElement && document.activeElement.blur();
  }

  ngOnInit() {
    this.loadRingkasanPesanan();
    this.loadTotalSudah();
  }

  loadRingkasanPesanan() {
    this.api.getRingkasanPesanan().subscribe(res => {
      this.total = res.total;
      this.tanggal = res.tanggal;

      res.shift.forEach((s: any) => {
        if (s.shift === '1') this.shift1 = s.jumlah;
        if (s.shift === '2') this.shift2 = s.jumlah;
        if (s.shift === '3') this.shift3 = s.jumlah;
      });
    });
  }

  loadTotalSudah() {
  this.api.getTotalSudahHariIni().subscribe({
    next: (res) => {
      this.totalSudah = res.total_sudah;
      this.tanggalHariIni = res.tanggal;
    },
    error: (err) => {
      console.error('Gagal mengambil data total absen sudah:', err);
    }
  });
}

  /*ngOnInit() {
    this.api.getRingkasanPesanan().subscribe(res => {
      this.total = res.total;
      this.tanggal = res.tanggal;

      res.shift.forEach((s: any) => {
        if (s.shift === '1') this.shift1 = s.jumlah;
        if (s.shift === '2') this.shift2 = s.jumlah;
        if (s.shift === '3') this.shift3 = s.jumlah;
      });
    });*/
}
