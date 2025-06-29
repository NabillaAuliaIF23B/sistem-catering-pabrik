import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';

@Component({
  standalone: false,
  selector: 'app-profile-karyawan',
  templateUrl: './profile-karyawan.page.html',
  styleUrls: ['./profile-karyawan.page.scss'],
})
export class ProfileKaryawanPage implements OnInit {

  profil: any = {};

  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  ngOnInit() {
    const token = localStorage.getItem('token'); // ambil token langsung

  if (!token) {
    alert('Token tidak ditemukan. Silakan login ulang.');
    return;
  }

  const headers = new HttpHeaders({
    Authorization: `Bearer ${token}`,
  });

  this.http.get(`${environment.apiUrl}/profile`, { headers }).subscribe({
    next: (res) => {
      this.profil = res;
      console.log('Profile:', res);
    },
    error: (err) => {
      console.error('Gagal mengambil profil:', err);
      alert('Gagal memuat profil. Silakan login ulang.');
    },
  });
}

  logout() {
      localStorage.removeItem('token');
      this.router.navigate(['/home']);
  }

  
  removeFocusBeforeNavigate() {
    const active = document.activeElement;
    if (active instanceof HTMLElement) {
      active.blur();
    }
  }

  goToHistoryMakan() {
    this.removeFocusBeforeNavigate();
    this.router.navigate(['/history-makan']);
  }



}


