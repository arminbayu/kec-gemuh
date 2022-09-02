var express = require('express');
var router = express.Router();
var Auth_mdw = require('../middlewares/auth');

var postgreSql = require('../database');

/* GET users listing. */
router.get('/', Auth_mdw.check_login,function(req, res, next) {
  return res.render('backend/sendwa',{
    success: req.flash("success"),
    errors: req.flash("errors"),
    emails:req.session.email, 
    role:req.session.role
  });
});

router.get('/listSender', Auth_mdw.check_login,function(req, res, next) {
  postgreSql.query("SELECT * FROM wa_sessions ORDER BY created_at DESC LIMIT 1;", (err, respon) => {
    if (err) {
      console.log(err);
    } else {
      var savedSessions = [];
      if (respon.rows.length > 0) {
        savedSessions = respon.rows[0].session;
      }
      return res.status(200).json({
        status: 200,
        data:savedSessions,
        message: 'success'
      });
    }
  });
 
});

module.exports = router;
