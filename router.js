const express = require('express');
const router = express.Router();
const db  = require('./database');
const session = require('express-session');
const { signupValidation } = require('./validation');
const { validationResult } = require('express-validator');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');


router.post('/register', signupValidation, (req, res, next) => {
  console.log(req);
  db.query(
    `SELECT * FROM registration WHERE LOWER(email) = LOWER(${db.escape(
      req.body.email
    )});`,
    (err, result) => {
      if (result.length) {
        return res.status(409).send({
          msg: 'This user is already in use!'
        });
      } else {
        // username is available
        bcrypt.hash(req.body.passwort, 10, (err, hash) => {
          if (err) {
            return res.status(500).send({
              msg: err
            });
          } else {
            // has hashed pw => add to database
            db.query(
              `INSERT INTO registration (vorname, nachname, email, passwort) VALUES ('${req.body.vorname}', '${req.body.nachname}', ${db.escape(
                req.body.email
              )}, ${db.escape(hash)})`,
              (err, result) => {
                if (err) {
                  throw err;
                  return res.status(400).send({
                    msg: err
                  });
                }
                return res.redirect('/pages/login.html');
              }
            );
          }
        });
      }
    }
  );
});

router.post('/auth', (req, res) => {
  const password = req.body.passwort;
  const email = req.body.email;
  var passwortHash = '$2a$10$TWAyYSsnPjOgPifMJ1rUOuruaojN9.h8P20OIuxgari/okGt/7Kfy';
  
  if(email && password){
    db.query('SELECT * FROM registration WHERE email = ? AND passwort = ?', [email,password],(error, result, fields) => {
    if(bcrypt.compareSync(password, passwortHash))
    {
        /*req.session.loggedin = true;
        req.session.email = email;*/
        res.redirect('/');
      }else{
        res.send('Falsche Mail und/oder Passwort');
      }
      res.end();
    });
  }else{
    res.send('Bitte Email und Passwort angeben');
    res.end();
  }
});
 
 
module.exports = router;