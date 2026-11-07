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

// Obtener total de votos
$total_votos = $conn->query("SELECT COUNT(*) AS total FROM votos")->fetch_assoc()['total'];

// Obtener votos por candidato a personero (mostrando también los que tienen 0 votos)
$sql_personero = "SELECT c.nombre, COALESCE(COUNT(v.voto_personero), 0) AS votos 
                  FROM candidatos c 
                  LEFT JOIN votos v ON c.id = v.voto_personero
                  GROUP BY c.id, c.nombre
                  ORDER BY votos DESC";
$result_personero = $conn->query($sql_personero);

// Obtener votos por candidato a contralor (mostrando también los que tienen 0 votos)
$sql_contralor = "SELECT c.nombre, COALESCE(COUNT(v.voto_contralor), 0) AS votos 
                  FROM candidatosb c 
                  LEFT JOIN votos v ON c.id = v.voto_contralor
                  GROUP BY c.id, c.nombre
                  ORDER BY votos DESC";
$result_contralor = $conn->query($sql_contralor);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Votación</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Resultados de la Votación</h1>

    <h2>Personero</h2>
    <table>
        <tr><th>Candidato</th><th>Votos</th><th>Porcentaje</th></tr>
        <?php
        while ($row = $result_personero->fetch_assoc()) {
            $porcentaje = ($total_votos > 0) ? round(($row['votos'] / $total_votos) * 100, 2) : 0;
            echo "<tr><td>{$row['nombre']}</td><td>{$row['votos']}</td><td>{$porcentaje}%</td></tr>";
        }
        ?>
    </table>

    <h2>Contralor</h2>
    <table>
        <tr><th>Candidato</th><th>Votos</th><th>Porcentaje</th></tr>
        <?php
        while ($row = $result_contralor->fetch_assoc()) {
            $porcentaje = ($total_votos > 0) ? round(($row['votos'] / $total_votos) * 100, 2) : 0;
            echo "<tr><td>{$row['nombre']}</td><td>{$row['votos']}</td><td>{$porcentaje}%</td></tr>";
        }
        ?>
    </table>

    <a href="votacion.php">Volver a Votar</a>
</body>
</html>
