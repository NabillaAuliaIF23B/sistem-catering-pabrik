import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { InputLaporanPage } from './input-laporan.page';

const routes: Routes = [
  {
    path: '',
    component: InputLaporanPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class InputLaporanPageRoutingModule {}
