var express = require('express');
var router = express.Router();
var Auth_mdw = require('../middlewares/auth');
/* GET users listing. */
router.get('/',Auth_mdw.no_check, function(req, res, next) {
  res.render('backend/docapi');
});
module.exports = router;