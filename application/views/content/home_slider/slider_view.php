<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/jquery.fileupload.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/upload_image.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<style>
div#table_user_length {
  width: 30%;
  position: absolute;
  left: 8%;
}
iframe {
  height: 400px !important;
}
</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Home Slider</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12" id="div_form_input" hidden>
                <div class="row">
                  <form id="form_slider">
                    <!-- <div class="form-row"> -->
                      <!-- <div class="col-md-4 mb-3"> -->
                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Judul : </label>
                          <input type="text" class="form-control" id="judul" name="judul" autocomplete="on" required>
                          <input type="hidden" id="id_slider" name="id_slider">
                          <input name="file_upload_name" id="file_upload_name" type="hidden">
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Deskripsi : </label>
                          <textarea type="text" rows="10" class="form-control" id="deskripsi" name="deskripsi" autocomplete="on" required></textarea>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="col-md-2 mb-3">
                          <label>Gambar :</label>
                            <ul class="mailbox-attachments clearfix">
                              <li style="float: left;width: 100%; border: 1px solid #eee; margin-bottom: 0; margin-right: 0;">
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
                                          <input id="nama_file" type="text" name="nama_file" class="form-control" value="slider">
                                        </div>
                                        <div hidden>
                                            <input id="fileupload" type="file" name="files" data-url="<?php echo base_url('home_slider/upload_image')?>" >
                                        </div>
                                      </form>
                                      <a href="javascript:void(0);" class="btn btn-default btn-xs pull-right btn_upload" style="margin-bottom:2px;"><i class="fa fa-cloud-upload"></i></a>
                                    </span>
                                </div>
                              </li>
                            </ul>
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
                        <button type="button" id="tambah_slider" class="btn btn-success" name="button">Tambah</button>
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

                <table id="table_home_slider" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th>slider</th>
                      <th>Status</th>
                      <!-- <th>Dibuat Oleh</th> -->
                      <th>Tanggal</th>
                      <th>Tanggal</th>
                      <th style="width:100px;">#</th>
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
    get_data_slider('');
    $('#deskripsi').wysihtml5();
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

  function get_data_slider(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_home_slider = $('#table_home_slider').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('home_slider/get_data_slider');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_home_slider').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_home_slider").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'judul' },
        { data: 'deskripsi' },
        // { data: 'created_by' },
        { data: 'status' },
        { data: 'created_on' },
        { data: 'aksi' },
      ],
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
    $('#table_home_slider').DataTable().destroy();
    get_data_slider($(this).val());
  });

  $('#tambah_slider').click(function() {
    if ($('#slider').val() == '') {

    }else {
      simpan_slider();
    }
  });

  function simpan_slider() {
    $.ajax({
      url   : '<?php echo base_url('home_slider/simpan');?>',
      data  : {
        'id'        : $('#id_slider').val(),
        'judul'     : $('#judul').val(),
        'deskripsi' : $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(),
        'status'    : $('#status').val(),
        'gambar'    : $('[name=file_upload_name]').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        hide_show_div(2);
        $('#table_home_slider').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_home_slider").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_home_slider').DataTable().ajax.reload( null, false );
          bersihkan();
        }
      }
    });
  }

  function edit_data(id) {
    var url = '<?php echo URL_UPLOAD.'/slider/' ?>';
    $.ajax({
      url   : '<?php echo base_url('home_slider/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        hide_show_div(1);
        $('[name=id_slider]').val(r.app_slider_id);
        $('[name=judul]').val(r.judul);
        $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(r.deskripsi);
        $('[name=deskripsi]').val(r.deskripsi);
        $('[name=file_upload_name]').val(r.gambar);
        $('#preview').empty();
        $('#preview').append('<img src="'+url+'thumb_'+r.gambar+'" class="img-responsive">');
        $('#tambah_slider').html('Ubah');
        if (r.status == 1) {
          $("#toggle_status").prop("checked", true);
        }else {
          $("#toggle_status").prop("checked", false);
        };
        fungsi_set_status(r.status);
      }
    });
  }

  function delete_slider(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('home_slider/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_home_slider').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_home_slider").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_home_slider').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function bersihkan() {
    $('#form_slider').find('input', 'textarea').each(function() {
      $(this).val($(this).data('default'));
      $('#preview').empty();
      $('#tambah_slider').html('Tambah');
      $("#toggle_status").prop("checked", true);
      fungsi_set_status(1);
    });
  }
</script>
