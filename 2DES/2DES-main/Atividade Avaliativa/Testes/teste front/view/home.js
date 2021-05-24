var totalc = 0;
function adicionaLinha() {
    let tabela = document.getElementById("tabela");
    let desc = document.getElementById("descricao");
    let quant = document.getElementById("quantidade");
    let pr = document.getElementById("preco");
    let total = document.getElementById("totalCompra");

    let numeroLinhas = -1;
    let linha = tabela.insertRow(numeroLinhas);
    let celula1 = linha.insertCell(0);
    let celula2 = linha.insertCell(1);   
    let celula3 = linha.insertCell(2); 
    let celula4 = linha.insertCell(3);
    celula1.innerHTML = desc.value; 
    celula2.innerHTML = quant.value;
    celula3.innerHTML = "R$ "+ pr.value+",00"; 
    celula4.innerHTML = "R$ "+ quant.value * pr.value+",00"; 
    totalc = totalc + (quant.value * pr.value);
    
    total.value="R$ "+totalc+",00";

  
  }
  function mascara(i){
   
    var v = i.value;
    
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
       i.value = v.substring(0, v.length-1);
       return;
    }
    
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";
 
 }