var express = require('express');
var session = require('express-session');
var ejs = require('ejs-locals');
var path = require('path');
var flash = require('connect-flash');
const log4js = require('log4js');

log4js.configure({
  appenders: { everything: { type: 'file', filename: 'logs.log' } },
  categories: { default: { appenders: ['everything'], level: 'ALL' } }
});

const winston = require('winston');

var bodyParser = require('body-parser');
const fileUpload = require('express-fileupload');
var logger = require('morgan');
var cookieParser = require('cookie-parser');

var createError = require('http-errors');

var indexRouter = require('./routes/index');
var loginRouter = require('./routes/login');
var listmessageRouter = require('./routes/listmessage');
var sendwaRouter = require('./routes/sendwa');
var usersRouter = require('./routes/users');
var docapiRouter = require('./routes/docapi');

var app = express();
// var sessionStore = new session.MemoryStore;
app.use(session({
  secret: 'keyboard cat',
  resave: false,
  saveUninitialized: true,
  // cookie: { maxAge: 60000 },
}));
app.use(flash());

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// default options
app.use(fileUpload());
// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.engine('ejs', ejs);
app.set('view engine', 'ejs');

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

// Login Page
app.use('/', loginRouter);
// Route Home
app.use('/home', indexRouter);
// Route Login
app.use('/login', loginRouter);
app.use('/auth', loginRouter);
app.use('/logout', loginRouter);
// Route List Message
app.use('/message', listmessageRouter);
app.use('/message/listMessage', listmessageRouter);
// Route Send Wa
app.use('/sendwa', sendwaRouter);
app.use('/sendwa/send-message', sendwaRouter);
app.use('/sendwa/listSender', sendwaRouter);
app.use('/sendwa/version', sendwaRouter);
// Route Users
app.use('/users', usersRouter);
app.use('/users/add-users', usersRouter);
app.use('/users/data-users', usersRouter);
app.use('/users/update-users', usersRouter);
app.use('/users/delete-users', usersRouter);
app.use('/users/edit-users', usersRouter);
app.use('/users/reset-password', usersRouter);
app.use('/users/logs', usersRouter);
// Route Doc Api
app.use('/docs-api', docapiRouter);

const logging = winston.createLogger({
  level: 'info',
  format: winston.format.json(),
  defaultMeta: { service: 'user-service' },
  transports: [
    //
    // - Write all logs with level `error` and below to `error.log`
    // - Write all logs with level `info` and below to `combined.log`
    //
    new winston.transports.File({ filename: 'error.log', level: 'error' }),
    new winston.transports.File({ filename: 'combined.log' }),
  ],
});

if (process.env.NODE_ENV !== 'production') {
  logging.add(new winston.transports.Console({
    format: winston.format.simple(),
  }));
}

module.exports = app;