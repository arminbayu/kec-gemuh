var express = require('express');
var router = express.Router();
var Auth_mdw = require('../middlewares/auth');

var postgreSql = require('../database');
const { Validator } = require('node-input-validator');

/* GET users listing. */
router.get('/', Auth_mdw.check_login, function (req, res, next) {
  res.render('backend/listpermintaan', { emails: req.session.email, role: req.session.role });
});

router.get('/listPermintaan', Auth_mdw.check_login, function (req, res, next) {
  postgreSql.query("SELECT id, nama, barang, merk, jumlah, status FROM tbl_permintaan ORDER BY created_at;", (err, respon) => {
    if (err) {
      console.log(err);
    } else {
      respon.rows.forEach((e, i, arr) => {
        arr[i].no = i+1;
        if(arr[i].status > 0){
          arr[i].aksi = (arr[i].status == 1) ? "Disetujui" : "Ditolak";
        }else{
          arr[i].aksi = '<button onClick="Edit(this, 1)" data-id="' + arr[i].id + '" id="setuju" class="btn btn-sm btn-success">Setuju</button>&nbsp;' +
          '<button onClick="Edit(this, 2)" data-id="' + arr[i].id + '" id="tolak" class="btn btn-sm btn-danger">Tolak</button>';
        }
      });
      res.status(200).json({
        status: true,
        data: respon.rows
      });
    }
  });
});

router.post('/edit-permintaan', function (req, res, next) {
  const v = new Validator(req.body, {
    id: 'required',
    status: 'required'
  });
  v.check().then((matched) => {
    if (!matched) {
      res.json({ "warning": [v.errors] });
    } else {
      let id = req.body.id;
      let status = req.body.status;

      var query = "UPDATE tbl_permintaan SET status = ($1) WHERE id=($2)";
      var value = [status, id]
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

module.exports = router;
