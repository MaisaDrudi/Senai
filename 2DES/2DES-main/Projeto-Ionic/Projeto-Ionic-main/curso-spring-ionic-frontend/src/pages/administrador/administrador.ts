import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Pessoa } from '../../modell/pessoa.dto';
import { PessoaService } from '../../services/pessoa.service';

/**
 * Generated class for the AdministradorPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-administrador',
  templateUrl: 'administrador.html',
})
export class AdministradorPage {

  pessoas: Pessoa[]
  
  constructor(public navCtrl: NavController, 
    public navParams: NavParams,
    public pessoaService: PessoaService) {
  }

  idPessoa: String;
  nome: String;
  telefone: String;

  ionViewDidLoad() {
    let pessoa:Pessoa = {idPessoa:'0',nome:'',telefone:''};
    this.pessoaService.get(pessoa).subscribe(
    (resposta:Pessoa[])=>{
      this.pessoas = resposta;
    },
    erro=>{
      console.log(erro);
    }

  );
    
    console.log('ionViewDidLoad AdministradorPage entrei aqui depois de carregar');
  }

}