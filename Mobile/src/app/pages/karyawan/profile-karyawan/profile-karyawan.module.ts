import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ProfileKaryawanPageRoutingModule } from './profile-karyawan-routing.module';

import { ProfileKaryawanPage } from './profile-karyawan.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ProfileKaryawanPageRoutingModule
  ],
  declarations: [ProfileKaryawanPage]
})
export class ProfileKaryawanPageModule {}
