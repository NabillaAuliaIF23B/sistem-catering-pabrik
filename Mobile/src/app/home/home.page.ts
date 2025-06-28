import { Component } from '@angular/core';

import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
  standalone: false,
})
export class HomePage {

  username = '';
  password = '';
  error = '';
  loading = false;


  constructor(private http: HttpClient, private router: Router) {}

  login() {
  console.log('Login attempt with:', this.username, this.password);
  this.error = '';

  if (!this.username || !this.password) {
    this.error = 'Username dan password harus diisi';
    return;
  }

  this.loading = true;

  const body = {
    username: this.username,
    password: this.password,
  };

  this.http.post<any>(`${environment.apiUrl}/login`, body).subscribe({
    next: (res) => {
      console.log('Login success:', res);
      localStorage.setItem('token', res.access_token);
      this.loading = false;

      if (res.role === 'karyawan') this.router.navigate(['/dashboard-karyawan']);
      else if (res.role === 'koki') this.router.navigate(['/dashboard-koki']);
      else if (res.role === 'hrga') this.router.navigate(['/dashboard-hrga']);
      else this.error = 'Role tidak dikenali';
    },
    error: (err) => {
  this.loading = false;

  // Logging lengkap
  console.log('Login error detail:', JSON.stringify(err));
  console.log('Status:', err.status);
  console.log('Error body:', err.error);

  // Penanganan error yang ditampilkan ke user
  if (err.status === 403) {
    this.error = 'Akun tidak aktif. Hubungi admin.';
  } else if (err.status === 401) {
    this.error = 'Username atau password salah.';
  } else if (err.status === 0) {
    this.error = 'Tidak dapat terhubung ke server.';
  } else {
    this.error = 'Terjadi kesalahan. Silakan coba lagi.';
  }
}

  });
}

}
