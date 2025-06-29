import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { JadwalShiftPageRoutingModule } from './jadwal-shift-routing.module';

import { JadwalShiftPage } from './jadwal-shift.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    JadwalShiftPageRoutingModule
  ],
  declarations: [JadwalShiftPage]
})
export class JadwalShiftPageModule {}
