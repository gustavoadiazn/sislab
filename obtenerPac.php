<?php
include 'conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $sql = "SELECT * FROM pacientes WHERE idpaciente = $id";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode([]);
    }
    $db->close();
}
