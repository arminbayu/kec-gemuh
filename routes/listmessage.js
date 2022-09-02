var express = require('express');
var router = express.Router();
var Auth_mdw = require('../middlewares/auth');

var postgreSql = require('../database');

/* GET users listing. */
router.get('/', Auth_mdw.check_login, function (req, res, next) {
  res.render('backend/listmessage', { emails: req.session.email, role: req.session.role });
});
router.get('/listMessage', Auth_mdw.check_login, function (req, res, next) {
  postgreSql.query("SELECT * FROM tbl_message;", (err, respon) => {
    if (err) {
      console.log(err);
    } else {
      res.status(200).json({
        status: true,
        data: respon.rows
      });
    }
  });
});
module.exports = router;
