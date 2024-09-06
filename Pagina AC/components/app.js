const connection = require('/Users/FIORELLA/Documents/GitHub/A.C-Asset-Control-/Pagina AC/components/conexion');

// Consulta de ejemplo
var query = 'SELECT * FROM archivo';

connection.query(query, (err, results) => {
  if (err) {
    console.error('Error al ejecutar la consulta:', err.stack);
    return;
  }
  console.log('Resultados de la consulta:', results);
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*            Logica login                 */ 
var username = document.getElementById('username').value;
var password = document.getElementById('password').value;

// Use parameterized queries to prevent SQL injection
var query = "SELECT * FROM usuario WHERE Nombre = ? AND Contraseña = ?";

connection.query(query, [username, password], (err, results) => {
  if (err) {
    console.error('Error al ejecutar la consulta:', err.stack);
    return;
  }
  if (results.length > 0) {
    console.log('Login successful!');
    // Redirect to a secure page or perform other login logic
  } else {
    console.log('Invalid username or password');
  }
});



/*             Logica Register             */ 
document.getElementById('registrarse').addEventListener('submit', function(event) {
  // Prevenir el comportamiento por defecto del formulario
  event.preventDefault();

  // Obtener los valores del formulario
  const nombre = document.getElementById('nombre').value.trim();
  const clave = document.getElementById('clave').value.trim();
  const correo = document.getElementById('correo').value.trim();

  // Validar los campos
  if (!nombre || !clave || !correo) {
    alert('Por favor, complete todos los campos.');
    return;
  }

  if (!validateEmail(correo)) {
    alert('Por favor, ingrese un correo electrónico válido.');
    return;
  }

  // Consulta SQL
  const consulta = "INSERT INTO `usuario`(`Nombre`, `Correo`, `Contraseña`) VALUES (?,?,?)";

  // Ejecutar la consulta
  connection.query(consulta, [nombre, clave, correo], (err, results) => {
    if (err) {
      console.error('Error al ejecutar la consulta:', err.stack);
      alert('Hubo un error al crear el usuario. Por favor, inténtelo de nuevo.');
      return;
    }
    
    // Mensaje de éxito y redirección
    alert('Usuario creado exitosamente.');
    window.location.href = '/pagina-de-exito'; // Redirigir a una página de éxito
  });
});

// Función para validar el formato del correo electrónico
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(String(email).toLowerCase());
}
connection.end();