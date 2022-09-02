var Auth = {
    check_login: function (request, response, next) {
        if (!request.session.loggedin) {
            return response.redirect('/admin');
        }
        next();
    },
    check_session: function (request, response, next) {
        if (request.session.loggedin) {
            return response.redirect('/home');
        }
        next();
    },
    no_check: function (request, response, next) {
        next();
    }
};


module.exports = Auth;