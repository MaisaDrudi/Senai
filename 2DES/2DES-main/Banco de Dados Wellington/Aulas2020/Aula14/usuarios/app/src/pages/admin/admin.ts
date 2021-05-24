import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Pessoa } from "../../models/pessoa.dto";
import { PessoaService } from '../../services/pessoa.service';

/**
 * Generated class for the AdminPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-admin',
  templateUrl: 'admin.html',
})
export class AdminPage {

  items: Pessoa[];

  constructor(public navCtrl: NavController, public navParams: NavParams, public pessoaService: PessoaService) {
  }

  ionViewDidLoad() {
    let pessoa : Pessoa = { idPessoa:'0', nome: '', telefone:''};
    this.pessoaService.get(pessoa).subscribe(
      (response:Pessoa[])=>{
        this.items = response;
      },
      error => {
        console.log(error);
      }
    );
  }

}
