var express = require('express');
var router = express.Router();
var Auth_mdw = require('../middlewares/auth');

router.get('/', Auth_mdw.check_login,function(request, response) {
	response.render('backend/home', {emails:request.session.email, role:request.session.role});
});

module.exports = router;
