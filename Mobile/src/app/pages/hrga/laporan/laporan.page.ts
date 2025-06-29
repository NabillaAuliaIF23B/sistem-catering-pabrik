import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormBuilder, FormGroup } from '@angular/forms';

@Component({
  standalone: false,
  selector: 'app-laporan',
  templateUrl: './laporan.page.html',
  styleUrls: ['./laporan.page.scss'],
})
export class LaporanPage implements OnInit {
  filterForm: FormGroup;
  laporanData: any[] = [];
  bulanList: number[] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
  tahunList: number[] = [2023, 2024, 2025]; // Bisa kamu ubah sesuai kebutuhan
  today = new Date().toISOString().substring(0, 10);

  constructor(private http: HttpClient, private fb: FormBuilder) {
    this.filterForm = this.fb.group({
      mode: [''],
      value: [''],
      tahun: [''] // Tambahkan field tahun
    });
  }

  ngOnInit() {}

  getNamaBulan(i: number): string {
    const bulan = [
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    return bulan[i - 1];
  }

  removeFocusBeforeNavigate() {
    document.activeElement instanceof HTMLElement && document.activeElement.blur();
  }

  getLaporan() {
    const formData = this.filterForm.value;
    console.log('Form Data:', formData); // Debug

    const params: any = {
      mode: formData.mode,
      value: formData.value,
    };

    if (formData.mode === 'bulan') {
      params.tahun = formData.tahun;
    }

    this.http.get<any>('https://api.kelompok47.my.id/api/laporan-konsumsi/filter', { params })
      .subscribe(res => {
        console.log('API Response:', res); // Debug
        this.laporanData = res.data;
      });
  }
}
