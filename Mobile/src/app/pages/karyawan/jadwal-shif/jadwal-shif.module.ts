import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { JadwalShifPageRoutingModule } from './jadwal-shif-routing.module';

import { JadwalShifPage } from './jadwal-shif.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    JadwalShifPageRoutingModule
  ],
  declarations: [JadwalShifPage]
})
export class JadwalShifPageModule {}
