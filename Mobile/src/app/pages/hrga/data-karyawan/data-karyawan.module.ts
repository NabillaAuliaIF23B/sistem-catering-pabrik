import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { DataKaryawanPageRoutingModule } from './data-karyawan-routing.module';

import { DataKaryawanPage } from './data-karyawan.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    DataKaryawanPageRoutingModule
  ],
  declarations: [DataKaryawanPage]
})
export class DataKaryawanPageModule {}
