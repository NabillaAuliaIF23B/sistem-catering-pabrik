import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DashboardHrgaPage } from './dashboard-hrga.page';

const routes: Routes = [
  {
    path: '',
    component: DashboardHrgaPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class DashboardHrgaPageRoutingModule {}
