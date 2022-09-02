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
            <div class="box-header">
              <h3 class="box-title">Master Pengiriman</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12" id="div_form_input" hidden>
                <div class="row">
                  <form id="form_pengiriman">
                    <!-- <div class="form-row"> -->
                      <!-- <div class="col-md-4 mb-3"> -->
                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Nama Pengiriman : </label>
                          <input type="text" class="form-control" id="pengiriman" name="pengiriman" autocomplete="on" required>
                          <input type="hidden" id="id_pengiriman" name="id_pengiriman">
                          <input name="file_upload_name" id="file_upload_name" type="hidden">
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
                        <button type="button" id="tambah_pengiriman" class="btn btn-success" name="button">Tambah</button>
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

                <table id="table_bantuan" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th>pengiriman</th>
                      <th>Status</th>
                      <!-- <th>Dibuat Oleh</th> -->
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
    get_data_pengiriman('');
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

  function get_data_bantuan(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_bantuan = $('#table_bantuan').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('bantuan/get_data_bantuan');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_bantuan').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_bantuan").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'judul' },
        { data: 'sub_judul' },
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
    $('#table_bantuan').DataTable().destroy();
    get_data_pengiriman($(this).val());
  });

  $('#tambah_pengiriman').click(function() {
    if ($('#pengiriman').val() == '') {

    }else {
      simpan_pengiriman();
    }
  });

  function simpan_pengiriman() {
    $.ajax({
      url   : '<?php echo base_url('bantuan/simpan');?>',
      data  : {
        'id_pengiriman'   : $('#id_pengiriman').val(),
        'pengiriman'      : $('#pengiriman').val(),
        'status'          : $('#status').val(),
        'gambar'          : $('[name=file_upload_name]').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        hide_show_div(2);
        $('#table_bantuan').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_bantuan").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_bantuan').DataTable().ajax.reload( null, false );
          bersihkan();
        }
      }
    });
  }

  function edit_data(id) {
    var url = '<?php echo URL_UPLOAD.'/admin/' ?>';
    $.ajax({
      url   : '<?php echo base_url('bantuan/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        hide_show_div(1);
        $('[name=id_pengiriman]').val(r.bantuan_id);
        $('[name=pengiriman]').val(r.bantuan);
        $('[name=file_upload_name]').val(r.gambar);
        $('#preview').empty();
        $('#preview').append('<img src="'+url+r.gambar+'" class="img-responsive">');
        $('#tambah_pengiriman').html('Ubah');
        if (r.status == 1) {
          $("#toggle_status").prop("checked", true);
        }else {
          $("#toggle_status").prop("checked", false);
        };
        fungsi_set_status(r.status);
      }
    });
  }

  function delete_pengiriman(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('bantuan/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_bantuan').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_bantuan").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_bantuan').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function bersihkan() {
    $('#form_pengiriman').find('input', 'textarea').each(function() {
      $(this).val($(this).data('default'));
      $('#preview').empty();
      $('#tambah_pengiriman').html('Tambah');
      $("#toggle_status").prop("checked", true);
      fungsi_set_status(1);
    });
  }
</script>
