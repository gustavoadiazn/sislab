<?php
$usuario = $_POST["usuario"];
$palabra_secreta = MD5($_POST["palabra_secreta"]);

require('conectarsislab.php');

$cadbusca = "SELECT * FROM usuarios where usuario='$usuario' and contrasenia='$palabra_secreta';";
$result = $db->query($cadbusca);
if ($row = $result->fetch_array()) {
    session_start();

    $_SESSION["usuario"] = $usuario;
    $_SESSION["nombre"] = $row["nombre"];

    header("Location: home.php");
} else {
    header("Location: logout.php");
}
