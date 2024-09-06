const mysql = require('mysql');

// Configuración de la conexión
const connection = mysql.createConnection({
  host: 'localhost',    // Solo el nombre del host      
  user: 'root',         // Nombre de usuario
  password: '',   // Contraseña
  database: 'sistemaac' // Nombre de la base de datos
});

// Conectar a la base de datos
connection.connect((err) => {
  if (err) {
    console.error('Error conectando a la base de datos:', err.stack);
    return;
  }
  console.log('Conectado a la base de datos con id ' + connection.threadId);
});

module.exports = connection;
