<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<style>
div#table_user_length {
  width: 30%;
  position: absolute;
  left: 8%;
}
</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" id="title_top">
              <h3 class="box-title">Master Nama Produk</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12" id="div_form_input" hidden>
                <div class="row">
                  <form id="form_produk">

                    <div class="form-group col-md-12" style="padding:0">
                      <div class="col-md-5 mb-3">
                        <label>Parent : </label>
                          <select id="produk_parent" name="produk_parent" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-12" style="padding:0">
                      <div class="col-md-5 mb-3">
                        <label>Provinsi : </label>
                          <select id="provinsi" name="provinsi" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-12" id="div_kota" style="display:none;padding:0">
                      <div class="col-md-5 mb-3">
                        <label>Kota/Kabupaten : </label>
                          <select id="kota" name="kota" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>Nama Produk : </label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" autocomplete="on" required>
                        <input type="hidden" id="id_produk" name="id_produk">
                      </div>
                      <div class="col-md-4 mb-3">
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

                      <div class="col-sm-12" style="margin-top:10px;">
                        <button type="button" id="tambah_produk" class="btn btn-success" name="button">Tambah</button>
                        <button type="button" class="btn btn-primary" onclick="kembali_input()">Kembali</button>
                      </div>

                  </form>
                </div>
              </div>

              <div id="div_table_output">
                <div class="text-left" style="margin-bottom:10px;">
                  <button type="button" id="tambah_show" class="btn btn-success">Tambah Data</button>
                </div>

                <div class="pull-right" style="margin-bottom:5px;">
                  <div class="input-group input-group-sm" style="width: 300px;">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo date('d/m/Y')?>" readonly>
                    </div>
                  </div>
                </div>

                <table id="table_master_produk" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th>Kota/Kabupaten</th>
                      <th>Nama produk</th>
                      <th>Dibuat Oleh</th>
                      <th>Tanggal</th>
                      <th>#</th>
                    </tr>
                  </thead>
                </table>

              </div>

            </div>

          </div>
        </div>
      </div>
    <div>
</div>
</section>

