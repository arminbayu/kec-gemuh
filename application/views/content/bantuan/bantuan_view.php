<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<style>
div#table_user_length {
  width: 30%;
  position: absolute;
  left: 8%;
}
iframe {
  height: 500px !important;
}
</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bantuan</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12" id="div_form_input" hidden>
                <div class="row">
                  <form id="form_bantuan">

                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Judul : </label>
                          <input type="text" class="form-control" id="judul" name="judul" required>
                          <input type="hidden" id="bantuan_id" name="bantuan_id">
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="col-md-6 mb-3">
                          <label>Sub Judul : </label>
                          <input type="text" class="form-control" id="sub_judul" name="sub_judul" required>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="col-md-12 mb-3">
                          <label>Isi : </label>
                          <textarea type="text" class="form-control" id="isi" name="isi" required></textarea>
                        </div>
                      </div>

                      <div class="col-sm-12" style="margin-top:10px;">
                        <button type="button" id="tambah_bantuan" class="btn btn-success" name="button">Tambah</button>
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
                      <th>bantuan</th>
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
    get_data_bantuan('');
    $('#isi').wysihtml5();
  });

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
    get_data_bantuan($(this).val());
  });

  $('#tambah_bantuan').click(function() {
    if ($('#judul').val() == '') {

    }else {
      simpan_bantuan();
    }
  });

  function simpan_bantuan() {
    $.ajax({
      url   : '<?php echo base_url('bantuan/simpan');?>',
      data  : {
        'bantuan_id': $('#bantuan_id').val(),
        'judul'     : $('#judul').val(),
        'sub_judul' : $('#sub_judul').val(),
        'isi'       : $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(),
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
        $('[name=bantuan_id]').val(r.bantuan_id);
        $('[name=judul]').val(r.judul);
        $('[name=sub_judul]').val(r.sub_judul);
        $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(r.isi);
        $('[name=isi]').html(r.isi);
        $('#tambah_bantuan').html('Ubah');
      }
    });
  }

  function delete_bantuan(id) {
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
    $('#form_bantuan').find('input', 'textarea').each(function() {
      $(this).val($(this).data('default'));
      $('#tambah_bantuan').html('Tambah');
      $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html('');
    });
  }
</script>
