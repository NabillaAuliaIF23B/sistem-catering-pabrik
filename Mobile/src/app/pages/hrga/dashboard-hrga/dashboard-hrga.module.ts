import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { DashboardHrgaPageRoutingModule } from './dashboard-hrga-routing.module';

import { DashboardHrgaPage } from './dashboard-hrga.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    DashboardHrgaPageRoutingModule
  ],
  declarations: [DashboardHrgaPage]
})
export class DashboardHrgaPageModule {}
