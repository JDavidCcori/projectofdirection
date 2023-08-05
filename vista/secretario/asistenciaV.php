<?php
require '../controlador/secretario/asistenciasC.php';
$data = AsistenciasC::mostrarTablaAsistencia();
$fecha = date('Y-m-d');

$result = null;

if (isset($_POST['submit'])) {
    $result = AsistenciasC::guardarAsistencia();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <style>
        table,
        th,
        td {
            margin-top: 30px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            width: 100%;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        th {
            padding: 10px;
            background: #464646;
            color: #fff;
        }

        td {
            padding: 10px;
        }

        .imagen-label {
            justify-content: flex-end;
            height: 45px;
            width: 100%;
        }

        .button {
            width: 100px;
            height: 50px;
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <h1>Registro de Asistencia</h1>
    <div class='table-responsive'>
        <form action="" method="post">
            <table class='table table-hover'>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha Asistencia</th>
                    <th>Estado de Asistencia</th>
                </tr>
                <tbody class="table-group-divider">
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?= $row['nombres'] ?></td>
                        <td><?= $row['apellidos'] ?></td>
                        <td><?= $fecha ?></td>
                        <td>
                            <input type="hidden" name="dni[]" value="<?= $row['dni'] ?>">
                            <input type="checkbox" id="<?= $row['dni'] ?>" name="estado[]" value="1" checked onchange="darValorCkb('<?= $row['dni'] ?>')">
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                
            </table>
            <button type="submit" name='submit'>Guardar Asistencia</button>
        </form>
    </div>


    <script>
        function darValorCkb(id) {
            let ckb = document.getElementById(id);
            if (ckb.checked) {
                ckb.value = '1';
            } else {
                ckb.value = '0';
            }
        }

        const result = <?php echo json_encode($result); ?>;
        if (result !== null) {
            if (result.success) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success("Asistencia registrada correctamente");
               
            } else {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success("Error: " + result.message);
            }
        }
    </script>
</body>

</html>