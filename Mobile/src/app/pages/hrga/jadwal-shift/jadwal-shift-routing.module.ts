import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { JadwalShiftPage } from './jadwal-shift.page';

const routes: Routes = [
  {
    path: '',
    component: JadwalShiftPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class JadwalShiftPageRoutingModule {}
