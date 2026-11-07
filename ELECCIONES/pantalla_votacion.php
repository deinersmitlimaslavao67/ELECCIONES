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
$conn->set_charset("utf8");

if (!isset($_SESSION['username'])) {
    header("Location: login.html"); 
    exit();
}
$sql = "SELECT id, nombre, imagen FROM candidatos";
$result_personero = $conn->query($sql);


$sql = "SELECT id, nombre, imagen FROM candidatosb";
$result_contralor = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Votación</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    .contenedor-candidatos {
        display: flex;
        gap: 20px;
    }
    .candidato {
        border: 2px solid #ccc;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        position: relative;
    }
    .candidato img {
        width: 100px;
        height: 100px;
    }
    .marca-x {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 40px;
        font-weight: bold;
        color: red;
        display: none;
    }
    .candidato.seleccionado .marca-x {
        display: block;
    }
</style>

</head>
<body>

<div class="container">
    <h2>Bienvenido, <?php echo $_SESSION['username']; ?>!</h2>
    <p>Has iniciado sesión correctamente.</p>
    <a class="logout" href="logout.php">Cerrar Sesión</a>
</div>

<header>
    <h1>Elecciones Estudiantiles</h1>
</header>

<main>
    <h2>Vota por tu Personero</h2>
    <form action="votar.php" method="POST">
        <div class="contenedor-candidatos">
            <?php
            if ($result_personero->num_rows > 0) {
                while ($row = $result_personero->fetch_assoc()) {
                    echo "<div class='candidato' data-category='personero' data-id='" . $row['id'] . "'>";
                    echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "' class='candidato-img'>";
                    echo "<p>" . $row['nombre'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay candidatos registrados.</p>";
            }
            ?>
        </div>
        <input type="hidden" name="personero" id="personero-seleccionado">

        <h2>Vota por tu Contralor</h2>
        <div class="contenedor-candidatos">
            <?php
            if ($result_contralor->num_rows > 0) {
                while ($row = $result_contralor->fetch_assoc()) {
                    echo "<div class='candidato' data-category='contralor' data-id='" . $row['id'] . "'>";
                    echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "' class='candidato-img'>";
                    echo "<p>" . $row['nombre'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay candidatos registrados.</p>";
            }
            ?>
        </div>
        <input type="hidden" name="contralor" id="contralor-seleccionado">

        <button type="submit" class="btn-votar">Votar</button>
    </form>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const candidatos = document.querySelectorAll(".candidato");

        candidatos.forEach(candidato => {
            candidato.addEventListener("click", function() {
                const category = this.getAttribute("data-category");
                const candidateId = this.getAttribute("data-id");

                // Desmarcar cualquier selección anterior en la misma categoría
                document.querySelectorAll(`.candidato[data-category="${category}"]`).forEach(c => {
                    c.classList.remove("seleccionado");
                    let img = c.querySelector(".candidato-img");
                    img.style.filter = "none";  // Quita la X roja
                });

                // Marcar el seleccionado
                this.classList.add("seleccionado");
                let img = this.querySelector(".candidato-img");
                img.style.filter = "grayscale(100%) contrast(200%)";  // Simula la X roja

                // Guardar el ID en el input hidden correspondiente
                document.getElementById(category + "-seleccionado").value = candidateId;
            });
        });
    });
</script>



</body>

</body>

