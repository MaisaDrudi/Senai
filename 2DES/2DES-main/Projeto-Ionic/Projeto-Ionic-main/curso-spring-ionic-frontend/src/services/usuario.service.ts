import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Usuario } from "../modell/usuario.dto";
import { APICONFIG } from "../config/api.config";

@Injectable()
export class UsuarioService {

    constructor(public httpClient: HttpClient) {}

    post(usuario: Usuario){
        var url = APICONFIG.urlBase+"/webservice.php";
        return this.httpClient.post<Usuario>(url,usuario);
    }

}