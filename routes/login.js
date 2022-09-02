var express = require('express');
var bcrypt = require('bcrypt');
var router = express.Router()

var postgreSql = require('../database');

const { body, validationResult } = require('express-validator');

const log4js = require('log4js');
log4js.configure({
  appenders: { everything: { type: 'file', filename: 'logs.log' } },
  categories: { default: { appenders: ['everything'], level: 'ALL' } }
});
const loggers = log4js.getLogger();

var auth_middlewares = require('../middlewares/auth');
router.get('/', auth_middlewares.check_session, function (req, res, next) {
  return res.render('backend/login', {
    success: req.flash("success"), errors: req.flash("errors")
  });
});

router.post('/auth', [
  body('email').notEmpty(),
  body('password').notEmpty(),
], async (request, response) => {
  const errors = validationResult(request).formatWith(({
    msg
  }) => {
    return msg;
  });
  
  if (!errors.isEmpty()) {
    loggers.info('errors', Object.values(errors.mapped()));
    request.flash('errors', Object.values(errors.mapped()));
    response.redirect('/admin');
  } else {
    postgreSql.query("SELECT * FROM tbl_users WHERE email='" + request.body.email + "';", (err, res) => {
      if (err){
        console.log(err);
      }else{
        if (res.rows.length > 0) {
          const equels = bcrypt.compareSync(request.body.password, res.rows[0].password);
          if (!equels) {
            loggers.info('errors', 'Corect, Password Wrong');
            request.flash('errors', 'Corect, Password Wrong');
            response.redirect('/admin');
          } else {
            request.session.loggedin = true;
            request.session.email = request.body.email;
            request.session.role = res.rows[0].role;
            response.cookie('rememberme', '1', { expires: new Date(Date.now() + 900000), httpOnly: true })
            loggers.debug('Success Login ' + request.body.email);
            response.render('backend/home', { emails: request.session.email, role: request.session.role });
          }
        } else {
          loggers.info('errors', 'Correct Email, Email Not Found');
          request.flash('errors', 'Correct Email, Email Not Found');
          response.redirect('/admin');
        }
      }
    });
  }
});

router.get('/logout', function (request, response) {
  request.session.destroy(function (err) {
    if (err) {
      console.log(err);
      loggers.error('Error Logout ' + err);
    }
    else {
      loggers.debug('Success Logout');
      response.redirect('/');
    }
  });
});

module.exports = router;
