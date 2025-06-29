import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { InputPesananPageRoutingModule } from './input-pesanan-routing.module';

import { InputPesananPage } from './input-pesanan.page';
import { ReactiveFormsModule } from '@angular/forms';
@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    InputPesananPageRoutingModule,
    ReactiveFormsModule
  ],
  declarations: [InputPesananPage]
})
export class InputPesananPageModule {}
