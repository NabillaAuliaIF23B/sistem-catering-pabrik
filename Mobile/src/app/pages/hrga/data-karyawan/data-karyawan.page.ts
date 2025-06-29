import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { NavController } from '@ionic/angular';
import { environment } from 'src/environments/environment.prod';
import { Observable } from 'rxjs';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  standalone: false,
  selector: 'app-data-karyawan',
  templateUrl: './data-karyawan.page.html',
  styleUrls: ['./data-karyawan.page.scss'],
})
export class DataKaryawanPage implements OnInit {
  users: any[] = [];

  constructor(
    private navCtrl: NavController,
    private authService :AuthService,
    private http: HttpClient
  ) { }


  ngOnInit() {
    this.authService.getUsers().subscribe({
    next: (res: any) => {
      console.log('Response dari API:', res);
      this.users = res;
    },
    error: (err) => {
      console.error('Error API:', err);
      alert('Gagal mengambil data users');
    }
  });
  }

  hapusUser(id: number) {
    if (confirm('Yakin ingin menghapus user ini?')) {
      this.authService.deleteUser(id).subscribe({
        next: () => {
          this.users = this.users.filter(user => user.id_karyawan !== id);
          alert('User berhasil dihapus');
        },
        error: (err) => {
          console.error('Gagal hapus user:', err);
          alert('Gagal menghapus user');
        }
      });
    }
  }

}
