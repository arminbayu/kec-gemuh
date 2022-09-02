<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
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
</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" id="title_top">
              <h3 class="box-title">Kategori</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12" id="div_form_input" hidden>
                <div class="row">
                  <form id="form_kategori">
                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Nama kategori : </label>
                          <input type="text" class="form-control" id="kategori" name="kategori" autocomplete="on" required>
                          <input type="hidden" id="id_kategori" name="id_kategori">
                          <input name="file_upload_name" id="file_upload_name" type="hidden">
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="col-md-2 mb-3">
                          <label>Status : </label>
                          <table>
                            <td class="text-center">
                              <label class="switch" style="margin-right:10px;">
                                <input type="checkbox" onclick="set_on_off(this, 0)" id="toggle_status" checked>
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

                        <div class="col-md-2 mb-3">
                          <label>Is Parent : </label>
                          <table>
                            <td class="text-center">
                              <label class="switch" style="margin-right:10px;">
                                <input type="checkbox" onclick="set_on_off(this, 1)" id="toggle_is_parent" checked>
                                <span class="slider round"></span>
                              </label>
                            </td>
                            <td class="text-left" style="text-align: left;vertical-align: center;">
                              <label id="label_is_parent" class="label label-success">
                                <span>Parent<span>
                                </label>
                              </td>
                              <input type="text" name="is_parent" id="is_parent" value="1" hidden required>
                            </table>
                        </div>
                      </div>

                      <div class="form-group col-md-12" id="div_status_parent" style="display:none">
                        <div class="col-md-6 mb-3">
                          <label>Parent : </label>
                            <select id="kategori_parent" name="kategori_parent" class="form-control">
                              <option value="">Pilih</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Keterangan : </label>
                          <Textarea type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="on" required></Textarea>
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
                                          <input id="nama_file" type="text" name="nama_file" class="form-control" value="">
                                        </div>
                                        <div hidden>
                                            <input id="fileupload" type="file" name="files" data-url="<?php echo base_url('kategori/upload_image')?>" >
                                        </div>
                                      </form>
                                      <a href="javascript:void(0);" class="btn btn-default btn-xs pull-right btn_upload" style="margin-bottom:2px;"><i class="fa fa-cloud-upload"></i></a>
                                    </span>
                                </div>
                              </li>
                            </ul>
                        </div>
                      </div>

                      <div class="col-sm-12" style="margin-top:10px;">
                        <button type="button" id="tambah_kategori" class="btn btn-success" name="button">Tambah</button>
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

                <table id="table_kategori" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th>Kategori</th>
                      <th>Status</th>
                      <th>Is Parent</th>
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

  $(document).ready(function() {
    get_data_kategori('');
    _kategoriParent('');
  });

  function _kategoriParent(isEdit) {
    $.ajax({
      url   : '<?php echo base_url('kategori/get_parent_kategori');?>',
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        var kategori_parent = $('#kategori_parent');
        kategori_parent.empty();
        for (var i = 0; i < r.length; i++) {
          if (r[i].kategori_id == isEdit) {
            kategori_parent.append('<option value="' + r[i].kategori_id + '" selected>' + r[i].kategori_name + '</option>');
          } else {
            kategori_parent.append('<option value="' + r[i].kategori_id + '">' + r[i].kategori_name + '</option>');
          }
        }
      }
    });
  }

 function set_on_off(v, type) {
   var value = (v.checked == true) ? '1' : '0';
   fungsi_set_status(value, type)
 }

  function fungsi_set_status(value, type) {
    if (type == '1') {
      $('#div_status_parent').css('display','block');
      changeStatus(value, 'is_parent', 'label_is_parent', 'Parent', 'Child');
    }else {
      changeStatus(value, 'status', 'label_status', 'Aktif', 'Tidak Aktif');
    }
  }

 function changeStatus(value, status, lStatus, htmlSuccess, htmlDefault) {
   $('[name='+status+']').val(value);
   if (value == 0) {
     $('#'+lStatus+'').removeClass('label label-success').addClass('label label-default').html(htmlDefault);
   }else {
     $('#'+lStatus+'').removeClass('label label-default').addClass('label label-success').html(htmlSuccess);
     $('#div_status_parent').css('display','none');
   }
 }

  function get_data_kategori(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_kategori = $('#table_kategori').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('kategori/get_data_kategori');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_kategori').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_kategori").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'kategori_name' },
        { data: 'status' },
        { data: 'is_parent' },
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
    $('#table_kategori').DataTable().destroy();
    get_data_kategori($(this).val());
  });

  $('#tambah_kategori').click(function() {
    if ($('#kategori').val() == '') {

    }else {
      simpan_kategori();
    }
  });

  function simpan_kategori() {
    var is_parent = '';
    if ($('#is_parent').val() == '0') {
      is_parent = $('#kategori_parent').val();
    }else {
      is_parent = '0';
    }

    $.ajax({
      url   : '<?php echo base_url('kategori/simpan');?>',
      data  : {
        'id_kategori'   : $('#id_kategori').val(),
        'kategori'      : $('#kategori').val(),
        'keterangan'    : $('#keterangan').html(),
        'status'        : $('#status').val(),
        'parent'        : is_parent,
        'gambar'        : $('[name=file_upload_name]').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        hide_show_div(2);
        $('#table_kategori').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_kategori").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_kategori').DataTable().ajax.reload( null, false );
          bersihkan();
        }
      }
    });
  }

  function edit_data(id) {
    var url = '<?php echo URL_UPLOAD.'/kategori/thumb_' ?>';
    $.ajax({
      url   : '<?php echo base_url('kategori/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        hide_show_div(1);
        $('[name=id_kategori]').val(r.kategori_id);
        $('[name=kategori]').val(r.kategori_name);
        $('[name=keterangan]').html(r.keterangan);
        $('[name=file_upload_name]').val(r.gambar);
        $('#preview').empty();
        $('#preview').append('<img src="'+url+r.gambar+'" class="img-responsive">');
        $('#tambah_kategori').html('Ubah');
        if (r.status == 1) {
          $("#toggle_status").prop("checked", true);
        }else {
          $("#toggle_status").prop("checked", false);
        };
        fungsi_set_status(r.status, '0');
        if (r.parent != '0') {
          fungsi_set_status('0', '1');
          _kategoriParent(r.parent);
          $("#toggle_is_parent").prop("checked", false);
        }else {
          fungsi_set_status('1', '1');
          $("#toggle_is_parent").prop("checked", true);
        }
      }
    });
  }

  function delete_kategori(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('kategori/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_kategori').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_kategori").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_kategori').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function bersihkan() {
    $('#form_kategori').find('input').each(function() {
      $(this).val($(this).data('default'));
      $('#tambah_kategori').html('Tambah');
      $("#toggle_status").prop("checked", true);
      $("#toggle_is_parent").prop("checked", true);
      fungsi_set_status('1', '0');
      fungsi_set_status('1', '1');
    });
  }
</script>
