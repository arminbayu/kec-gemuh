<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/jquery.fileupload.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/upload_image.js"></script>
<style>
div#table_user_length {
  width: 30%;
  position: absolute;
  left: 8%;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: middle;
}

.center-img {
  text-align: -webkit-center;
}
</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Promo</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12" id="div_form_input" hidden>
                <div class="row">
                  <form id="form_promo">

                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Judul : </label>
                          <input type="text" class="form-control" id="judul" name="judul" autocomplete="on" required>
                          <input type="hidden" id="id_promo" name="id_promo">
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Link : </label>
                          <input type="text" class="form-control" id="link" name="link" autocomplete="on" placeholder="https://opeo.id" required>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Promo Expired  : </label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="expired" name="expired" required>
                          </div>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="col-md-2 mb-3">
                          <label>Gambar :</label>
                            <div class="mailbox-attachments clearfix">
                              <div style="float: left;width: 100%; border: 1px solid #eee; margin-bottom: 0; margin-right: 0;">
                                <div class="mailbox-attachment-icon has-img" id="preview"></div>
                                <div class="mailbox-attachment-info">
                                  <div id="progress" class="progress" hidden>
                                    <div class="progress-bar progress-bar-success"></div>
                                  </div>
                                  <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <span id="name_file" >Nama File</span> </a>
                                    <span class="mailbox-attachment-size">
                                      <span id="mail_attachment_size">Ukuran gambar</span>
                                      <form>
                                        <div class="form-group">
                                          <label>Alt Image</label>
                                          <input id="nama_file" type="text" name="nama_file" class="form-control" value="promo">
                                        </div>
                                        <div hidden>
                                            <input id="fileupload" type="file" name="files" data-url="<?php echo base_url('promo/upload_image')?>" >
                                        </div>
                                      </form>
                                      <a href="javascript:void(0);" class="btn btn-default btn-xs pull-right btn_upload" style="margin-bottom:2px;"><i class="fa fa-cloud-upload"></i></a>
                                    </span>
                                </div>
                              </div>
                              <input name="file_upload_name" id="file_upload_name" value="" required hidden>
                            </div>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
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
                        <button type="button" id="tambah_promo" class="btn btn-success" name="button">Tambah</button>
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
                      <input type="text" class="form-control pull-right" id="datepickerRange" value="<?php echo date('d/m/Y')?>" readonly>
                    </div>
                  </div>
                </div>

                <table id="table_promo" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th style="width:5%" class="text-center">No</th>
                      <th style="width:75px" class="text-center">Gambar</th>
                      <th style="width:200px" class="text-center">Judul</th>
                      <th style="width:50px" class="text-center">Link</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Expired</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">#</th>
                    </tr>
                  </thead>
                </table>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    <div>
</div>
</section>

<script type="text/javascript">

  function hide_show_div(key) {
    if (key == 1) {
      $('#div_table_output').hide(250);
      $('#div_form_input').show(250);
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

  $(document).ready(function() {
    get_data_promo('');
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

  function get_data_promo(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_promo = $('#table_promo').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('promo/get_data_promo');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_promo').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_promo").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'img', orderable : false, className : 'center-img'  },
        { data: 'judul', orderable : false },
        { data: 'url', orderable : false, className : 'center-img'  },
        { data: 'status', orderable : false, className : 'center-img'  },
        { data: 'kadaluarsa', orderable : false, className : 'center-img'  },
        { data: 'created_on', orderable : false },
        { data: 'aksi', orderable : false },
      ],
    });
  }

  $('#datepickerRange').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  });

  $('#expired').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });

  $('#datepickerRange').change(function () {
    $('#table_promo').DataTable().destroy();
    get_data_promo($(this).val());
  });

  $('#tambah_promo').click(function() {
    if ($('#promo').val() == '') {

    }else {
      simpan_promo();
    }
  });

  function simpan_promo() {
    var form = $('#form_promo').parsley({
      errorsContainer: function (Field) {
        return Field.$element.closest('.input-group').parent();
      },
    });

    if (form.validate()) {
      $.ajax({
        url   : '<?php echo base_url('promo/simpan');?>',
        data  : {
          'id_promo'   : $('[name=id_promo]').val(),
          'judul'      : $('[name=judul]').val(),
          'gambar'     : $('[name=file_upload_name]').val(),
          'link'       : $('[name=link]').val(),
          'expired'    : $('[name=expired]').val(),
          'is_active'  : $('[name=status]').val(),
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          hide_show_div(2);
          $('#table_promo').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_promo").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_promo').DataTable().ajax.reload( null, false );
            bersihkan();
          }
        }
      });
    }
  }

  function edit_data(id) {
    var url = '<?php echo URL_UPLOAD.'/promo/' ?>';
    $.ajax({
      url   : '<?php echo base_url('promo/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        hide_show_div(1);
        $('[name=id_promo]').val(r.promo_id);
        $('[name=judul]').val(r.judul);
        $('[name=file_upload_name]').val(r.gambar);
        $('[name=expired]').val(r.expired);
        $('[name=link]').val(r.link);
        $('#preview').empty();
        $('#preview').append('<img src="'+url+r.gambar+'" class="img-responsive">');
        $('#tambah_promo').html('Ubah');
        if (r.is_active == 1) {
          $("#toggle_status").prop("checked", true);
        }else {
          $("#toggle_status").prop("checked", false);
        };
        fungsi_set_status(r.is_active);
      }
    });
  }

  function delete_promo(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('promo/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_promo').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_promo").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_promo').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function bersihkan() {
    $('#form_promo').parsley().destroy();
    $('#form_promo').find('input', 'textarea').each(function() {
      $(this).val($(this).data('default'));
      $('#preview').empty();
      $('#tambah_promo').html('Tambah');
      $("#toggle_status").prop("checked", true);
      fungsi_set_status(1);
    });
  }
</script>
