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
    <title>Buscar Tipo Servicios</title>


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
                    <h1>Tipo de Servicios</h1>
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
                        <h2 class="mt-0">Listado de Tipo de Servcios</h2>
                        <hr class="divider" />
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <button class="btn btn-primary mb-3" onclick="mostrarModal()">Ingresar Nuevo Tipo de Servicio</button>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaTipoServicios">
                            <?php
                            include("listarts.php");
                            ?>
                        </tbody>
                    </table>


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

    <!-- Modal -->
    <div class="modal fade" id="modalNuevo" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Tiop Servicios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formNuevo">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                        <label>Descripción:</label>
                        <input type="text" name="descrip" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Tipo Servicios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditar">
                        <input type="hidden" name="idtipoServicio">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                        <label>Descripción:</label>
                        <input type="text" name="descrip" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarModal() {
            var modal = new bootstrap.Modal(document.getElementById('modalNuevo'));
            modal.show();
        }

        function mostrarModalEditar(id) {
            $.ajax({
                url: "obtenerts.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    var datos = JSON.parse(response);
                    $("#modalEditar [name='idtipoServicio']").val(datos.idtipoServicio);
                    $("#modalEditar [name='nombre']").val(datos.nombre);
                    $("#modalEditar [name='descrip']").val(datos.descrip);

                    var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
                    modal.show();
                }
            });
        }

        $("#formNuevo").submit(function(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario
            $.ajax({
                url: "guardarts.php",
                type: "POST",
                data: $("#formNuevo").serialize(),
                success: function(response) {
                    alert(response);
                    $("#modalNuevo").modal('hide'); // Cierra el modal
                    actualizarTabla(); // Recarga la tabla con AJAX
                }
            });
        });

        $("#formEditar").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "actualizarts.php",
                type: "POST",
                data: $("#formEditar").serialize(),
                success: function(response) {
                    alert(response);
                    $("#modalEditar").modal('hide');
                    actualizarTabla();
                }
            });
        });

        function eliminarts(id) {
            if (confirm("¿Estás seguro de eliminar este paciente?")) {
                $.ajax({
                    url: "eliminarts.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        actualizarTabla();
                    }
                });
            }
        }

        function actualizarTabla() {
            $.ajax({
                url: "listarts.php",
                type: "GET",
                success: function(data) {
                    $("#tablaTipoServicios").html(data);
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>