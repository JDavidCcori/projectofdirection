getData()
let input = document.getElementById("input");
input.addEventListener('keyup',response=>getData())

function getData() {
    let input = document.getElementById("input").value;
    let content = document.getElementById("content");
    let url = "../controlador/modulo_UsuariosC.php";
    let formData = new FormData();
    formData.append("input", input);
    fetch(url, {
        method: "POST",
        body: formData
    }).then(response => response.json()).then(data => {
        content.innerHTML = data;
    }).catch(err => console.log(err))
}