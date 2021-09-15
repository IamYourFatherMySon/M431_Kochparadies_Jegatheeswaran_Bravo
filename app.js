const createError = require('http-errors');
const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');
const cors = require('cors');
const indexRouter = require('./router.js');
const router = require('./router.js');
 
const app = express();
 
app.use(express.json());
 
app.use(cors());
app.use(express.static('public'))
    .use('/css', express.static(__dirname + 'public/css'))
    .use('/images', express.static(__dirname + 'public/images'))
    .use('/pages', express.static(__dirname + 'public/pages'))
    .use('/music', express.static(__dirname + 'public/sound'))
    .use('/files', express.static(__dirname + '/public/imagesselbst'))
    .use(cors())
    .use(bodyParser.json())
    .use(bodyParser.urlencoded({extended: true}));
 
app.get('', (request, response) => {
  response.sendFile(__dirname + '/home.html');

});

app.use('/api', router);

 
// Handling Errors
app.use((err, req, res, next) => {
    // console.log(err);
    err.statusCode = err.statusCode || 500;
    err.message = err.message || "Internal Server Error";
    res.status(err.statusCode).json({
      message: err.message,
    });
});
 
app.listen(8080,() => console.log('Server is running on port 8080'));