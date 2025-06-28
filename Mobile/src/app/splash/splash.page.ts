import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ChangeDetectorRef } from '@angular/core';

@Component({
  standalone: false,
  selector: 'app-splash',
  templateUrl: './splash.page.html',
  styleUrls: ['./splash.page.scss'],
})
export class SplashPage implements OnInit {
  showLogo = false;
  showName = false;

  constructor(
    private router: Router,
    private cd: ChangeDetectorRef
  ) {}

  ngOnInit() {
    // Munculin logo setelah 2 detik
    setTimeout(() => {
      this.showLogo = true;
      this.cd.detectChanges();

      // Munculin nama perusahaan 1.5 detik setelah logo
      setTimeout(() => {
        this.showName = true;
        this.cd.detectChanges();
      }, 1500);

      // Tambah waktu lebih lama sebelum pindah ke halaman home
      setTimeout(() => {
        this.router.navigateByUrl('/home');
      }, 6000); // Total 6 detik dari awal (lebih nyaman dilihat)
    }, 2000);
  }
}
