<?php
include '../conectarsislab.php'; // Archivo de conexión a la base de datos
//ini_set("default_charset", "UTF-8");
//mb_internal_encoding("UTF-8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Buscar Turnos</title>


    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../styles/styles2.css" rel="stylesheet" />

    <style>
        /* Add CSS rules for the square border */
        .input-container {
            border: 2px solid #ccc;
            padding: 5px;
            display: inline-block;
            border-radius: 4px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <div class="container mt-4">
        <!-- Navigation-->
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <span class="navbar-brand mb-0 h1">
                    <h1>Turnos</h1>
                </span>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="container-fluid">
                        <a href="../home.php" class="btn btn-info"> Menú </a>
                        <a href="../logout.php" class="btn btn-light"> Salir </a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <!-- Contact-->
            <section class="page-section" id="contact">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Listado de Turnos</h2>
                        <hr class="divider" />
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <button class="btn btn-primary mb-3" onclick="mostrarModal()">Ingresar Nuevo Turno</button>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Costo</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaEstudios">
                            <!-- Datos cargados con AJAX -->
                        </tbody>
                    </table>

                    <button class="btn btn-primary" onclick="ModalNuevoEstudio()">Nuevo Estudio</button>

                    <h3>Datos del Estudio Seleccionado</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Dato</th>
                                <th>Nombre</th>
                                <th>Indicadores</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDatos">
                            <!-- Se llenará con AJAX al seleccionar un estudio -->
                        </tbody>
                    </table>

                    <button class="btn btn-success" onclick="ModalNuevoDato()" style="display: none;" id="btnNuevoDato">Nuevo Dato</button>



                </div>
            </section>
            <!-- Footer-->
            <footer class="bg-light py-5">
                <div class="container px-4 px-lg-5">
                    <div class="small text-center text-muted">Copyright &copy; 2025 - sislab</div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Nuevo Estudio -->
    <div class="modal fade" id="modalNuevoEstudio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Estudio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formNuevoEstudio">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                        <label>Costo:</label>
                        <input type="number" name="costo" class="form-control" required>
                        <label>Descripción:</label>
                        <textarea name="descrip" class="form-control" required></textarea>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script>
        $("#formNuevoEstudio").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "crear_estudio.php",
                type: "POST",
                data: $("#formNuevoEstudio").serialize(),
                success: function(response) {
                    alert(response);
                    $("#modalNuevoEstudio").modal('hide');
                    cargarEstudios();
                }
            });
        });


        $(document).ready(function() {
            cargarEstudios();
        });

        // Cargar Estudios
        function cargarEstudios() {
            $.ajax({
                url: "listar_estudios.php",
                type: "GET",
                success: function(data) {
                    $("#tablaEstudios").html(data);
                }
            });
        }

        // Cargar Datos por Estudio
        function cargarDatos(idestudio) {
            $.ajax({
                url: "listar_datos.php",
                type: "GET",
                data: {
                    idestudio: idestudio
                },
                success: function(data) {
                    $("#tablaDatos").html(data);
                    $("#btnNuevoDato").show();
                    $("#btnNuevoDato").attr("onclick", `mostrarModalNuevoDato(${idestudio})`);
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>