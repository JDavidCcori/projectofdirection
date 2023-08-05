<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloUsuarios.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <title>Document</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <form action="" method="POST">
                <i class="fa-solid fa-magnifying-glass"> <input type="text" name="input" id="input" placeholder="buscar"></i>
            </form>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>DNI</th>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody id="content" class="table-group-divider">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
        <i class="fa-sharp fa-solid fa-plus"></i> Agregar usuario
    </button> -->
    <div class="modal fade modal-lg" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati optio commodi libero aliquam laborum minus quidem modi nulla sequi aliquid, animi nemo, reiciendis sunt a architecto voluptatum necessitatibus saepe vitae. </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">EDITAR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id='editForm'>

                        <label for="modal_dni" class="form-label">DNI: </label>
                        <input type="text" class="form-control" name='modal_dni' id='modal_dni' readonly required>
                        <input type="text" name='modal_dni_hidden' id='modal_dni_hidden' hidden>
                        <label for="modal_nombres" class="form-label">NOMBRES: </label>
                        <input type="text" class="form-control" name='modal_nombres' id='modal_nombres' required>
                        <label for="modal_apellidos" class="form-label">APELLIDOS: </label>
                        <input type="text" class="form-control" name='modal_apellidos' id='modal_apellidos' required>
                        <br>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name='modal_rol' id='modal_rol'>
                            <option value="Sin rol" selected>Sin rol</option>
                            <option value="Secretario">Secretario</option>
                            <option value="Tesorero">Tesorero</option>
                        </select>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" name='modal_estado' id="modal_estado" checked>
                            <label class="form-check-label" for="modal_estado">
                                Activo
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick='apply()'>Aplicar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var usuario = {
            dni: '',
            nombres: '',
            apellidos: '',
            rol: '',
            estado: '',
        }

        function edit(dniClass) {
            let data = document.getElementsByClassName(dniClass);
            let modal_dni = document.getElementById('modal_dni')
            let modal_dni_hidden = document.getElementById('modal_dni_hidden')
            let modal_nombres = document.getElementById('modal_nombres')
            let modal_apellidos = document.getElementById('modal_apellidos')
            let modal_rol = document.getElementById('modal_rol')
            let modal_estado = document.getElementById('modal_estado')
            usuario = {
                dni: data[0].cells[0].textContent,
                nombres: data[0].cells[1].textContent,
                apellidos: data[0].cells[2].textContent,
                rol: data[0].cells[3].textContent,
                estado: data[0].cells[4].textContent,
            }
            modal_dni.value = usuario.dni
            modal_dni_hidden.value = usuario.dni
            modal_nombres.value = usuario.nombres
            modal_apellidos.value = usuario.apellidos
            modal_rol.value = usuario.rol
            modal_estado.checked = usuario.estado != 0 ? true : false
        }

        function apply() {
            var editForm = document.getElementById('editForm')
            var data = new FormData(editForm)
            let modal_dni = document.getElementById('modal_dni')
            let modal_nombres = document.getElementById('modal_nombres')
            let modal_apellidos = document.getElementById('modal_apellidos')
            let modal_rol = document.getElementById('modal_rol')
            let modal_estado = document.getElementById('modal_estado')

            if (modal_dni.value.length != 0 && modal_nombres.value.length != 0 && modal_apellidos.value.length != 0) {
                fetch('../modelo/modulo_UsuariosM.php', {
                    method: 'POST',
                    body: data
                }).then(res => res.json()).then(data => {

                })
                $('#staticBackdrop').modal('hide');
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('Modificado correctamente');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('Llene todos los campos');
                
            }
        }
    </script>
    <script src="../js/busquedaUsuario.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
</body>

</html>