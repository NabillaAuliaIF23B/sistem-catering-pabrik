import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { JumlahPesananPageRoutingModule } from './jumlah-pesanan-routing.module';

import { JumlahPesananPage } from './jumlah-pesanan.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    JumlahPesananPageRoutingModule
  ],
  declarations: [JumlahPesananPage]
})
export class JumlahPesananPageModule {}
