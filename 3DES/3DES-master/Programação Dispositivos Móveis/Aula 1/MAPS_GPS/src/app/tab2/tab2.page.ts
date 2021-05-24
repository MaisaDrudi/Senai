import { Component } from '@angular/core';

declare var google;
@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})

export class Tab2Page {

  constructor() {}

  ionViewWillEnter(){
    // Localização do Senai Latitude Longitude
    const casa = { lat: -22.73893169649491, lng: -46.89003245961957 };
    
    const map = new google.maps.Map(
      document.getElementById("map") as HTMLElement,
      {
        zoom: 18,
        center: casa,
        disableDefaultUI: false
      }
    );
    const marker = new google.maps.Marker({
      position: casa,
      map: map,

      //Titulo
      title: 'Minha posição',

      //Animção
      animation: google.maps.Animation.DROP, // BOUNCE
 
      //Icone
      //icon: 'assets/gps.png'
    });

    google.maps.event.addListener(marker, 'click', () => {
      //Call run function to set the data within angular zone to trigger change detection.
      console.log("Usuário clicou no marcador");
    })
  
  }

} 