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
    <title>Buscar Estudios con Datos</title>


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
                    <h1>Estudios</h1>
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
                        <h2 class="mt-0">Listado de Estudios</h2>
                        <hr class="divider" />
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <label for="selectEstudio">Estudios:</label>
                    <select id="selectEstudio" class="form-control" onchange="cargarDatos(this.value)">
                        <option value="">Seleccione un estudio</option>
                    </select>
                    <div class="col-lg-6">
                        <button class="btn btn-primary" onclick="mostrarModal()">Ingresar Nuevo Estudio</button>
                        <!-- Botón para actualizar el estudio seleccionado -->
                        <button id="btnActualizarEstudio" class="btn btn-warning mt-2" onclick="mostrarModalActualizarEstudio()" disabled>Actualizar Estudio</button>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Indicadores</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDatos"></tbody>
                    </table>

                    <!-- Botón para agregar un nuevo dato -->
                    <button class="btn btn-primary" onclick="mostrarModalNuevoDato()">Nuevo Dato</button>

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

    <!-- Modal Actualizar Estudio -->
    <div class="modal fade" id="modalActualizarEstudio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Estudio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formActualizarEstudio">
                        <input type="hidden" name="idestudio" id="idestudioActualizar">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombreActualizar" class="form-control" required>
                        <label>Costo:</label>
                        <input type="number" name="costo" id="costoActualizar" class="form-control" required>
                        <label>Descripción:</label>
                        <textarea name="descrip" id="descripActualizar" class="form-control" required></textarea>
                        <br>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Nuevo Dato -->
    <div class="modal fade" id="modalNuevoDato">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Dato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formNuevoDato">
                        <input type="hidden" id="idestudio" name="idestudio">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                        <label>Indicadores:</label>
                        <input type="text" name="indicadores" class="form-control" required>
                        <label>Descripción:</label>
                        <textarea name="descrip" class="form-control" required></textarea>
                        <br>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Actualizar Dato -->
    <div class="modal fade" id="modalActualizarDato">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Dato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formActualizarDato">
                        <input type="hidden" name="iddato" id="iddatoActualizar">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombreActualizar" class="form-control" required>
                        <label>Indicadores:</label>
                        <input type="text" name="indicadores" id="indicadoresActualizar" class="form-control" required>
                        <label>Descripción:</label>
                        <textarea name="descrip" id="descripActualizar" class="form-control" required></textarea>
                        <br>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        function mostrarModal() {
            var modal = new bootstrap.Modal(document.getElementById('modalNuevoEstudio'));
            modal.show();
        }

        $("#formNuevoEstudio").submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "crear_estudio.php",
                type: "POST",
                data: $("#formNuevoEstudio").serialize(),
                success: function(response) {
                    alert(response);
                    $("#modalNuevoEstudio").modal('hide'); // Cerrar modal

                    // Recargar dropdown y seleccionar el nuevo estudio
                    cargarEstudios(() => {
                        let nuevoIdEstudio = $("#ultimoIdEstudio").val();
                        $("#selectEstudio").val(nuevoIdEstudio).change(); // Seleccionar nuevo
                    });
                }
            });
        });

        $(document).ready(function() {
            cargarEstudios();
        });

        // Cargar Estudios en el Dropdown     
        function cargarEstudios(callback) {
            $.ajax({
                url: "listar_estudios_dropdown.php",
                type: "GET",
                success: function(data) {
                    $("#selectEstudio").html('<option value="">Seleccione un estudio</option>' + data);
                    if (callback) callback(); // Ejecutar callback después de cargar
                }
            });
        }

        // Cuando se selecciona un estudio, actualizar el botón
        function cargarDatos(idestudio) {
            if (idestudio) {
                $("#btnActualizarEstudio").prop("disabled", false); // Habilitar el botón
                $("#btnActualizarEstudio").attr("onclick", `mostrarModalActualizarEstudio(${idestudio})`);

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
            } else {
                $("#btnActualizarEstudio").prop("disabled", true); // Deshabilitar el botón
                $("#tablaDatos").html("");
                $("#btnNuevoDato").hide();
            }
        }

        function mostrarModalActualizarEstudio(idestudio) {
            $.ajax({
                url: "obtenerest.php",
                type: "GET",
                data: {
                    idestudio: idestudio
                },
                success: function(data) {
                    var estudio = JSON.parse(data);
                    $("#idestudioActualizar").val(estudio.idestudio);
                    $("#nombreActualizar").val(estudio.nombre);
                    $("#costoActualizar").val(estudio.costo);
                    $("#descripActualizar").val(estudio.descrip);
                    $("#modalActualizarEstudio").modal('show');
                }
            });
        }

        $("#formActualizarEstudio").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "actualizar_estudio.php",
                type: "POST",
                data: $("#formActualizarEstudio").serialize(),
                success: function(response) {
                    alert(response);
                    $("#modalActualizarEstudio").modal('hide');
                    cargarEstudios();
                }
            });
        });

        function mostrarModalActualizarDato(iddato) {
            $.ajax({
                url: "obtener_dato.php",
                type: "GET",
                data: {
                    iddato: iddato
                },
                success: function(data) {
                    var dato = JSON.parse(data);
                    $("#iddatoActualizar").val(dato.iddato);
                    $("#nombreActualizar").val(dato.nombre);
                    $("#indicadoresActualizar").val(dato.indicadores);
                    $("#descripActualizar").val(dato.descrip);
                    $("#modalActualizarDato").modal('show');
                }
            });
        }

        $("#formNuevoDato").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "agregar_dato.php",
                type: "POST",
                data: $("#formNuevoDato").serialize(),
                success: function(response) {
                    alert(response);
                    $("#modalNuevoDato").modal('hide');
                    cargarDatos($("#idestudio").val());
                }
            });
        });

        $("#formActualizarDato").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "actualizar_dato.php",
                type: "POST",
                data: $("#formActualizarDato").serialize(),
                success: function(response) {
                    alert(response);
                    $("#modalActualizarDato").modal('hide');
                    cargarDatos($("#idestudio").val());
                }
            });
        });

        function eliminarDato(iddato) {
            if (confirm("¿Seguro que quieres eliminar este dato?")) {
                $.ajax({
                    url: "eliminar_dato.php",
                    type: "POST",
                    data: {
                        iddato: iddato
                    },
                    success: function(response) {
                        alert(response);
                        cargarDatos($("#idestudio").val());
                    }
                });
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>