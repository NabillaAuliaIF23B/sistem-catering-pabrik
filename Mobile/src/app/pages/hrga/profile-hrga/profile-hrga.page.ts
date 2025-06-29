import { Component, OnInit, AfterViewInit, ViewChild, ElementRef } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';

@Component({
  standalone: false,
  selector: 'app-profile-hrga',
  templateUrl: './profile-hrga.page.html',
  styleUrls: ['./profile-hrga.page.scss'],
})
export class ProfileHrgaPage implements OnInit  {
  profil: any = {};

  constructor(private http: HttpClient,
    private router: Router
  ) {}

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
    document.activeElement instanceof HTMLElement && document.activeElement.blur();
  }



}
