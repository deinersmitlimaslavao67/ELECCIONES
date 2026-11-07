<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario ya votó
$usuario = $_SESSION['username']; 
$check_sql = "SELECT * FROM votos WHERE usuario = '$usuario'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    echo "<script>alert('Ya has votado. No puedes volver a votar.'); window.location.href='login.html';</script>";
    exit();
}

// Recibir votos del formulario
$voto_personero = $_POST['personero'];
$voto_contralor = $_POST['contralor'];

// Insertar el voto en la base de datos
$sql = "INSERT INTO votos (usuario, voto_personero, voto_contralor) VALUES ('$usuario', '$voto_personero', '$voto_contralor')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('¡Voto registrado con éxito!'); window.location.href='login.html';</script>";
} else {
    echo "Error al votar: " . $conn->error;
}

$conn->close();
?>
