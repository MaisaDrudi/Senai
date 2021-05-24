const desc = document.getElementById("descrição");
const quant = document.getElementById("quantidade");
const pr = document.getElementById("preço");
const sub = document.getElementById("subTotal");
const total = document.getElementById("totalCompra");
var totalc = 0;


function adicionaLinha(idTabela) {

  let tabela = document.getElementById(idTabela);
  let numeroLinhas = tabela.rows.length;
  let linha = tabela.insertRow(numeroLinhas);
  let celula1 = linha.insertCell(0);
  let celula2 = linha.insertCell(1);   
  let celula3 = linha.insertCell(2); 
  let celula4 = linha.insertCell(3);
  celula1.innerHTML = desc.value; 
  celula2.innerHTML = quant.value;
  celula3.innerHTML = pr.value; 
  celula4.innerHTML = quant.value * pr.value; 
  totalc = totalc + quant.value * pr.value;
  total.innerHTML="R$ "+totalc;
}

function removeLinha(linha) {
  var i=linha.parentNode.parentNode.rowIndex;
  document.getElementById('tbl').deleteRow(i);
} 

