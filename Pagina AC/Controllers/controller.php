<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("Controllers/Conexion.php"); // Asegúrate de incluir tu conexión aquí
    
    

    if (isset($_POST["ingresar"])) {
        // Validar campos
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (empty($username) || empty($password)) {
            echo "<script>alert('Por favor, rellene todos los campos.');</script>";
        } else {
            // Preparar la consulta para evitar inyecciones SQL
            $stmt = $conexion->prepare("SELECT * FROM usuario WHERE nombre = ? AND contraseña = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Comprobar si se encontraron coincidencias
            if ($result->num_rows > 0) {
                // Aquí puedes manejar la lógica de inicio de sesión, como establecer sesiones
                echo "<script>alert('Inicio de sesión exitoso.');</script>";
                // Redireccionar o continuar con la lógica deseada
            } else {
                echo "<script>alert('Credenciales incorrectas.');</script>";
            }

            $stmt->close(); // Cerrar la sentencia
        }
    }

    if (isset($_POST["Registrarse"])) {
        // Manejo del registro
        $user = trim($_POST["name"]);
        $clave = trim($_POST["clave"]);
        $correo = trim($_POST["correo"]);

        if (empty($user) || empty($clave) || empty($correo)) {
            echo "<script>alert('Por favor, rellene todos los campos.');</script>";
        } else {
            // Preparar la consulta para insertar el usuario
            $stmt = $conexion->prepare("INSERT INTO `usuario` (`Nombre`, `Correo`, `Contraseña`) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $user, $correo, $clave);

            if ($stmt->execute()) {
                echo "<script>alert('Usuario creado exitosamente.');</script>";
            } else {
                echo "<script>alert('Error al crear el usuario.');</script>";
            }

            $stmt->close(); // Cerrar la sentencia
        }
    }
}
?>
