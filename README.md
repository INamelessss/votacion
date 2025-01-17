# Sistema de Votación - Perú

Este proyecto es un sistema de votación para las elecciones presidenciales de Perú en 2026. Permite a los usuarios registrar sus votos con las validaciones respectivas para cada campo del formulario.

## Requisitos

- **PHP**: Version 8.2.12
- **Servidor de base de datos**: MariaDB (versión 10.4.32)
- **Servidor web**: Apache (incluido en XAMPP)
- **phpMyAdmin**: Para la gestión de la base de datos (incluido en XAMPP)

## Instalación

1. **Clonar el repositorio**

   Clonar este repositorio en su máquina local utilizando Git:

   ```
   git clone https://github.com/INamelessss/votacion.git
   ```

2. **Mover el proyecto a la carpeta de XAMPP**
   
   Mueve la carpeta del proyecto a la carpeta htdocs de XAMPP.
   
3. **Configurar la base de datos**

- Abrir phpMyAdmin en el navegador web: http://localhost/phpmyadmin.
- Crear una nueva base de datos llamada votacion.
- Importar el archivo SQL que se encuentra en la carpeta sql para crear las tablas necesarias. Navega a la base de datos votacion en phpMyAdmin, y luego utiliza la pestaña "Importar" para subir el archivo sql/votacion.sql.

4. **Configurar la conexión a la base de datos**

- Abrir el archivo db.php para modificar la conexión a sus datos de preferencia.
- Configura las credenciales de conexión a la base de datos:
  ```
    <?php
    $server = "127.0.0.1"; #Puerto
    $user = "root"; #Usuario de la base de datos
    $password = ""; #Contraseña de la base de datos
    $db = "votacion"; #Nombre de la base de datos a usar
    
    $conn = new mysqli($server, $user, $password, $db);
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    ?>
5. **Configurar la conexión a la base de datos**
- Abrir el Panel de Control de XAMPP y asegurar de que los módulos Apache y MySQL estén iniciados.
- Navegar a http://localhost/votacion en su navegador web para acceder al sistema de votación.

Versiones
- PHP: 8.2.12
- MariaDB: 10.4.32
