<?php
ini_set("default_charset", "UTF-8");
mb_internal_encoding("UTF-8");
$fecha = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Buscar Registros</title>


    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styles/styles2.css" rel="stylesheet" />
    <link rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
    <script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20121025"></script>

    <style>
        /* Add CSS rules for the square border */
        .input-container {
            border: 2px solid #ccc;
            padding: 5px;
            display: inline-block;
            border-radius: 4px;
        }
    </style>

    <script>
        function showHint(str) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getPacientes.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>

</head>

<body id="page-top">
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <span class="navbar-brand mb-0 h1">
                <h1>Registros</h1>
            </span>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="container-fluid">
                    <a href="home.php" class="btn btn-info"> Menú </a>
                    <a href="logout.php" class="btn btn-light"> Salir </a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">Ingresa las fechas para su busqueda</h2>
                    <hr class="divider" />
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">

                    <form id="contactForm" name="form" action="reportegral2.php" target="_blank" method="post">
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <div class="row gx-4 gx-lg-5 justify-content-center">
                                <div class="col-lg-8 col-xl-6 text-center">
                                    <input id="theDate" class="form-control" type="text" readonly onclick="displayCalendar(document.forms[0].theDate,'yyyy-mm-dd',this)" name="theDate" size="10" value="<?php echo $fecha; ?>" />
                                    <label for="theDate">Fecha Inicio: </label>
                                </div>
                                <div class="col-lg-8 col-xl-6 text-center">
                                    <input id="theDate2" class="form-control" type="text" readonly onclick="displayCalendar(document.forms[0].theDate2,'yyyy-mm-dd',this)" name="theDate2" size="10" value="<?php echo $fecha; ?>" />
                                    <label for="theDate2">Fecha Término: </label>
                                </div>
                            </div>
                        </div>
                        <span id="txtHint"></span>
                        <br>
                        <hr class="divider" />
                        <br>
                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit">Buscar</button></div>
                    </form>
                </div>
            </div>



        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5">
                <div class="small text-center text-muted">Copyright &copy; 2025 - sislab</div>
            </div>
        </footer>
    </div>
</body>

</html>