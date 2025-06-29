import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  standalone: false,
  selector: 'app-jumlah-pesanan',
  templateUrl: './jumlah-pesanan.page.html',
  styleUrls: ['./jumlah-pesanan.page.scss'],
})
export class JumlahPesananPage implements OnInit {
  selectedDate: string = '';
  pesananList: any[] = [];
  dataFetched: boolean = false;

  constructor(
    private authService: AuthService
  ) { }

  ngOnInit() {
  }

  loadData() {
    if (!this.selectedDate) {
      alert('Silakan pilih tanggal.');
      return;
    }

    this.authService.getPesananByTanggal(this.selectedDate).subscribe({
      next: (res) => {
        this.pesananList = res;
        this.dataFetched = true;
      },
      error: (err) => {
        console.error(err);
        this.pesananList = [];
        this.dataFetched = true;
      },
    });
  }

}
