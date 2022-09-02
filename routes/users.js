var express = require('express');
var router = express.Router();
var Auth_mdw = require('../middlewares/auth');

var postgreSql = require('../database');

const { Validator } = require('node-input-validator');

var bcrypt = require('bcrypt');
var fs = require('fs');
/* GET users listing. */
router.get('/', Auth_mdw.check_login, function (req, res, next) {
  res.render('backend/users', { emails: req.session.email, role: req.session.role });
});

router.post('/add-users', function (req, res, next) {
  const v = new Validator(req.body, {
    username: 'required',
    email: 'required|email',
    password: 'required',
    role: 'required',
  });
  v.check().then((matched) => {
    if (!matched) {
      res.json({ "errors": [v.errors] });
    } else {
      let Datapost = [{
        username: req.body.username,
        email: req.body.email,
        password: bcrypt.hashSync(req.body.password, 10),
        role: req.body.role
      }];
      
      var value = [req.body.username, req.body.email, bcrypt.hashSync(req.body.password, 10), req.body.role]
      postgreSql.query(
        `INSERT INTO "tbl_users" ("username", "email", "password", "role")  
        VALUES ($1, $2, $3, $4)`, value, (err, respon) => {
          if (err) {
            res.status(500).json({
              status: 500,
              message: err
          });
        } else {
          res.status(200).json({
            status: true,
            message: respon
          });
        }
      });
    }
  });
});

router.get('/edit-users/:id', function (req, res, next) {
  postgreSql.query("SELECT * FROM tbl_users WHERE id='" + req.params.id + "';", (err, response) => {
    if (err) {
      console.log(err);
    } else {
      res.status(200).json({
        status: 200,
        data: response.rows
      });
    }
  });
});

router.get('/data-users', function (req, res, next) {
  return new Promise(function (resolve, reject) {
    postgreSql.query("SELECT * FROM tbl_users;", (err, response) => {
      if (err) throw err;
      resolve(
        res.json({
          data: response.rows
        })
      );
    });
  });
});

router.post('/update-users', function (req, res, next) {
  const v = new Validator(req.body, {
    username: 'required',
    email: 'required|email',
    role: 'required',
  });
  v.check().then((matched) => {
    if (!matched) {
      res.json({ "warning": [v.errors] });
    } else {
      let id = req.body.id;

      var query = "UPDATE tbl_users SET username = ($1), email = ($2), role = ($3) WHERE id=($4)";
      var value = [req.body.username, req.body.email, req.body.role, id]
      postgreSql.query(query, value, (err, respon) => {
        if (err) {
          res.json(err);
        } else {
          res.status(200).json({
            status: true,
            message: respon
          });
        }
      });
    }
  });
});

router.get('/delete-users/:id', function (req, res, next) {
  var query = 'DELETE FROM "tbl_users" WHERE "id" = $1';
  postgreSql.query(query, [req.params.id], (err, respon) => {
    if (err) {
      console.error(err);
    } else {
      res.json({ success: true, message: respon });
    }
  });
});

router.get('/reset-password/:id', function (req, res, next) {
  var query = "UPDATE tbl_users SET password = ($1) WHERE id=($2)";
  postgreSql.query(query, [bcrypt.hashSync('123456', 10), req.params.id], (err, respon) => {
    if (err) {
      res.json(err);
    } else {
      res.status(200).json({
        status: true,
        message: respon
      });
    }
  });
});


router.get('/logs', function (req, res, next) {
  fs.readFile('./logs.log', 'utf8', (err, data) => {
    if (err) {
      console.error(err)
      return
    }
    res.json(data);
  })
});

module.exports = router;
