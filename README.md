# 🗳️ Sistema de Votación (Elecciones)

> Aplicación web desarrollada como proyecto académico para la gestión y realización de procesos de votación de forma local (`localhost`).

---

## 📋 Descripción del Proyecto
Este sistema permite gestionar el registro de usuarios, el inicio de sesión, la visualización de candidatos/opciones y el proceso de emisión y conteo de votos. Está diseñado para ofrecer una interfaz intuitiva tanto para los votantes como para la administración del proceso electoral.

---

## 🚀 Tecnologías Utilizadas
* **Backend:** PHP
* **Base de Datos:** MySQL / MariaDB (`elecciones.sql`)
* **Frontend:** HTML5, CSS3 (`styles.css`)
* **Entorno de ejecución local:** Apache / XAMPP o WAMP (`localhost`)

---

## 📁 Estructura del Proyecto

```text
ELECCIONES/
│
├── conexion.php           # Archivo de conexión a la base de datos MySQL
├── elecciones.sql         # Script con la estructura de la base de datos
├── login.php / html       # Módulo de autenticación de usuarios
├── register.php / html    # Módulo de registro de nuevos usuarios
├── dashboard.php          # Panel principal / resumen
├── pantalla_votacion.php  # Interfaz gráfica para emitir el voto
├── votar.php              # Lógica de procesamiento del voto
├── votos.php              # Gestión y conteo de votos
├── logout.php             # Cierre de sesión
├── codigos.php            # Funciones auxiliares o scripts adicionales
├── styles.css             # Hoja de estilos principal
└── imagenes/              # Recursos gráficos (candidatos, logos, etc.)
