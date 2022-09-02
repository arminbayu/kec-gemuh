var express = require('express');
var router = express.Router();
var Auth_mdw = require('../middlewares/auth');

var postgreSql = require('../database');
const { Validator } = require('node-input-validator');

/* GET users listing. */
router.get('/',Auth_mdw.no_check, function(req, res, next) {
  res.render('frontend/permintaan');
});

router.post('/add-permintaan', function (req, res) {
  // console.log(req.files);
  const v = new Validator(req.body, {
    nama: 'required',
    barang: 'required',
    merk: 'required',
    jumlah: 'required',
  });
  v.check().then((matched) => {
    if (!matched) {
      res.json({ "errors": [v.errors] });
    } else {
      const file = req.files.file;
      const media = file.data.toString('base64');
      const dateTime = new Date();

      let value = [
        req.body.nama,
        req.body.barang,
        req.body.merk,
        req.body.jumlah,
        media,
        dateTime
      ];

      postgreSql.query(
        `INSERT INTO "tbl_permintaan" ("nama", "barang", "merk", "jumlah", "foto", "created_at")  
        VALUES ($1, $2, $3, $4, $5, $6)`, value, (err, respon) => {
          if (err) {
            console.log(err);
          } else {
            res.render('frontend/respon_permintaan');
          }
      });
    }
  });
});
module.exports = router;
