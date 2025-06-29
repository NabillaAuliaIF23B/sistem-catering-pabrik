import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ProfileHrgaPageRoutingModule } from './profile-hrga-routing.module';

import { ProfileHrgaPage } from './profile-hrga.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ProfileHrgaPageRoutingModule
  ],
  declarations: [ProfileHrgaPage]
})
export class ProfileHrgaPageModule {}
