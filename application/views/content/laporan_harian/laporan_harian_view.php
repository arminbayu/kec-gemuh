<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<style>
div#table_laporan_harian_length {
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
              <h3 class="box-title">Laporan User</h3>

              <div class="col-sm-12 well" style="margin-top:10px;">
                <div class="row">
                  <form id="form_laporan_haria">
                    <div class="col-md-4 mb-3">
                      <label>App Install : <span name="span_tanggal"></span></label>
                      <input type="text" class="form-control" id="app_install" name="app_install" autocomplete="on" is_disabled="edit" disabled>
                      <input id="id_laporan" name="id_laporan" hidden>
                    </div>
                    <div class="col-md-4 mb-3" style="padding:0">
                      <label style="color: #f5f5f5;">.</label>
                      <div class="col-sm-12">
                        <button type="button" onclick="ubah_laporan()" class="btn btn-success" name="button" is_disabled="edit" disabled>Ubah</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="box-body">

              <div class="pull-left" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      Total Install
                    </div>
                    <input class="form-control" name="install" value="0" style="width:75px" readonly></input>
                  </div>
                </div>
              </div>

              <div class="pull-left" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      Total User
                    </div>
                    <input class="form-control" name="user" value="0" style="width:75px" readonly></input>
                  </div>
                </div>
              </div>

              <div class="pull-left" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      Total Produk
                    </div>
                    <input class="form-control" name="produk" value="0" style="width:75px" readonly></input>
                  </div>
                </div>
              </div>

              <div class="text-right" style="margin-bottom:10px;">
                <button type="button" onclick="sync_data(3)" class="btn btn-success" is_disabled="sync" >Sync Last 3 Day</button>
                <button type="button" onclick="sync_data(7)" class="btn btn-info" is_disabled="sync" >Sync Last 7 Day</button>
                <button type="button" onclick="sync_data(30)" class="btn btn-primary" is_disabled="sync" >Sync Last 30 Days</button>

                <div class="pull-right" style="margin-bottom:5px;margin-left:10px;">
                  <div class="input-group input-group-sm" style="width: 300px;">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo date('d/m/Y')?>" readonly>
                    </div>
                  </div>
                </div>
              </div>

              <table id="table_laporan_harian" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Tanggal</th>
                    <th>App Install</th>
                    <th style="width:15%">User Baru</th>
                    <th>Produk Baru</th>
                    <th>#</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    <div>
</div>
</section>

<script type="text/javascript">

  $(document).ready(function() {
    get_data_laporan_harian('');
    setTimeout(function(){
      sync_data(3);
    }, 1000);
  });

  function edit_data(id) {
    $('[is_disabled="edit"]').attr('disabled', false);
    $.ajax({
      url   : '<?php echo base_url('laporan_harian/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        var r = r[0];
        $('[name=span_tanggal]').html(r.created_on);
        $('[name=id_laporan]').val(r.laporan_harian_id);
        $('[name=app_install]').val(r.app_install);
      }
    });
  }

  function ubah_laporan() {
    $('[is_disabled="edit"]').attr('disabled', true);
    $.ajax({
      url   : '<?php echo base_url('laporan_harian/edit_app_install');?>',
      data  : {
        'id' : $('[name=id_laporan]').val(),
        'app_install' : $('[name=app_install]').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_laporan_harian').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_laporan_harian").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('[name=id_laporan]').val('');
          $('[name=app_install]').val('');
          $('[name=span_tanggal]').html('');
          $('#table_laporan_harian').DataTable().ajax.reload( null, false );
        }
      }
    });
  }

  function sync_data(data) {
    $('[is_disabled="sync"]').attr('disabled', true);
    $.ajax({
      url   : '<?php echo base_url('laporan_harian/sync_data');?>',
      data  : {
        'last_date' : data,
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_laporan_harian').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_laporan_harian").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('[is_disabled="sync"]').attr('disabled', false);
          $('#table_laporan_harian').DataTable().ajax.reload( null, false );
        }
      }
    });
  }

  function get_data_laporan_harian(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_laporan_harian = $('#table_laporan_harian').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('laporan_harian/get_data_laporan_harian');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_laporan_harian').LoadingOverlay("show");
        },
        complete:function(r) {
          var data = r.responseJSON;
          $('[name=install]').val(data.total_install.jumlah_install);
          $('[name=user]').val(data.total_user.jumlah_user);
          $('[name=produk]').val(data.total_produk.jumlah_produk);

          $("#table_laporan_harian").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'created_on' },
        { data: 'app_install' },
        { data: 'user_baru' },
        { data: 'produk_baru' },
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
    $('#table_laporan_harian').DataTable().destroy();
    get_data_laporan_harian($(this).val());
  });
</script>
