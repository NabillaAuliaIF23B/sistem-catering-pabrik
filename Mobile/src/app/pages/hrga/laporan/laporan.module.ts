import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LaporanPageRoutingModule } from './laporan-routing.module';

import { LaporanPage } from './laporan.page';
import { ReactiveFormsModule } from '@angular/forms';


@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LaporanPageRoutingModule,
    ReactiveFormsModule
  ],
  declarations: [LaporanPage]
})
export class LaporanPageModule {}
