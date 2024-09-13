// Importar dependencias
const express = require('express');
const { engine } = require('express-handlebars');
const myconnection = require('express-myconnection');
const mysql = require('mysql');
const session = require('express-session');
const bodyParser = require('body-parser');

// Inicializar Express
const app = express();
app.set('port', 4000); // Configura el puerto

// Configura el directorio de las vistas
app.set('views', __dirname + '/views');

// Configura Handlebars como motor de plantillas
app.engine('.html', engine({
    extname: '.html', // Usar .html en lugar de .hbs
    layoutsDir: __dirname + '/views/layout', // Directorio de layouts
}));
app.set('view engine', 'html'); // Usa HTML como extensión de vistas

// Middleware para manejar los datos del cuerpo de las peticiones
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Configura el directorio de archivos estáticos (CSS, JS, imágenes, etc.)
app.use(express.static(__dirname + '/public'));

// Conexión a la base de datos MySQL
app.use(myconnection(mysql, {
    host: 'localhost',
    user: 'root',
    password: '', // Cambia esta contraseña si es necesario
    port: 3306,
    database: 'sistemaac' // Base de datos que usas
}));

// Inicia el servidor en el puerto especificado
app.listen(app.get('port'), () => {
    console.log('Listening on port', app.get('port'));
});

// Ruta principal que renderiza la vista 'login'
app.get('/', (req, res) => {
    res.render('login'); // Asegúrate de tener login.html en la carpeta views
});
