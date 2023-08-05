<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/moduloPoblador.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <title>Document</title>
</head>

<body>

    <?php
    if (isset($_SESSION['nombres'])) {
        $nombre = $_SESSION['nombres'];
        $rolState = $_SESSION['rol'] == 'Tesorero' ? 'Disabled' : '';
    }
    ?>

    <div class="card">
        <div class="card-header">
            <form action="" method="POST">
                <i class="fa-solid fa-magnifying-glass"> <input type="text" name="input" id="input" placeholder="buscar"></i>
            </form>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" id='buttonAgregarPoblador' <?= $rolState ?>>
                <i class="fa-sharp fa-solid fa-plus"></i> Agregar poblador
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>DNI</th>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>CELULAR</th>
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



    <div class="modal fade modal-lg" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">AGREGAR POBLADOR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id='addForm'>

                        <label for="modal_addDni" class="form-label">DNI: </label>
                        <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="modal_addDni" id="modal_addDni" minlength="8" maxlength="8" required>
                        <label for="modal_addNombres" class="form-label">NOMBRES:</label>
                        <input type="text" class="form-control" name="modal_addNombres" id="modal_addNombres" required>
                        <label for="modal_addApellidos" class="form-label">APELLIDOS:</label>
                        <input type="text" class="form-control" name="modal_addApellidos" id="modal_addApellidos" required>
                        <label for="modal_addCelular" class="form-label">CELULAR</label>
                        <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="modal_addCelular" id="modal_addCelular" minlength="8" maxlength="9" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="add()">Agregar</button>
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
                        <label for="modal_celular" class="form-label">CELULAR: </label>
                        <input type="text" class="form-control" name='modal_celular' id='modal_celular' required>
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
            celular: '',
            estado: '',
        }

        function edit(dniClass) {
            let data = document.getElementsByClassName(dniClass);
            let modal_dni = document.getElementById('modal_dni')
            let modal_dni_hidden = document.getElementById('modal_dni_hidden')
            let modal_nombres = document.getElementById('modal_nombres')
            let modal_apellidos = document.getElementById('modal_apellidos')
            let modal_celular = document.getElementById('modal_celular')
            let modal_estado = document.getElementById('modal_estado')
            usuario = {
                dni: data[0].cells[0].textContent,
                nombres: data[0].cells[1].textContent,
                apellidos: data[0].cells[2].textContent,
                celular: data[0].cells[3].textContent,
                estado: data[0].cells[4].textContent,
            }
            modal_dni.value = usuario.dni
            modal_dni_hidden.value = usuario.dni
            modal_nombres.value = usuario.nombres
            modal_apellidos.value = usuario.apellidos
            modal_celular.value = usuario.celular
            modal_estado.checked = usuario.estado != 0 ? true : false
        }

        function apply() {
            var editForm = document.getElementById('editForm')
            var data = new FormData(editForm)
            let modal_dni = document.getElementById('modal_dni')
            let modal_nombres = document.getElementById('modal_nombres')
            let modal_apellidos = document.getElementById('modal_apellidos')
            let modal_celular = document.getElementById('modal_celular')
            let modal_estado = document.getElementById('modal_estado')

            if (modal_dni.value.length != 0 && modal_nombres.value.length != 0 && modal_apellidos.value.length != 0 && modal_dni.value.length == 8 && modal_celular.value.length == 9) {
                fetch('../modelo/modulo_PobladoresM.php', {
                    method: 'POST',
                    body: data
                }).then(res => res.json()).then(data => {
                    console.log(data)
                })
                $('#staticBackdrop').modal('hide');
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('Cambios realizados');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);

            } else {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('Llene bien todos los campos');
            }
        }

        function add() {
            var addForm = document.getElementById('addForm')
            var data = new FormData(addForm)
            let modal_dni = document.getElementById('modal_addDni')
            let modal_nombres = document.getElementById('modal_addNombres')
            let modal_apellidos = document.getElementById('modal_addApellidos')
            let modal_celular = document.getElementById('modal_addCelular')


            if (modal_dni.value.length != 0 && modal_nombres.value.length != 0 && modal_apellidos.value.length != 0 && modal_dni.value.length == 8 && modal_celular.value.length == 9) {
                fetch('../modelo/modulo_PobladoresM.php', {
                    method: 'POST',
                    body: data
                }).then(res => res.json()).then(data => {
                    if (data == 'DNI EXISTENTE') {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success('DNI existente');
                    } else {
                        $('#staticBackdrop1').modal('hide');
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success('Agregado');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                })

            } else {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('Llene bien todos los campos');
            }
        }
    </script>
    <script src="../js/busquedaPobladores.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>