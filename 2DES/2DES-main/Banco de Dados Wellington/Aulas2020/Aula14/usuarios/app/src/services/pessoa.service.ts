import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Pessoa } from "../models/pessoa.dto";
import { APICONFIG } from "../config/api.config";

@Injectable()
export class PessoaService {

    constructor(public httpClient: HttpClient) {}

    get(pessoa: Pessoa){
        var url = APICONFIG.urlBase+"/webservice.php?id="+pessoa.idPessoa;
        return this.httpClient.get<Pessoa[]>(url);
    }

}