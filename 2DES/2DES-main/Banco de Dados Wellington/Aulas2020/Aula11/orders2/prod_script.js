const linhasTabela = document.querySelector("#corpoTabela");
const url = "http://localhost/orders/src/prod_rest.php";
const msg = document.querySelector("#mensagem");
const xhr = new XMLHttpRequest();

//Obtendo as mensagens do backand enviadas pela URL
if (location.search.slice(1).split("=")[0] == "mensagem") {
  msg.innerHTML = decodeURIComponent(location.search.slice(1).split("=")[1]);
} else {
  msg.innerHTML = "Espaço reservado para mensagens do sistema";
}

//AJAX (Asynchronous JavaScript and XML) ou JavaScript e XML Assíncronos
//fetch é uma função assíncrona AJAX que busca dados em uma URL
fetch(url + "?id=0")
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
      <button onclick="alterPicture(this)">Alter Picture</button>
      </td>`;
      row.innerHTML +=
        '<td><button onclick="del(this)"> Del </button><button onclick="edit(this)"> Edit </button></td></tr>';
      linhasTabela.appendChild(row);
    });
  }) //Se obteve erro no processo exibe no console do navegador
  .catch(function (error) {
    console.error(error.message);
  });

function del(e) {
  let id = e.parentNode.parentNode.cells[0].innerHTML;
  let data = "id=" + id;
  if (window.confirm("Delete confirm id " + id + "?")) {
    xhr.addEventListener("readystatechange", function () {
      if (this.readyState === this.DONE) {
        window.location.href = "prod_front.html?mensagem=" + this.response;
      }
    });
    xhr.open("DELETE", url);
    xhr.send(data);
  }
}

function edit(e) {
  e.parentNode.parentNode.cells[1].setAttribute("contentEditable", "true");
  e.parentNode.parentNode.cells[2].setAttribute("contentEditable", "true");
  e.parentNode.parentNode.cells[4].innerHTML =
    '<button onclick="update(this)">Send</button>';
}

function update(e) {
  let data = "id=" + e.parentNode.parentNode.cells[0].innerHTML;
  data += "&name=" + e.parentNode.parentNode.cells[1].innerHTML;
  data += "&quantity=" + e.parentNode.parentNode.cells[2].innerHTML;
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      window.location.href = "prod_front.html?mensagem=" + this.response;
    }
  });
  xhr.open("PUT", url);
  xhr.send(data);
}

function alterPicture(e) {
  let id = e.parentNode.parentNode.cells[0].innerHTML;
  e.parentNode.innerHTML = `
  <form enctype="multipart/form-data" method="POST" action="http://localhost/orders/src/prod_rest.php">
    <input type="hidden" name="id" value="${id}" />
    <input type="file" name="picture" />
    <input type="submit" value="Send" />
  </form>`;
}
