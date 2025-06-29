import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { JadwalShifPage } from './jadwal-shif.page';

const routes: Routes = [
  {
    path: '',
    component: JadwalShifPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class JadwalShifPageRoutingModule {}
