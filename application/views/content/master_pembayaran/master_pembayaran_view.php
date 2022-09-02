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
            <div class="box-header">
              <h3 class="box-title">Master Pembayaran</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12 well">
                <div class="row">
                  <form id="form_pembayaran">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>Nama Pembayaran : </label>
                        <input type="text" class="form-control" id="pembayaran" name="pembayaran" autocomplete="on" required>
                        <input type="hidden" id="id_pembayaran" name="id_pembayaran">
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
                        <button type="button" id="tambah_pembayaran" class="btn btn-success" name="button">Tambah</button>
                      </div>
                  </form>
                </div>
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

              <table id="table_master_pembayaran" class="table table-bordered table-striped ">
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
          </div>
        </div>
      </div>
    <div>
</div>
</section>

<script type="text/javascript">

  $(document).ready(function() {
    get_data_pembayaran('');
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

  function get_data_pembayaran(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_master_pembayaran = $('#table_master_pembayaran').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('Master_pembayaran/get_data_pembayaran');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_master_pembayaran').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_master_pembayaran").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'master_pembayaran' },
        { data: 'status' },
        // { data: 'created_by' },
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
    $('#table_master_pembayaran').DataTable().destroy();
    get_data_pembayaran($(this).val());
  });

  $('#tambah_pembayaran').click(function() {
    if ($('#pembayaran').val() == '') {

    }else {
      simpan_pembayaran();
    }
  });

  function simpan_pembayaran() {
    $.ajax({
      url   : '<?php echo base_url('Master_pembayaran/simpan');?>',
      data  : {
        'id_pembayaran'   : $('#id_pembayaran').val(),
        'pembayaran'      : $('#pembayaran').val(),
        'status'          : $('#status').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_master_pembayaran').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_master_pembayaran").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_master_pembayaran').DataTable().ajax.reload( null, false );
          $('#form_pembayaran').find('input').each(function() {
            $(this).val($(this).data('default'));
            $('#tambah_pembayaran').html('Tambah');
            $("#toggle_status").prop("checked", true);
            fungsi_set_status(1);
          });
        }
      }
    });
  }

  function edit_data(id) {
    $.ajax({
      url   : '<?php echo base_url('Master_pembayaran/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        $('[name=id_pembayaran]').val(r.master_pembayaran_id);
        $('[name=pembayaran]').val(r.master_pembayaran);
        $('#tambah_pembayaran').html('Ubah');
        if (r.status == 1) {
          $("#toggle_status").prop("checked", true);
        }else {
          $("#toggle_status").prop("checked", false);
        };
        fungsi_set_status(r.status);
      }
    });
  }

  function delete_pembayaran(id) {
    var msg = confirm('Apakah kamu yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('Master_pembayaran/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_master_pembayaran').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_master_pembayaran").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_master_pembayaran').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function force_not_active(master_pembayaran_id, force_not_active) {
    var msg = confirm('Apakah kamu yakin, akan menskip fungsi yang ada di cron ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('Master_pembayaran/force_not_active');?>',
        data  : {
          'master_pembayaran_id' : master_pembayaran_id,
          'force_not_active'     : force_not_active,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_master_pembayaran').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_master_pembayaran").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_master_pembayaran').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function modal_pembayaran(id) {
    window.location.href = '<?php echo base_url('Master_pembayaran/pembayaran_child/');?>'+id;
  }
</script>
