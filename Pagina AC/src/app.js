const express = require('express');
const { engine } = require('express-handlebars');
const myconnection = require('express-myconnection');
const mysql = require('mysql');
const session = require('express-session');
const bodyParser = require('body-parser');

const app = express();
app.set('port', 4000);

// Configura el directorio de las vistas
app.set('views', __dirname + '/views');

// Configura Handlebars con el layout principal
app.engine('.hbs', engine({
    extname: '.hbs',
    layoutsDir: __dirname + '/views/Layout', // Ruta de la carpeta de layouts
}));

app.set('view engine', 'hbs');

app.use(bodyParser.urlencoded({
    extended: true
}));
app
app.use(bodyParser.json());

app.use(myconnection(mysql, {
    host: 'localhost',
    user: 'root',
    password: '',
    port: 3306,
    database: 'sistemaac'
}));

// Inicia el servidor
app.listen(app.get('port'), () => {
    console.log('Listening on port', app.get('port'));
});


// Ruta principal que renderiza la vista 'home'
app.get('/', (req, res) => {
    res.render('home'); 
});

