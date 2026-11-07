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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Obtener la contraseña almacenada en la base de datos
    $sql = "SELECT id, password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hash = $row['password']; // Contraseña almacenada (encriptada)

        // Verificar contraseña con password_verify()
        if ($pass === $hash)  {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $user;
            header("Location: pantalla_votacion.php"); // Página después de iniciar sesión
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location.href = 'login.html';</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location.href = 'login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
