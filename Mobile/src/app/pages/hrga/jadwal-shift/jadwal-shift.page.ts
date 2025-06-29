import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  standalone: false,
  selector: 'app-jadwal-shift',
  templateUrl: './jadwal-shift.page.html',
  styleUrls: ['./jadwal-shift.page.scss'],
})
export class JadwalShiftPage implements OnInit {

  jadwals: any[] = [];
  filterTanggal: string = '';
  filterBulan: number = new Date().getMonth() + 1; // default bulan ini
  filterTahun: number = new Date().getFullYear();  // default tahun ini
  filterMode: string = 'tanggal'; // default mode

  bulanList = [
    { value: 1, label: 'Januari' },
    { value: 2, label: 'Februari' },
    { value: 3, label: 'Maret' },
    { value: 4, label: 'April' },
    { value: 5, label: 'Mei' },
    { value: 6, label: 'Juni' },
    { value: 7, label: 'Juli' },
    { value: 8, label: 'Agustus' },
    { value: 9, label: 'September' },
    { value: 10, label: 'Oktober' },
    { value: 11, label: 'November' },
    { value: 12, label: 'Desember' },
  ];

  constructor(
    private authService : AuthService
  ) { 
    
  }

  ngOnInit() {
    this.loadJadwal();
  }

  loadJadwal() {
    let params: any = {};

    if (this.filterMode === 'tanggal' && this.filterTanggal) {
      params.tanggal = this.filterTanggal.split('T')[0]; // format YYYY-MM-DD
    } else if (this.filterMode === 'bulan') {
      params.bulan = this.filterBulan;
      params.tahun = this.filterTahun;
    }

    this.authService.getJadwalShift(params).subscribe({
      next: (res: any) => {
        this.jadwals = res.data || [];
      },
      error: (err) => {
        console.error('Gagal ambil jadwal shift', err);
      }
    });
  }

}
