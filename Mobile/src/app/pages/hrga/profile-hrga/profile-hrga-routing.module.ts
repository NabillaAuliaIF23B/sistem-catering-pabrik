import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ProfileHrgaPage } from './profile-hrga.page';

const routes: Routes = [
  {
    path: '',
    component: ProfileHrgaPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ProfileHrgaPageRoutingModule {}
