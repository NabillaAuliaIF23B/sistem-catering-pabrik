import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DataKaryawanPage } from './data-karyawan.page';

const routes: Routes = [
  {
    path: '',
    component: DataKaryawanPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class DataKaryawanPageRoutingModule {}
