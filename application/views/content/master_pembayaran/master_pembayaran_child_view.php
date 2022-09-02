<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/jquery.fileupload.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/upload_image.js"></script>

<style>
div#table_user_length {
  width: 30%;
  position: absolute;
  left: 8%;
}
.form-horizontal .control-label {
  text-align: left;
}
</style>

<div class="panel panel-default" style="border:0" id="panel_pembayaran_child">
  <div class="panel-heading text-center">
    <h3 style="margin:0;"><?php echo strtoupper($parent[0]->master_pembayaran) ?></h3>
  </div>
  <div class="panel-body">

    <div class="box-body" data-id="div_form_input" hidden>
      <div class="row">
        <form id="form_pembayaran_child">
          <div class="form-group col-md-12">
            <div class="col-md-6 mb-3">
              <label>Nama Pembayaran : </label>
              <input type="text" class="form-control" id="pembayaran_child" name="pembayaran_child" autocomplete="on" required>
              <input type="hidden" id="id_pembayaran_child" name="id_pembayaran_child">
              <input name="file_upload_name" id="file_upload_name" type="hidden">
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-6 mb-3">
              <label>Keterangan : </label>
              <textarea type="text" class="form-control" id="keterangan_child" name="keterangan_child" required></textarea>
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
                                <input id="nama_file" type="text" name="nama_file" class="form-control">
                              </div>
                              <div hidden>
                                  <input id="fileupload" type="file" name="files" data-url="<?php echo base_url('master_pembayaran/upload_image')?>" >
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
                    <input type="checkbox" onclick="set_on_off_child(this)" id="toggle_status_child" checked>
                    <span class="slider round"></span>
                  </label>
                </td>
                <td class="text-left" style="text-align: left;vertical-align: center;">
                  <label id="label_status_child" class="label label-success">
                    <span>Aktif<span>
                    </label>
                  </td>
                  <input type="text" name="status_child" id="status_child" value="1" hidden required>
                </table>
            </div>
          </div>
          <div class="form-group col-md-12" id="div_no_rek" hidden>
            <div class="col-md-6 mb-3">
              <label>No Rekening : </label>
              <input type="text" class="form-control" id="no_rek" name="no_rek" autocomplete="on">
            </div>
          </div>
          <div class="form-group col-md-12" id="div_atas_nama" hidden>
            <div class="col-md-6 mb-3">
              <label>Atas Nama : </label>
              <input type="text" class="form-control" id="atas_nama" name="atas_nama" autocomplete="on">
            </div>
          </div>
          <!-- <div class="col-sm-12 text-left" style="margin-top:10px;">
            <div class="col-md-6 mb-3">
              <button type="button" id="tambah_pembayaran_child" class="btn btn-success" name="button">Tambah</button>
            </div>
          </div> -->
        </form>
      </div>
    </div>

    <div id="div_table_output">
      <div class="text-left" style="margin-bottom:10px;">
        <button type="button" onclick="kembali()" class="btn btn-primary" style="margin-right:10px;">Kembali</button>
        <button type="button" id="tambah_child" class="btn btn-success">Tambah Data</button>
      </div>
      <div class="pull-right" style="margin-bottom:5px;">
        <div class="input-group input-group-sm" style="width: 300px;">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker_child" value="<?php echo date('d/m/Y')?>" readonly>
          </div>
        </div>
      </div>

      <table id="table_master_pembayaran_child" class="table table-bordered table-striped ">
        <thead>
          <tr>
            <th style="width:5%">No</th>
            <th>Pembayaran</th>
            <th>Status</th>
            <!-- <th>Dibuat Oleh</th> -->
            <th>Tanggal</th>
            <th>#</th>
          </tr>
        </thead>
      </table>
    </div>

  </div>

  <div class="panel-footer text-left" data-id="div_form_input" hidden style="padding-left:30px;">
    <button type="button" id="tambah_pembayaran_child" class="btn btn-success" style="margin-right:10px;">Tambah</button>
    <button type="button" class="btn btn-primary" onclick="kembali_input()">Kembali</button>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    get_data_pembayaran_child('');
    $('#keterangan_child').wysihtml5();
  });

 function set_on_off_child(v) {
   var value = (v.checked == true) ? '1' : '0';
   fungsi_set_status_child(value);
 }

 function fungsi_set_status_child(value) {
   $('[name=status_child]').val(value);
   if (value == 0) {
     $('#label_status_child').removeClass('label label-success').addClass('label label-default').html('Tidak Aktif');
   }else {
     $('#label_status_child').removeClass('label label-default').addClass('label label-success').html('Aktif');
   }
 }

  $('#datepicker_child').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  });

  $('#datepicker_child').change(function () {
    $('#table_master_pembayaran_child').DataTable().destroy();
    get_data_pembayaran_child($(this).val());
  });

 function get_data_pembayaran_child(tgl){
   if(tgl == ''){
     tgl = '00/00/0000 - 31/12/9999';
   }

   var table_master_pembayaran_child = $('#table_master_pembayaran_child').DataTable({
     dom: 'Blfrtip',
     buttons: [
         'excel', 'csv'
     ],
     "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
     "pageLength": 20,
     "processing": true,
     "serverSide": true,
     ajax : {
       url  : '<?php echo base_url('Master_pembayaran/get_data_pembayaran_child');?>',
       type : 'POST',
       data : {
         id  : <?php echo $parent[0]->master_pembayaran_id ?>,
         tgl : tgl
       },
       beforeSend:function() {
         $('#table_master_pembayaran_child').LoadingOverlay("show");
       },
       complete:function() {
         $("#table_master_pembayaran_child").LoadingOverlay("hide", true);
       },
     },
     columns: [
       { data: 'no' },
       { data: 'jenis_pembayaran' },
       { data: 'status' },
       // { data: 'created_by' },
       { data: 'created_on' },
       { data: 'aksi' },
     ],
   });
 }

 function hide_show_div(key) {
   $('#div_no_rek').hide();
   $('#div_atas_nama').hide();
   if (key == 1) {
     $('#div_table_output').hide(250);
     $('[data-id="div_form_input"]').show(250);
   }else {
     $('[data-id="div_form_input"]').hide(250);
     $('#div_table_output').show(250);
   }

   if ('<?php echo $parent[0]->master_pembayaran_id ?>' == '1') {
     $('#div_no_rek').show();
     $('#div_atas_nama').show();
   }
 }

 $('#tambah_child').click(function() {
   hide_show_div(1);
 });

 function kembali_input() {
   bersihkan();
   hide_show_div(2);
 }

 $('#tambah_pembayaran_child').click(function() {
   // console.log($('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html());
   if ($('#pembayaran_child').val() == '') {
   }else {
     simpan_pembayaran_child();
   }
 });

 function simpan_pembayaran_child() {
   $.ajax({
     url   : '<?php echo base_url('Master_pembayaran/simpan_child');?>',
     data  : {
       'id_master'       : '<?php echo $parent[0]->master_pembayaran_id ?>',
       'id_pembayaran'   : $('#id_pembayaran_child').val(),
       'pembayaran'      : $('#pembayaran_child').val(),
       'keterangan_child': $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(),
       'status'          : $('#status_child').val(),
       'gambar'          : $('[name=file_upload_name]').val(),
       'no_rek'          : $('[name=no_rek]').val(),
       'atas_nama'       : $('[name=atas_nama]').val(),
     },
     type  : 'POST',
     dataType : 'jSON',
     beforeSend:function() {
       hide_show_div(2);
       $('#table_master_pembayaran_child').LoadingOverlay("show");
     },
     complete:function() {
       $("#table_master_pembayaran_child").LoadingOverlay("hide", true);
     },
     success : function (r) {
       if (r.success) {
         $('#table_master_pembayaran_child').DataTable().ajax.reload( null, false );
         bersihkan();
       }
     }
   });
 }

 function edit_data_child(id) {
   var url = '<?php echo URL_UPLOAD.'/admin/' ?>';
   $.ajax({
     url   : '<?php echo base_url('Master_pembayaran/get_data_by_child');?>',
     data  : {
       'id' : id,
     },
     type  : 'POST',
     dataType : 'jSON',
     success : function (r) {
       hide_show_div(1);
       $('[name=id_pembayaran_child]').val(r.jenis_pembayaran_id);
       $('[name=pembayaran_child]').val(r.jenis_pembayaran);
       $('[name=nama_file]').val(r.jenis_pembayaran);
       $('[name=file_upload_name]').val(r.gambar);
       $('[name=no_rek]').val(r.no_rekening);
       $('[name=atas_nama]').val(r.atas_nama);
       $('#preview').empty();
       $('#preview').append('<img src="'+url+r.gambar+'" class="img-responsive">');
       $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(r.info_pembayaran);
       $('[name=keterangan_child]').html(r.info_pembayaran);
       $('#tambah_pembayaran_child').html('Ubah');
       if (r.status == 1) {
         $("#toggle_status_child").prop("checked", true);
       }else {
         $("#toggle_status_child").prop("checked", false);
       };
       fungsi_set_status_child(r.status);
     }
   });
 }

 function delete_pembayaran_child(id) {
   var msg = confirm('Apakah anda yakin ? ');
   if (msg) {
     $.ajax({
       url   : '<?php echo base_url('Master_pembayaran/delete_child');?>',
       data  : {
         'id' : id,
       },
       type  : 'POST',
       dataType : 'jSON',
       beforeSend:function() {
         $('#table_master_pembayaran_child').LoadingOverlay("show");
       },
       complete:function() {
         $("#table_master_pembayaran_child").LoadingOverlay("hide", true);
       },
       success : function (r) {
         if (r.success) {
           $('#table_master_pembayaran_child').DataTable().ajax.reload( null, false );
         }
       }
     });
   }
 }

 function kembali() {
   window.location.href = '<?php echo base_url('Master_pembayaran');?>';
 }

 function bersihkan() {
   $('#form_pembayaran_child').find('input', 'textarea').each(function() {
     $(this).val($(this).data('default'));
     $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html('');
     $('#preview').empty();
     $('#tambah_pembayaran_child').html('Tambah');
     $("#toggle_status_child").prop("checked", true);
     fungsi_set_status_child(1);
   });
 }

</script>
