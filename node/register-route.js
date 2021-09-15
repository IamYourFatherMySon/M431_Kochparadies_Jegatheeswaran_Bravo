var express = require('express');
var router = express.Router();
var db = require('/database');

router.get('/register', function(req, res, next){
  res.render('registration-form');
});

router.post('/register', function(req, res, next){
  inputData ={
    first_name: req.body.vorname,
    last_name: req.body.nachname,
    email_address: req.body.email,
    password: req.body.passwort
  }
  var sql = 'SELECT * FROM registration WHERE email = ?';
  db.query(sql, [inputData.email_address], function(err, data, fields){
    if(err) throw err
    if(data.length>1){
      var msg = inputData.email_address + 'existiert bereits';
    }else{
      var sql = 'INSERT INTO registration SET ?';
      db.query(sql, inputData, function(err, data){
        if(err) throw err;
      });
      var msg = 'Registrierung erfolgreich.';
    }
    res.render('registration-form',{alertMsg:msg});
  })
});
module.exports = router;