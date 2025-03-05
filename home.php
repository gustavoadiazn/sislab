<?php
session_start();
$usuario = $_SESSION["usuario"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Principal</title>
        <link rel="stylesheet" href="styles/styles.css" type="text/css" media="screen" />
        <link href="styles/stylegallery.css" rel="stylesheet" type="text/css" />
</head>


<body>
        <div id="poptrox">
                <ul id="gallery">
                        <li><img src="images/menu.png" width="500px" alt="" /></li>
                        <br>
                        <?php
                        include("conectarsislab.php");
                        $sql = "SELECT pu.idpagina,pathDir,nombre FROM paginasxusuarios pu, paginas p WHERE ";
                        $sql .= "usuario='" . $usuario . "' and pu.idpagina=p.idpagina";
                        //Query table
                        $rs = @mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_array($rs)) {
                                $pathDir = $row["pathDir"];
                                $nombre = $row["nombre"];
                                if ($row["idpagina"] == "1000") { ?>
                                        <li>
                                                <a href="<?php echo $pathDir; ?>" class="bx3" rel="860-500">
                                                        <figure>
                                                                <img src="images/pacientes.jpg" width="100px" height="100px" alt="" />
                                                                <figcaption style="font-size: medium; color:darkorange"><?php echo $nombre; ?></figcaption>
                                                        </figure>
                                                </a>
                                        </li>
                                <?php } else if ($row["idpagina"] == "1001") { ?>
                                        <li>
                                                <a href="<?php echo $pathDir; ?>" class="bx3" rel="860-500">
                                                        <figure>
                                                                <img src="images/estudios.jpg" width="100px" height="100px" alt="" />
                                                                <figcaption style="font-size: medium; color:darkgoldenrod"><?php echo $nombre; ?></figcaption>
                                                        </figure>
                                                </a>
                                        </li>
                                <?php } else if ($row["idpagina"] == "1002") { ?>
                                        <li>
                                                <a href="<?php echo $pathDir; ?>" class="bx3" rel="860-500">
                                                        <figure>
                                                                <img src="images/servicios.jpg" width="100px" height="100px" alt="" />
                                                                <figcaption style="font-size: medium; color:darkgoldenrod"><?php echo $nombre; ?></figcaption>
                                                        </figure>
                                                </a>
                                        </li>
                                <?php } else if ($row["idpagina"] == "1003") { ?>
                                        <li>
                                                <a href="<?php echo $pathDir; ?>" class="bx3" rel="860-500">
                                                        <figure>
                                                                <img src="images/qfbs.jpg" width="100px" height="100px" alt="" />
                                                                <figcaption style="font-size: medium; color:darkgoldenrod"><?php echo $nombre; ?></figcaption>
                                                        </figure>
                                                </a>
                                        </li>
                                <?php } else if ($row["idpagina"] == "1004") { ?>
                                        <li>
                                                <a href="<?php echo $pathDir; ?>" class="bx3" rel="860-500">
                                                        <figure>
                                                                <img src="images/medicos.jpg" width="100px" height="100px" alt="" />
                                                                <figcaption style="font-size: medium; color:darkgoldenrod"><?php echo $nombre; ?></figcaption>
                                                        </figure>
                                                </a>
                                        </li>
                                <?php } else if ($row["idpagina"] == "1005") { ?>
                                        <li>
                                                <a href="<?php echo $pathDir; ?>" class="bx3" rel="860-500">
                                                        <figure>
                                                                <img src="images/turnos.jpg" width="100px" height="100px" alt="" />
                                                                <figcaption style="font-size: medium; color:darkgoldenrod"><?php echo $nombre; ?></figcaption>
                                                        </figure>
                                                </a>
                                        </li>
                        <?php }
                        }   ?>
                        <li>
                                <a href="logout.php" class="bx3" rel="860-500">
                                        <figure>
                                                <img src="images/salir.png" width="100px" height="100px" alt="" />
                                                <figcaption style="font-size: medium; color:darkgoldenrod">Salir</figcaption>
                                        </figure>
                                </a>
                        </li>
                </ul>
        </div>
        <script type="text/javascript" src="js/mootools.js"></script>
        <script type="text/javascript" src="js/bumpbox-2.0.1.js"></script>
        <script type="text/javascript">
                doBump('.bx2', 850, 500, '000', '6b7477', 0.7, 7, 2, '333', 15, '000', 3, Fx.Transitions.Back.easeOut, Fx.Transitions.linear);
        </script>
</body>

</html>