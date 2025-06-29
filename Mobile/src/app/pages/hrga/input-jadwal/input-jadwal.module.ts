import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { InputJadwalPageRoutingModule } from './input-jadwal-routing.module';

import { InputJadwalPage } from './input-jadwal.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    InputJadwalPageRoutingModule
  ],
  declarations: [InputJadwalPage]
})
export class InputJadwalPageModule {}
