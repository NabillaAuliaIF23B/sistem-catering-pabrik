import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { InputLaporanPageRoutingModule } from './input-laporan-routing.module';

import { InputLaporanPage } from './input-laporan.page';

import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    InputLaporanPageRoutingModule,
    ReactiveFormsModule
  ],
  declarations: [InputLaporanPage]
})
export class InputLaporanPageModule {}
