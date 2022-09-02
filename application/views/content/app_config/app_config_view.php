<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
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
              <h3 class="box-title">Sub Jenis PO</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12 well">
                <div class="row">
                  <form id="form_app_config">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>App Config Key : </label>
                        <input type="text" class="form-control" id="app_config_key" name="app_config_key" autocomplete="on" readonly>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>App Config Value : </label>
                        <input type="text" class="form-control" id="app_config_value" name="app_config_value" autocomplete="on" required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>Keterangan : </label>
                        <label class="col-sm-12" name="text_keterangan" style="padding-left:0px;padding-top:5px;color:#00a1ff;">-</label>
                      </div>
                    </div>
                    <div class="col-sm-12" style="margin-top:10px;">
                      <button type="button" id="ubah_app_config" class="btn btn-success" name="button">Ubah</button>
                    </div>
                  </form>
                </div>
              </div>

              <table id="table_app_config" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Key</th>
                    <th>Value</th>
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
    get_data_app_config();
  });

  function get_data_app_config(){
    var table_app_config = $('#table_app_config').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('app_config/get_data_app_config');?>',
        type : 'POST',
        data : { },
        beforeSend:function() {
          $('#table_app_config').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_app_config").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'key_text' },
        { data: 'value_text' },
        { data: 'aksi' },
      ],
    });
  }

  $('#ubah_app_config').click(function() {
    if ($('#app_config_key').val() == '') {
    }else {
      if ($('#app_config_key').val() == 'is_offline') {
        if ($('#app_config_value').val() == '0' || $('#app_config_value').val() == '1') {
          simpan_app_config();
        }else {
        }
      }else {
        simpan_app_config();
      }
    }
  });

  function simpan_app_config() {
    $.ajax({
      url   : '<?php echo base_url('app_config/simpan');?>',
      data  : {
        'key'   : $('#app_config_key').val(),
        'value' : $('#app_config_value').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_app_config').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_app_config").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_app_config').DataTable().ajax.reload( null, false );
          $('#form_app_config').find('input').each(function() {
            $(this).val($(this).data('default'));
          });
        }
      }
    });
  }

  function edit_data(key) {
    $.ajax({
      url   : '<?php echo base_url('app_config/get_data_by');?>',
      data  : {
        'key' : key,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        var r = r[0];
        $('[name=app_config_key]').val(r.app_config_key);
        $('[name=app_config_value]').val(r.app_config_value);
        $('[name=text_keterangan]').html(r.keterangan);
      }
    });
  }
</script>
