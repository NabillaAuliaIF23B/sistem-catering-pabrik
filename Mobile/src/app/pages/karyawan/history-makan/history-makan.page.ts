import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  standalone: false,
  selector: 'app-history-makan',
  templateUrl: './history-makan.page.html',
  styleUrls: ['./history-makan.page.scss'],
})
export class HistoryMakanPage implements OnInit {
  history: any[] = [];

  constructor(private authService: AuthService) { }

  ngOnInit() {
    this.loadData();
  }

  loadData() {
    this.authService.getAbsensiSudahByUser().subscribe({
      next: (res) => {
        this.history = res;
        console.log('Data history:', res);
      },
      error: (err) => {
        console.error('Gagal ambil data history:', err);
      }
    });
  }

}
