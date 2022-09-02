var express = require('express');
var router = express.Router();
var Auth_mdw = require('../middlewares/auth');
/* GET users listing. */
router.get('/',Auth_mdw.no_check, function(req, res, next) {
  res.render('frontend/permintaan');
});

router.post('/add-permintaan', function (request, response) {
  response.render('frontend/respon_permintaan');
});
module.exports = router;
