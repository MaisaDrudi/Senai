  
var desc = document.getElementById("d");
var rh = document.getElementById("r");
var patro = document.getElementById("p");
var ger = document.getElementById("g");
var data = document.getElementById("dt");

function gerarPDF() {

    var t = `<table>
     <td><tr>Descrição: ${desc.value}</tr></td><br/><br/>
     <td><tr>Desenvolvedores: ${rh.value}</tr></td><br/><br/>
     <td><tr>Patrocinadores: ${patro.value}</tr></td><br/><br/>
     <td><tr>Gerentes: ${ger.value}</tr></td><br/><br/>
     <td><tr>Conclusão: ${data.value}</tr></td><br/><br/>
     </table>`;
    
    var x = window.open('');
    x.document.write(t);
    x.document.close();
    x.print();
}