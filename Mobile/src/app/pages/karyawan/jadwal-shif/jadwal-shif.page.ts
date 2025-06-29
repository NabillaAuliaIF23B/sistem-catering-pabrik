import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  standalone : false,
  selector: 'app-jadwal-shif',
  templateUrl: './jadwal-shif.page.html',
  styleUrls: ['./jadwal-shif.page.scss'],
})
export class JadwalShifPage implements OnInit {
  jadwal: any[] = [];
  jadwalFilter: any[] = [];

  filterBulan: string = (new Date().getMonth()).toString();
  filterTahun: string = new Date().getFullYear().toString();

  daftarBulan = [
    { value: '0', nama: 'Januari' },
    { value: '1', nama: 'Februari' },
    { value: '2', nama: 'Maret' },
    { value: '3', nama: 'April' },
    { value: '4', nama: 'Mei' },
    { value: '5', nama: 'Juni' },
    { value: '6', nama: 'Juli' },
    { value: '7', nama: 'Agustus' },
    { value: '8', nama: 'September' },
    { value: '9', nama: 'Oktober' },
    { value: '10', nama: 'November' },
    { value: '11', nama: 'Desember' }
  ];

  daftarTahun: string[] = [];

  constructor(
    private authService: AuthService
  ) { }

  ngOnInit() {
    this.loadJadwal();
  }

  loadJadwal() {
    this.authService.getJadwalSaya().subscribe({
      next: (res: any[]) => {
        this.jadwal = res;
        this.extractTahunDariData();
        this.filterJadwal();
      },
      error: (err) => {
        console.error('Gagal ambil jadwal:', err);
      }
    });
  }

  extractTahunDariData() {
    const tahunSet = new Set<string>();

    this.jadwal.forEach(j => {
      const tahun = new Date(j.tanggal).getFullYear().toString();
      tahunSet.add(tahun);
    });

    this.daftarTahun = Array.from(tahunSet).sort(); // urutkan tahun jika perlu
    if (!this.daftarTahun.includes(this.filterTahun)) {
      this.filterTahun = this.daftarTahun[0]; // fallback ke tahun pertama jika filterTahun belum tersedia
    }
  }

  filterJadwal() {
    this.jadwalFilter = this.jadwal.filter(j => {
      const tgl = new Date(j.tanggal);
      return (
        tgl.getMonth().toString() === this.filterBulan &&
        tgl.getFullYear().toString() === this.filterTahun
      );
    });
  }

}