<script type="text/javascript">

  function topFunction() {
    $('html, body').animate({
      scrollTop: $("#title_top").offset().top
    });
  }

  function hide_show_div(key) {
    if (key == 1) {
      $('#div_table_output').hide(250);
      $('#div_form_input').show(250);
      topFunction();
    }else {
      $('#div_form_input').hide(250);
      $('#div_table_output').show(250);
    }
  }

  $('#tambah_show').click(function() {
    hide_show_div(1);
  });

  function kembali_input() {
    bersihkan();
    hide_show_div(2);
  }

  function bersihkan() {
    $('#form_produk').find('input').each(function() {
      $(this).val($(this).data('default'));
      $('#tambah_produk').html('Tambah');
      $("#toggle_status").prop("checked", true);
      fungsi_set_status(1);
      $('#div_kota').css('display','none');
    });
  }

  $(document).ready(function() {
    get_data_produk('');
    _produkParent('');
    _getLokasi(null, '00', '#provinsi');
  });

 function set_on_off(v) {
   var value = (v.checked == true) ? '1' : '0';
   fungsi_set_status(value);
 }

 function fungsi_set_status(value) {
   $('[name=status]').val(value);
   if (value == 0) {
     $('#label_status').removeClass('label label-success').addClass('label label-default').html('Tidak Aktif');
   }else {
     $('#label_status').removeClass('label label-default').addClass('label label-success').html('Aktif');
   }
 }

  function get_data_produk(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_master_produk = $('#table_master_produk').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('master_produk/get_data_produk');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_master_produk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_master_produk").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'lokasi' },
        { data: 'master_nama_produk' },
        { data: 'status' },
        { data: 'created_on' },
        { data: 'aksi' },
      ],
    });
  }

  $('#provinsi').on('change', function() {
    $('#div_kota').css('display','block');
    _getLokasi($(this).val(), null, '#kota');
  });

  function _getLokasi(provinsi, kota, element) {
    $.ajax({
      url   : '<?php echo base_url('master_produk/get_lokasi');?>',
      data  : {
        'propinsi'  : provinsi,
        'element'   : element
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        if (element == '#provinsi') {
          $('#provinsi').LoadingOverlay("show");
        }else if (element == '#kota') {
          $('#kota').LoadingOverlay("show");
        }
      },
      complete:function() {
        if (element == '#provinsi') {
          $("#provinsi").LoadingOverlay("hide", true);
        }else if (element == '#kota') {
          $("#kota").LoadingOverlay("hide", true);
        }
      },
      success : function (r) {
        var elm = $(element);
        elm.empty();
        if (element == '#provinsi') {
          for (var i = 0; i < r.length; i++) {
            if (r[i].propinsi == provinsi) {
              elm.append('<option value="' + r[i].propinsi + '" selected>' + r[i].nama + '</option>');
            } else {
              elm.append('<option value="' + r[i].propinsi + '">' + r[i].nama + '</option>');
            }
          }
        }else if (element == '#kota') {
          for (var i = 0; i < r.length; i++) {
            if (r[i].kabkota == kota) {
              elm.append('<option value="' + r[i].kabkota + '" selected>' + r[i].nama + '</option>');
            } else {
              elm.append('<option value="' + r[i].kabkota + '">' + r[i].nama + '</option>');
            }
          }
        }else {
          for (var i = 0; i < r.length; i++) {
            elm.append('<option value="' + r[i].propinsi + '">' + r[i].nama + '</option>');
          }
        }
      }
    });
  }

  function _produkParent(isEdit) {
    $.ajax({
      url   : '<?php echo base_url('master_produk/get_parent');?>',
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        var produk_parent = $('#produk_parent');
        produk_parent.empty();
        for (var i = 0; i < r.length; i++) {
          if (r[i].kategori_id == isEdit) {
            produk_parent.append('<option value="' + r[i].kategori_id + '" selected>' + r[i].kategori_name + '</option>');
          } else {
            produk_parent.append('<option value="' + r[i].kategori_id + '">' + r[i].kategori_name + '</option>');
          }
        }
      }
    });
  }

  $('#datepicker').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  });

  $('#datepicker').change(function () {
    $('#table_master_produk').DataTable().destroy();
    get_data_produk($(this).val());
  });

  $('#tambah_produk').click(function() {
    if ($('#nama_produk').val() == '') {

    }else {
      simpan_produk();
    }
  });

  function simpan_produk() {
    $.ajax({
      url   : '<?php echo base_url('master_produk/simpan');?>',
      data  : {
        'id_produk'     : $('#id_produk').val(),
        'nama_produk'   : $('#nama_produk').val(),
        'produk_parent' : $('#produk_parent').val(),
        'provinsi'      : $('#provinsi').val(),
        'kota'          : $('#kota').val(),
        'status'        : $('#status').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        hide_show_div(2);
        $('#table_master_produk').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_master_produk").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_master_produk').DataTable().ajax.reload( null, false );
          bersihkan();
        }
      }
    });
  }

  function edit_data(id) {
    $.ajax({
      url   : '<?php echo base_url('master_produk/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        hide_show_div(1);
        $('[name=id_produk]').val(r.master_nama_produk_id);
        $('[name=nama_produk]').val(r.master_nama_produk);
        $('#tambah_produk').html('Ubah');
        if (r.status == 1) {
          $("#toggle_status").prop("checked", true);
        }else {
          $("#toggle_status").prop("checked", false);
        };
        _produkParent(r.kategori_id);
        fungsi_set_status(r.status);
        $('#div_kota').css('display','block');
        _getLokasi(r.provinsi_id, null, '#provinsi');
        _getLokasi(r.provinsi_id, r.kota_id, '#kota');
      }
    });
  }

  function delete_produk(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('master_produk/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_master_produk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_master_produk").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_master_produk').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }
</script>
