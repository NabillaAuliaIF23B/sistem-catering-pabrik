import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { JumlahPesananPage } from './jumlah-pesanan.page';

const routes: Routes = [
  {
    path: '',
    component: JumlahPesananPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class JumlahPesananPageRoutingModule {}
