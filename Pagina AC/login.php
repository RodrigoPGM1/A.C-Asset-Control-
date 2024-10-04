<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/stylesheet.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="logo titulo.png" type="image/png">
    <title>Login</title>
</head>

<body>
    <div class="conteiner">
        <div class="curved-shape"></div>
        <div class="curved-shape2"></div>
        <div class="form-box Login">
            <h2 class="animacion" style="--D:0; --S:21">Iniciar Sesion</h2>

            <?php
            session_start(); // Iniciar sesión al principio del archivo

            include("Controllers/Conexion.php");
            include("Controllers/controller.php"); 

            // Verificar si el formulario de inicio de sesión fue enviado
            if (isset($_POST['ingresar'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Preparar la consulta para verificar las credenciales
                $stmt = $conexion->prepare("SELECT * FROM usuario WHERE nombre = ? AND contraseña = ?");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Almacenar el nombre de usuario en la sesión
                    $_SESSION['username'] = $username; 
                    header("Location: paginaweb/index.html");// Redirigir a index.html
                    exit(); // Terminar el script para evitar que se ejecute el resto del código
                } else {
                    echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>"; // Mensaje de error
                }

                $stmt->close(); // Cerrar la sentencia
            }
            ?> 

            <form action="" method="POST">
                <div class="input-box animacion" style="--D:1; --S:22">
                    <input type="text" name="username" id="username" required>
                    <label for="">Nombre</label>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box animacion" style="--D:2; --S:23">
                    <input type="password" name="password" id="password" required>
                    <label for="">Password</label>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <div class="input-box animacion" style="--D:3; --S:24">
                    <button type="submit" class="btn" name="ingresar">Login</button>
                </div>
                <div class="regi-link animacion" style="--D:4; --S:25">
                    <p>¿No tienes cuenta? <a href="#" class="registrarse">Registrate aqui</a></p>
                </div>
            </form>
        </div>
        <div class="info-content Login">
            <h2 class="animacion" style="--D:0; --S:20">Bienvenido de nuevo</h2>
            <p class="animacion" style="--D:1; --S:21">Revisa todo lo correspondiente a tus documentos recibidos y emitidos</p>
        </div>
        <div class="form-box Registrate">
            <h2 class="animacion" style="--li:17; --S:0">Registrarse</h2>
            <form action="" method="POST">
                <div class="input-box animacion" style="--li:18; --S:1">
                    <input type="text" name="name" id="nombre" required>
                    <label for="">Nombre</label>
                    <i class='bx bx-id-card'></i>
                </div>
                <div class="input-box animacion" style="--li:19; --S:2">
                    <input type="email" name="correo" id="correo" required>
                    <label for="">Email</label>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box animacion" style="--li:19; --S:2">
                    <input type="password" name="clave" id="clave" required>
                    <label for="">Contraseña</label>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <div class="input-box animacion" style="--li:20; --S:3">
                    <button type="submit" class="btn" name="Registrarse">Registrate</button>
                </div>
                <div class="regi-link animacion" style="--li:21; --S:4">
                    <p>¿Ya tienes cuenta? <a href="#" class="Iniciarlink">Iniciar Sesion</a></p>
                </div>
            </form>
        </div>
        <div class="info-content Registrate">
            <h2 class="animacion" style="--li:17; --S:0">Registrate</h2>
            <p class="animacion" style="--li:18; --S:1">¡OjO! Necesitas completar todos los campos para crear tu cuenta </p>
        </div>
    </div>
    <script src="scripts/scriptstyle.js"></script>
</body>
</html>

