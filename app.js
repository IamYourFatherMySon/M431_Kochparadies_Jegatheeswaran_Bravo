var session = require('express-session');
app.use('/', router);
app.use(session({
  secret: '12345cat',
  resave: false,
  saveUninitialized: true,
  cookie:{maxAge: 6000}
}))