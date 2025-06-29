import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { HistoryMakanPage } from './history-makan.page';

const routes: Routes = [
  {
    path: '',
    component: HistoryMakanPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class HistoryMakanPageRoutingModule {}
