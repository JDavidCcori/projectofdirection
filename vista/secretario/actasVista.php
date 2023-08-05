<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <title>COMUNIDAD PALLACCOCHA</title>

    <link rel="stylesheet" href="../../css/menu.css">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="contenedor_general">
        <div class="barra_menu">
            <div class="encabezado">

                <i class="fa-solid fa-user"></i>

            </div>

            <div class="opciones_menu">

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>

                    <a href="../../vista/secretario/actasVista.php">ACTAS</a>

                </div>

                <div class="opcion">
                    <i class="fa-sharp fa-solid fa-file-circle-question"></i>
                    <a href="../../vista/usuariosV.php?modulo=asistencias">ASISTENCIAS</a>
                </div>

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>
                    <a href="../../vista/usuariosV.php?modulo=deudas">CUOTAS</a>
                </div>

                <div class="opcion">

                    <i class="fa-solid fa-list-check"></i>
                    <a href="../../vista/usuariosV.php?modulo=pobladores">POBLADORES</a>
                </div>

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>
                    <a href="../../vista/usuariosV.php?modulo=usuarios">USUARIOS</a>
                </div>

                <div class="boton_salir">
                    <a href="../../controlador/cerrarSesion.php">SALIR</a>
                </div>

            </div>
        </div>

        <div class="contenido">
            <div class="cabecera">

                <?php
                session_start();
                if (isset($_SESSION['nombres'])) {
                    $nombre = $_SESSION['nombres'];
                    $rolState=$_SESSION['rol']=='Tesorero'?'Disabled':'';
                    echo "$nombre";
                }
                ?>
                <i class="fa-solid fa-circle-user"></i>

            </div>



  <!-- TABLA ACTAS -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>ACTAS COMUNALES-PALLACCOCHA

                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#agregarActaModal" <?=$rolState?>><i class="bi bi-file-plus-fill" ></i>
                                        Agregar Acta
                                    </button>
                                </h4>
                                <br>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="myTable" class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>Número Acta</th>
                                                <th>Asunto de la reunión</th>
                                                <th>Archivo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('../../controlador/secretario/actasControlador.php');
                                            $resultado = actasControlador::mostrarActasC();

                                            for ($i = 0; $i < mysqli_num_rows($resultado); $i++) {
                                                $actas = mysqli_fetch_array($resultado);
                                                $numero = $actas['numero_acta'];
                                                $asunto = $actas['asunto_acta'];
                                            ?>
                                                <tr>
                                                    <td><?= $numero ?></td>
                                                    <td><?= $asunto ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-secondary btn-sm">
                                                            <a href="../../Librerias/fpdf/ACTA.php?numero=<?= $numero; ?>" target="_blank">
                                                                <i class="bi bi-file-pdf-fill text-white"></i>
                                                            </a>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button type="button" value="<?= $numero; ?>" class="verActaBtn btn btn-info btn-sm">
                                                            <i class="bi bi-eye-fill text-white"></i>
                                                        </button>
                                                        <button type="button" value="<?= $numero; ?>" class="editarActaBtn btn btn-success btn-sm" <?=$rolState?>>
                                                            <i class="bi bi-pencil-fill text-white"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .btn i {
                    color: white;
                }
            </style>




            <!-- MODAL AGREGAR ACTA -->
            <div class="modal fade" id="agregarActaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Acta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="guardarActa">
                            <div class="modal-body">
                                <div id="errorMessage" class="alert alert-warning d-none"></div>
                                <div class="mb-3">
                                    <label class="fw-bold" for="">Asunto:</label>
                                    <input type="text" name="asunto" class="form-control" />
                                </div>

                                <div class="mb-3 input-group">
                                    <label class="fw-bold" for="">Lugar:</label>
                                    <input id="lugarInput" type="text" name="lugar" class="form-control" />
                                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#" onclick="fillLugar('Casa Comunal')">Casa Comunal</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="fillLugar('Plaza de Pallaccocha')">Plaza</a></li>

                                    </ul>
                                </div>

                                <div class="mb-3">
                                    <label class="fw-bold" for="">Acuerdo:</label>
                                    <textarea name="acuerdo" class="form-control" rows="5"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function fillLugar(option) {
                    document.getElementById("lugarInput").value = option;
                }
            </script>




            <!-- MODAL EDITAR -->
            <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">EDITAR ACTA </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="actualizarActa">
                            <div class="modal-body">

                                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="acta_id" id="acta_id">

                                <div class="mb-3">
                                    <label class="fw-bold" for="">Asunto Acta</label>
                                    <input type="text" name="asunto" id="asunto" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold" for="">Acuerdo Acta</label>
                                    <textarea name="acuerdo" id="acuerdo" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold" for="">Lugar</label>
                                    <input type="text" name="lugar" id="lugar" class="form-control" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Actualizar Acta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- MODAL VER DETALLES ACTA-->
            <div class="modal fade" id="ActaVistaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">ACTA N ° <span id="id_acta"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="fw-bold" for="">Asunto de la reunión</label>
                                <p id="vista_asunto" class="form-control"></p>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold" for="">Acuerdo de la reunión</label>
                                <textarea id="vista_acuerdo" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="d-flex">
                                <div class="mb-3 me-4">
                                    <label class="fw-bold" for="">Fecha</label>
                                    <p id="vista_fecha" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold" for="">Lugar</label>
                                    <p id="vista_lugar" class="form-control"></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
            <script src="../../scripts/acta.js"></script> <!-- script-->

</body>

</html>