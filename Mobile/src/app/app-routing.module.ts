import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
  {
    path: '',
    redirectTo: 'splash',
    pathMatch: 'full'
  },
  {
    path: 'dashboard-hrga',
    loadChildren: () => import('./pages/hrga/dashboard-hrga/dashboard-hrga.module').then( m => m.DashboardHrgaPageModule)
  },
  {
    path: 'dashboard-koki',
    loadChildren: () => import('./pages/koki/dashboard-koki/dashboard-koki.module').then( m => m.DashboardKokiPageModule)
  },
  {
    path: 'dashboard-karyawan',
    loadChildren: () => import('./pages/karyawan/dashboard-karyawan/dashboard-karyawan.module').then( m => m.DashboardKaryawanPageModule)
  },
  {
    path: 'data-karyawan',
    loadChildren: () => import('./pages/hrga/data-karyawan/data-karyawan.module').then( m => m.DataKaryawanPageModule)
  },
  {
    path: 'laporan',
    loadChildren: () => import('./pages/hrga/laporan/laporan.module').then( m => m.LaporanPageModule)
  },
  {
    path: 'profile-hrga',
    loadChildren: () => import('./pages/hrga/profile-hrga/profile-hrga.module').then( m => m.ProfileHrgaPageModule)
  },
  {
    path: 'input-jadwal',
    loadChildren: () => import('./pages/hrga/input-jadwal/input-jadwal.module').then( m => m.InputJadwalPageModule)
  },
  {
    path: 'jadwal-shift',
    loadChildren: () => import('./pages/hrga/jadwal-shift/jadwal-shift.module').then( m => m.JadwalShiftPageModule)
  },
  {
    path: 'input-pesanan',
    loadChildren: () => import('./pages/hrga/input-pesanan/input-pesanan.module').then( m => m.InputPesananPageModule)
  },
  {
    path: 'input-laporan',
    loadChildren: () => import('./pages/hrga/input-laporan/input-laporan.module').then( m => m.InputLaporanPageModule)
  },
  {
    path: 'profile-karyawan',
    loadChildren: () => import('./pages/karyawan/profile-karyawan/profile-karyawan.module').then( m => m.ProfileKaryawanPageModule)
  },
  {
    path: 'history-makan',
    loadChildren: () => import('./pages/karyawan/history-makan/history-makan.module').then( m => m.HistoryMakanPageModule)
  },
  {
    path: 'jadwal-shif',
    loadChildren: () => import('./pages/karyawan/jadwal-shif/jadwal-shif.module').then( m => m.JadwalShifPageModule)
  },
  {
    path: 'splash',
    loadChildren: () => import('./splash/splash.module').then( m => m.SplashPageModule)
  },
  {
    path: 'jumlah-pesanan',
    loadChildren: () => import('./pages/hrga/jumlah-pesanan/jumlah-pesanan.module').then( m => m.JumlahPesananPageModule)
  },
  {
    path: 'ganti-password-karyawan',
    loadChildren: () => import('./pages/karyawan/ganti-password-karyawan/ganti-password-karyawan.module').then( m => m.GantiPasswordKaryawanPageModule)
  },
  
  
  
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
