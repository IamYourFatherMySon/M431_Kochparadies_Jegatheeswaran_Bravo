const { check } = require('express-validator');
 
exports.signupValidation = [
    check('vorname', 'Name is requied').not().isEmpty(),
    check('nachname', 'Name is requied').not().isEmpty(),
    check('email', 'Please include a valid email').isEmail().normalizeEmail({ gmail_remove_dots: true }),
    check('passwort', 'Password must be 6 or more characters').isLength({ min: 6 })
]
