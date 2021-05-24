import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { ComumPage } from './comum';

@NgModule({
  declarations: [
    ComumPage,
  ],
  imports: [
    IonicPageModule.forChild(ComumPage),
  ],
})
export class ComumPageModule {}
