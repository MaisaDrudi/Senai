import { Component } from '@angular/core';
import { AlertController } from 'ionic-angular';
import { NavController, IonicPage} from 'ionic-angular';
import { Usuario } from '../../modell/usuario.dto';
import { UsuarioService } from '../../services/usuario.service';

@IonicPage()

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  Login: String;
  Senha: String;

  constructor(public navCtrl: NavController,
    public alertController: AlertController,
    public usuarioService: UsuarioService) {

  }

  Logar(){
    if(this.Login != undefined && this.Senha != undefined && this.Login.length != 0
    && this.Senha.length != 0){
      // this.presentAlert("Senha ou login definidos");

      let usuario:Usuario = {idPessoa:'',login:this.Login, senha:this.Senha, tipo:''};  
      this.usuarioService.post(usuario).subscribe(
        (resposta:Usuario)=>{
          if(resposta.tipo == 'adm'){ //Administrador
            this.presentAlert("Olá " +resposta.login+ "seja bem-vinda(o)! Seu perfil é de administrador!");
            this.navCtrl.setRoot("AdministradorPage");
          }else{
            this.presentAlert("Olá " +resposta.login+ "seja bem-vinda(o)! Seu perfil é de úsuario!");
            this.navCtrl.setRoot("UsuariosPage");
          }
        },
        error=>{
          this.presentAlert("Erro: "+error.error.erro);
        }
      );    
    }else{
      this.presentAlert("Senha ou login não definidos.");
    }
  }
    
  presentAlert(messagem: string){
    let alert = this.alertController.create({
      title: 'Aviso',
      subTitle: messagem,
      buttons: ['ok']
    })
    alert.present();
  }

}
