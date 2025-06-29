import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ProfileKaryawanPage } from './profile-karyawan.page';

const routes: Routes = [
  {
    path: '',
    component: ProfileKaryawanPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ProfileKaryawanPageRoutingModule {}
