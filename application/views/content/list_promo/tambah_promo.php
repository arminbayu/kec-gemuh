<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/select2/select2.min.js"></script>
<style media="screen">
  .col-md-12 {
    margin-top: 10px
  }
</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Promo</h3>
            </div>

            <div class="box-body">
              <div class="row">
                <form id="form_promo">

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Jenis Promo : </label>
                      <select class="form-control" name="jenis_promo" id="jenis_promo" required>
                        <option value="">-Pilih-</option>
                        <option value="1">Kode Promo</option>
                        <option value="2">Diskon</option>
                        <option value="3">Admin Cashback Poin</option>
                        <option value="4">Promo Ongkir</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label>Kode : </label>
                        <div class="input-group">
                          <span type="button" class="input-group-addon btn btn-primary" onclick="makeid()">Random Kode</span>
                          <input type="text" class="form-control" id="kode" maxlength="9" name="kode" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12" id="div_promo_ongkir" hidden>
                    <div class="col-md-12 mb-3">
                      <label>Gratis Ongkir : </label>
                      <table>
                        <td class="text-center">
                          <label class="switch" style="margin-right:10px;">
                            <input type="checkbox" onclick="set_on_off_promo_ongkir(this)" id="toggle_promo_ongkir">
                            <span class="slider round"></span>
                          </label>
                        </td>
                        <td class="text-left" style="text-align: left;vertical-align: center;">
                          <label id="label_promo_ongkir" class="label label-default">
                            <span>Tidak<span>
                          </label>
                        </td>
                        <input type="text" name="status" id="promo_ongkir" value="2" hidden required>
                      </table>
                    </div>
                  </div>

                  <div class="col-md-12" id="div_promo_presentase" hidden>
                    <div class="col-md-12 mb-3">
                      <label>Persentase Promo : </label>
                      <input type="number" class="form-control" id="persen" name="persen" min="1" max="100" autocomplete="on">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Nominal : </label>
                      <input type="number" class="form-control" id="nominal" name="nominal" autocomplete="on" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Tanggal Berlaku : </label>
                      <div class="input-group input-group-sm col-md-12 mb-3">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control" id="dateRangePiker" value="<?php echo date('d/m/Y')?>" readonly>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Minimal Qty : </label>
                      <input type="number" class="form-control" id="min_qty" name="min_qty" autocomplete="on">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Minimal Transaksi : </label>
                      <input type="number" class="form-control" id="min_harga" name="min_harga" autocomplete="on">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Kelipatan : </label>
                      <input type="number" class="form-control" id="kelipatan" name="kelipatan" autocomplete="on" readonly>
                      <span>* Nilai tidak boleh lebih dari Minimal Transaksi</span>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Kuota Promo : </label>
                      <input type="number" class="form-control" id="kuota" name="kuota" autocomplete="on">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Kuota Harian : </label>
                      <input type="number" class="form-control" id="kuota_harian" name="kuota_harian" value="1" autocomplete="on">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Provinsi : </label>
                      <select class="form-control" id="provinsi">
                        <option value="">-- Pilih Provinsi --</option>
                         <?php
                           if(!empty($provinsi)) {
                             foreach ($provinsi as $key => $value) {
                               echo '<option value="'.$value->propinsi.'">'.$value->nama.'</option>';
                             }
                           }
                          ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Kota : </label>
                      <select class="form-control" id="kota">
                        <option value="">-- pilih Kota --</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Status : </label>
                      <table>
                        <td class="text-center">
                          <label class="switch" style="margin-right:10px;">
                            <input type="checkbox" onclick="set_on_off(this)" id="toggle_status" checked>
                            <span class="slider round"></span>
                          </label>
                        </td>
                        <td class="text-left" style="text-align: left;vertical-align: center;">
                          <label id="label_status" class="label label-success">
                            <span>Aktif<span>
                          </label>
                        </td>
                        <input type="text" name="status" id="status" value="1" hidden required>
                      </table>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Berlaku untuk semua produk : </label>
                      <table>
                        <td class="text-center">
                          <label class="switch" style="margin-right:10px;">
                            <input type="checkbox" onclick="set_on_off_produk(this)" id="toggle_status_produk" checked>
                            <span class="slider round"></span>
                          </label>
                        </td>
                        <td class="text-left" style="text-align: left;vertical-align: center;">
                          <label id="label_status_produk" class="label label-success">
                            <span>Iya<span>
                          </label>
                        </td>
                        <input type="text" name="status" id="status_produk" value="1" hidden required>
                      </table>
                    </div>
                  </div>

                  <div class="col-md-12" id="div_pilih_produk" hidden>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label>Pilih Produk : </label>
                        <div class="input-group">
                          <select id="select_to" name="produk[]" class="form-control select2" multiple="multiple" data-placeholder="Produk:" style="width:100%"></select>
                          <span class="input-group-addon"></span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-12 mb-3">
                      <label>Berlaku untuk semua jenis pembayaran : </label>
                      <table>
                        <td class="text-center">
                          <label class="switch" style="margin-right:10px;">
                            <input type="checkbox" onclick="set_on_off_pembayaran(this)" id="toggle_status_pembayaran" checked>
                            <span class="slider round"></span>
                          </label>
                        </td>
                        <td class="text-left" style="text-align: left;vertical-align: center;">
                          <label id="label_status_pembayaran" class="label label-success">
                            <span>Iya<span>
                          </label>
                        </td>
                        <input type="text" name="status" id="status_pembayaran" value="1" hidden required>
                      </table>
                    </div>
                  </div>

                  <div class="col-md-12" id="div_pilih_pembayaran" hidden>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label>Pilih Pembayaran : </label>
                        <div class="input-group">
                          <select id="select_to_pembayaran" name="pembayaran[]" class="form-control select2-pembayaran" multiple="multiple" data-placeholder="Pembayaran:" style="width:100%"></select>
                          <span class="input-group-addon"></span>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="col-md-12">
                      <div class="col-md-5" style="margin-top:10px;">
                      </div>
                      <div class="col-md-4" style="margin-top:10px;">
                        <button type="button" class="btn btn-primary" onclick="kembali()" style="margin-right:10px">Kembali</button>
                        <button type="button" id="tambah_promo" class="btn btn-success" name="button">Simpan</button>
                      </div>
                    </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div>
