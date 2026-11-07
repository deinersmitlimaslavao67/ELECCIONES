<?php
session_start();

// Conexión a la base de datos
$host = "localhost";
$dbname = "usuarios";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se enviaron datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];  // Se almacena tal cual

    // Insertar usuario sin encriptar contraseña (NO RECOMENDADO)
    $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);

    if ($stmt->execute()) {
        echo "<script>
                alert('Usuario registrado correctamente');
                window.location.href = 'login.html';
              </script>";
    } else {
        echo "<script>alert('Error al registrar usuario');</script>";
    }
    $stmt->close();
}

$conn->close();
?>
