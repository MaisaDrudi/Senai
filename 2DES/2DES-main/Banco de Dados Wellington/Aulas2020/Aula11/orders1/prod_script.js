const listProd = document.querySelector("#listProd");
const url = "http://localhost/orders/src/prod_process.php?id=0";
//AJAX (Asynchronous JavaScript and XML) ou JavaScript e XML Assíncronos
//fetch é uma função assíncrona AJAX que busca dados em uma URL
fetch(url)
  .then(function (resp) {
    //Obtem a resposta da URL no formato JSON
    if (!resp.ok)
      throw new Error("Erro ao executar requisição: " + resp.status);
    return resp.json();
  })
  .then(function (data) {
    //Se obteve a resposta explora os dados recebidos
    data.forEach((val) => {
      let row = document.createElement("tr");
      row.innerHTML = `<tr><td>${val.id_prod}</td>`;
      row.innerHTML += `<td>${val.name}</td>`;
      row.innerHTML += `<td>${val.quantity}</td>`;
      row.innerHTML += `<td>
      <img src='http://localhost/orders/src/get_picture.php?id=${val.id_prod}' width='100px'>
      </td>`;
      row.innerHTML += `<td><button onclick='edit(this)'>Edit</button><button onclick='del(this)'>Del</button></td></tr>`;
      listProd.appendChild(row);
    });
  }) //Se obteve erro no processo exibe no console do navegador
  .catch(function (error) {
    console.error(error.message);
  });

function del(e) {
  let xhr = new XMLHttpRequest();
  let url = "http://localhost/orders/src/prod_process.php";
  let id = e.parentNode.parentNode.cells[0].innerText;
  let data = "id=" + id;
  //Abre uma janela confirmando a edição
  if (window.confirm("Confirma Exclusão do id " + id + "?")) {
    xhr.addEventListener("readystatechange", function () {
      if (this.readyState === this.DONE) {
        window.location.reload();
        alert(this.responseText);
      }
    });
    xhr.open("DELETE", url);
    xhr.send(data); //Envia a requisição ao Controller "prod_process.php"
  }
}

function edit(e) {
  let id = e.parentNode.parentNode.cells[0].innerText;
  e.parentNode.parentNode.cells[1].setAttribute("contenteditable",
    "true");
  e.parentNode.parentNode.cells[2].setAttribute("contenteditable",
    "true");
  e.parentNode.parentNode.cells[3].innerHTML +=
    `<input type='button' onclick='updatePicture(this,${id})' value='Update Picture'/>`;
  e.parentNode.parentNode.cells[4].innerHTML =
    `<input type='button' onclick='sendPut(this)' value='Send'/>`;
}

function updatePicture(e, id) {
  e.parentNode.innerHTML =
    `<form enctype='multipart/form-data' method='POST' action='http://localhost/orders/src/prod_process.php'>` +
    `<input type='hidden' name='id' value='${id}'/>` +
    `<input type='file' name='picture'/>` +
    `<input type='submit' value='Send'/>` +
    `</form>`;
}

function sendPut(e) {
  let xhr = new XMLHttpRequest();
  let url = "http://localhost/orders/src/prod_process.php";
  let id = e.parentNode.parentNode.cells[0].innerText;
  let name = e.parentNode.parentNode.cells[1].innerText;
  let quantity = e.parentNode.parentNode.cells[2].innerText;
  //Monta os dados a serem enviados para UPDATE
  let data = "id=" + id + "&name=" + name + "&quantity=" + quantity;
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      window.location.reload();
      alert(this.responseText);
    }
  });
  xhr.open("PUT", url);
  xhr.send(data); //Envia a requisição ao Controller "prod_process.php"
}