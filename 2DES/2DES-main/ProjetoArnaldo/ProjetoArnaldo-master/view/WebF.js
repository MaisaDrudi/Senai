const desc = document.getElementById("descrição");
const quant = document.getElementById("quantidade");
const pr = document.getElementById("preço");
const sub = document.getElementById("subTotal");
const total = document.getElementById("totalCompra");
const produtos = document.getElementById("prods");
const tabela = document.getElementById("tabela");
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
  celula3.innerHTML ="R$ "+pr.value; 
  celula4.innerHTML ="R$ "+ quant.value * pr.value; 
  totalc = totalc + quant.value * pr.value;
  total.innerHTML="R$ "+totalc;
}

/*function consultaurl(){
  var url = "http://localhost/Arnaldo/src/controll/routes/route.mercadorias.php?cod=0";
  var myHeaders = new Headers();
  var myInit = { method: 'GET',
               headers: myHeaders,
               mode: 'cors',
               cache: 'default' };

  fetch(url, myInit)
    .then(function (resp) {
        //Obtem a resposta da URL no formato JSON
        if (!resp.ok)
            throw new Error("Erro ao executar requisição: " + resp.status);
        return resp.json();
    })  
  .then(function(data){
    data.forEach(val => {
      let option = document.createElement("option");
      option.innerHTML = val.nome;
      option.value = val.cod;
      localStorage.setItem(val.cod, val.valor);
      produtos.appendChild(option);
    });
  })
  .catch(function (error) {
    console.error(error.message);
  });
}

function selecionar(){
  var x = produtos.value;
  then(function(data){
    data.forEach(val => {
      let option = document.createElement("option");
      option.innerHTML = val.valor;
      option.value = val.cod;
      localStorage.setItem(val.cod, val.valor);
      produtos.appendChild(option);
    });
  })
  .catch(function (error) {
    console.error(error.message);
  });
}*\