</div>
</section>

<script type="text/javascript">
  var d = new Date();
  var dateDef = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate();

  var array_simpan = {
    promo_id        : '<?php echo $promo_id ?>',
    kode_promo      : '',
    minimal_qty     : '',
    minimal_harga   : '',
    kelipatan       : '',
    persen          : '',
    nominal_promo   : '',
    kuota           : '',
    kuota_harian    : '',
    jenis_promo     : '',
    is_aktif        : 1,
    tanggal_mulai   : dateDef,
    tanggal_selesai : dateDef,
    provinsi_id     : '',
    kota_id         : '',
    is_all          : 1,
    produk_id       : [],
    is_all_pembayaran   : 1,
    jenis_pembayaran_id : [],
  };

  function formatState (state) {
    if (!state.id) {
      return state.text;
    }
    var $state = $(
      '<span><img src="'+state.imageUrl+ '"  class="img-flag" style="width:50px;height:50px;" /> ' +state.text+ '</span>'
    );
    return $state;
  };

  $(".select2").select2({
    templateResult: formatState,
    ajax: {
      url: '<?php echo base_url('list_promo/get_produk')?>',
      data: function (params) {
       var query = {
         search: params.term,
         page: params.page || 1
       }
       return query;
     },
      dataType: 'json'
    }
  });

  function formatState (state) {
    if (!state.id) {
      return state.text;
    }
    var $state = $(
      '<span><img src="'+state.imageUrl+ '"  class="img-flag" style="width:50px;height:50px;" /> ' +state.text+ '</span>'
    );
    return $state;
  };

  $(".select2-pembayaran").select2({
    templateResult: formatState,
    ajax: {
      url: '<?php echo base_url('list_promo/get_pembayaran')?>',
      data: function (params) {
       var query = {
         search: params.term,
         page: params.page || 1
       }
       return query;
     },
      dataType: 'json'
    }
  });

  $('#provinsi').click(function(){
    $('#kota').empty();
    array_simpan.provinsi_id = $(this).val();
    $.ajax({
      url   : '<?php echo base_url('list_promo/get_data_kota');?>',
      data  : {
        id : $(this).val()
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        $('#kota').append('<option value="">-- Pilih Kota --</option>');
        r.map(function( item, i ) {
          $('#kota').append('<option value="'+item.kabkota+'">'+item.nama+'</option>');
        });
      }
    });
  });

  $('#jenis_promo').click(function(){
    array_simpan.jenis_promo = $(this).val();
    if ($(this).val() == 4) {
      $('#div_promo_ongkir').show();
    }else {
      $('#div_promo_ongkir').hide();
    }
    if ($(this).val() != 2) {
      $('#persen').prop('required', true);
      $('#div_promo_presentase').show();
    }else {
      $('#persen').val(100);
      $('#persen').prop('required', false);
      $('#div_promo_presentase').hide();
    }
    // makeid(false);
  });

  function makeid() {
      var result           = '';
      var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      var charactersLength = characters.length;
      for ( var i = 0; i < 7; i++ ) {
        result += characters.charAt(Math.floor(Math.random() *  charactersLength));
     }
     $('#kode').val(result);
     // if (ulang) {
     //   setTimeout(function(){
     //     simpan_promo();
     //   }, 100)
     // }
  }

  function kembali() {
    location.replace('<?php echo base_url('list_promo') ?>');
  }

  $('#dateRangePiker').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  },function(start, end) {
    array_simpan.tanggal_mulai   = start.format('YYYY-MM-DD');
    array_simpan.tanggal_selesai = end.format('YYYY-MM-DD');
  });

 function set_on_off(v) {
   var value = (v.checked == true) ? '1' : '0';
   fungsi_set_status(value);
 }

 function fungsi_set_status(value) {
   array_simpan.is_aktif = value;
   $('[name=status]').val(value);
   if (value == 0) {
     $('#label_status').removeClass('label label-success').addClass('label label-default').html('Tidak Aktif');
   }else {
     $('#label_status').removeClass('label label-default').addClass('label label-success').html('Aktif');
   }
 }

 function set_on_off_produk(v) {
   var value = (v.checked == true) ? '1' : '0';
   fungsi_set_status_produk(value);
 }

 function fungsi_set_status_produk(value) {
   array_simpan.is_all = value;
   $('[name=status_produk]').val(value);
   if (value == 0) {
     $('#label_status_produk').removeClass('label label-success').addClass('label label-default').html('Tidak');
     $('#div_pilih_produk').show();
     $('#select_to').prop('required', true);
   }else {
     $('#label_status_produk').removeClass('label label-default').addClass('label label-success').html('Iya');
     $('#div_pilih_produk').hide();
     $('#select_to').prop('required', false);
   }
 }

 function set_on_off_pembayaran(v) {
   var value = (v.checked == true) ? '1' : '0';
   fungsi_set_status_pembayaran(value);
 }

 function fungsi_set_status_pembayaran(value) {
   array_simpan.is_all_pembayaran = value;
   $('[name=status_pembayaran]').val(value);
   if (value == 0) {
     $('#label_status_pembayaran').removeClass('label label-success').addClass('label label-default').html('Tidak');
     $('#div_pilih_pembayaran').show();
     $('#select_to_pembayaran').prop('required', true);
   }else {
     $('#label_status_pembayaran').removeClass('label label-default').addClass('label label-success').html('Iya');
     $('#div_pilih_pembayaran').hide();
     $('#select_to_pembayaran').prop('required', false);
   }
 }

  $('#min_harga').keyup(function(){
    if (this.value.length > 0) {
      $('#kelipatan').prop('readonly', false);
    }else {
      $('#kelipatan').prop('readonly', true);
    }
  });

  $('[type=number]').on('mousewheel keyup change',function(){
    if (parseInt(this.value) < 1) {
       this.value = this.value.substr(0, this.value.length - 1);
    }
  });

  $('#kelipatan').on('mousewheel keyup change',function(){
    if (parseInt(this.value) > parseInt($('#min_harga').val())) {
       this.value = this.value.substr(0, this.value.length - 1);
    }
  });

  $('#kode').keyup(function(){
     this.value = alphanumeric(this.value).toUpperCase();
  });

  function alphanumeric(inputtxt) {
    var letterNumber = /^[0-9a-zA-Z]+$/;
    if((inputtxt.match(letterNumber))) {
      return inputtxt;
    }else {
      return inputtxt.substr(0, inputtxt.length - 1);
    }
  }

  $('#tambah_promo').click(function() {
    var max = $('#kode').val().length;
    // var form = $('#form_promo').parsley();
    var form = $('#form_promo').parsley({
      errorsContainer: function (Field) {
        if (Field.$element.siblings('.input-group-addon').length != 0) {
          return Field.$element.closest('.input-group').parent();
        }
      },
    });
    form.validate();
    if (form.isValid() == true) {
      if (max > 4 && max < 10) {
        if (cekKode($('#kode').val())) {
          simpan_promo();
        }
      }else {
        alert('Kode harus berisikan minmal 5 karakter, dan harus terdapat huruf didalam nya ? ');
        $("#kode").focus();
      }
    }
  });

  function cekKode(inputtxt) {
    var letterNumber = /^[0-9a-zA-Z]+$/;
    if((inputtxt.match(letterNumber))) {
      var letterText = /^[a-zA-Z]+$/;
      if ((inputtxt*2) > 0) {
        alert('Kode promo harus terdapat huruf didalamnya');
        $("#kode").focus();
      }else {
        return true;
      }
    }else {
      alert('Kode promo hanya boleh berisikan Huruf dan Angka');
      $("#kode").focus();
      return false;
    }
  }

  function simpan_promo() {
    if (array_simpan.jenis_promo == 2) {
      array_simpan.persen = null;
    }else {
      array_simpan.persen = $('#persen').val();
    }
    array_simpan.nominal_promo  = $('#nominal').val();
    array_simpan.minimal_qty    = $('#min_qty').val();
    array_simpan.minimal_harga  = $('#min_harga').val();
    array_simpan.kelipatan      = $('#kelipatan').val();
    array_simpan.kuota          = $('#kuota').val();
    array_simpan.kuota_harian   = $('#kuota_harian').val();
    array_simpan.kota_id        = $('#kota').val();
    array_simpan.kode_promo           = $('#kode').val();
    array_simpan.jenis_pembayaran_id  = $('#select_to_pembayaran').val();;

    var produk = $('#select_to').val();
    $.ajax({
      url   : '<?php echo base_url('list_promo/get_data_by');?>',
      data  : {
        id : array_simpan.kode_promo
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        if (r == null) {
          if (array_simpan.is_all == 1) {
            fun_simpan(true);
          }else {
            for (var i = 0; i < produk.length; i++) {
              array_simpan.produk_id = produk[i];
              fun_simpan(i == (produk.length-1));
            }
          }
        }else {
          alert('Kode promo sudah digunakan, harap di ganti ? ');
        }
      }
    });
  }

  function fun_simpan(is_back) {
    $.ajax({
      url   : '<?php echo base_url('list_promo/simpan');?>',
      data  : array_simpan,
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        if (r.success) {
          if (is_back) {
            location.replace('<?php echo base_url('list_promo') ?>');
          }
        }
      }
    });
  }

  function set_on_off_promo_ongkir(v) {
    var value = (v.checked == true) ? '1' : '0';
    fungsi_set_promo_ongkir(value);
  }

  function fungsi_set_promo_ongkir(value) {
    $('[name=status_promo_ongkir]').val(value);
    if (value == 0) {
      array_simpan.is_gratis_ongkir = 2;
      $('#label_promo_ongkir').removeClass('label label-success').addClass('label label-default').html('Tidak');
      $('[name=nominal]').attr('readonly', false);
    }else {
      array_simpan.is_gratis_ongkir = 1;
      $('#label_promo_ongkir').removeClass('label label-default').addClass('label label-success').html('Iya');
      $('[name=nominal]').val(0);
      $('[name=nominal]').attr('readonly', true);
    }
  }
</script>
