<?php
$servername = "localhost";
$username = "root"; // Ajusta según tu configuración
$password = "";
$database = "usuarios"; // Cambia por el nombre real de tu base de datos

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grado = $_POST['grado'];
    $cantidad = $_POST['cantidad'];

    for ($i = 1; $i <= $cantidad; $i++) {
        $num_lista = str_pad($i, 2, '0', STR_PAD_LEFT); // Asegura tres dígitos
        $codigo = "iesjb" . $grado . $num_lista;

        $sql = "INSERT INTO usuarios ( `username`, `password`) VALUES ('$codigo', '$codigo')";
        if (!$conn->query($sql)) {
            echo "Error al registrar código: " . $conn->error;
        }
    }
    echo "Códigos generados y almacenados correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Códigos</title>
</head>
<body>
    <h2>Generador de Códigos de Estudiantes</h2>
    <form method="POST">
        <label for="grado">Selecciona el grado:</label>
        <select name="grado" required>
            <?php 
            $grados = ["001","002", "101", "102", "103", "201","202","203", "301", "302","303", "401", "402", "403", "404", 
                       "501", "502", "503", "504", "601", "602", "603", "604", "605", 
                       "701", "702", "703", "704", "705","801", "802", "803", "804",
                       "901", "902", "903","1001", "1002","1101"];
            foreach ($grados as $g) {
                echo "<option value='$g'>$g</option>";
            }
            ?>
        </select>

        <label for="cantidad">Cantidad de estudiantes:</label>
        <input type="number" name="cantidad" min="1" max="1101" required>

        <button type="submit">Generar Códigos</button>
    </form>
</body>
</html>
