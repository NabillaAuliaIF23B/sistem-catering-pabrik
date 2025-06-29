import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { HistoryMakanPageRoutingModule } from './history-makan-routing.module';

import { HistoryMakanPage } from './history-makan.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    HistoryMakanPageRoutingModule
  ],
  declarations: [HistoryMakanPage]
})
export class HistoryMakanPageModule {}
