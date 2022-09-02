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
              <h3 class="box-title">Layanan Plus</h3>
              <div class="pull-right" style="margin-bottom:5px;">
                <div class="input-group input-group-sm" style="width: 300px;" id="filter1">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo date('d/m/Y')?>" readonly>
                  </div>
                </div>

              </div>

              <div class="pull-right" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-filter"></i>
                    </div>
                    <select class="form-control" id="provinsi_select">
                      <option value="">-- Filter Provinsi --</option>
                       <?php
                         if(!empty($provinsi)) {
                           foreach ($provinsi as $key => $value) {
                             echo '<option value="'.$value->propinsi.'">'.$value->nama.'</option>';
                           }
                         }
                        ?>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <div class="box-body">

              <table id="table_user" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Nama</th>
                    <th>No Telp</th>
                    <th>Tanggal Daftar</th>
                    <th>Last Actived</th>
                    <th style="width:25%">#</th>
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

<input type="hidden" id="tgl" value="00/00/0000 - 31/12/9999">
<input type="hidden" id="fiter_menunggu" value="0">
<input type="hidden" id="fiter_verifikasi" value="0">
<input type="hidden" id="fiter_posting" value="0">

<script type="text/javascript">

  var table_user = $('#table_user').DataTable({
    dom: 'Blfrtip',
    buttons: [
        'excel', 'csv'
    ],
    "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
    "pageLength": 20,
    "processing": true,
    "serverSide": true,
    ajax : {
      url  : '<?php echo base_url('layanan_plus/get_data_user');?>',
      type : 'POST',
      data : function ( d ) {
        d.tgl              = $('#tgl').val();
        d.fiter_menunggu   = $('#fiter_menunggu').val();
        d.fiter_verifikasi = $('#fiter_verifikasi').val();
        d.fiter_posting    = $('#fiter_posting').val();
      },
      beforeSend:function() {
        $('#table_user').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_user").LoadingOverlay("hide", true);
      },
    },
    columns: [
      { data: 'no' },
      { data: 'nama' },
      { data: 'notelp' },
      { data: 'created_on' },
      { data: 'last_active_f' },
      { data: 'aksi' },
    ],
  });

  function modal_detail_user(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('layanan_plus/detail_user_modal/'+id);
  }

  function modal_detail_produk(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('layanan_plus/fillter_produk_modal/'+id);
  }

  $('#provinsi_select').change(function () {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('layanan_plus/fillter_user_modal/'+$(this).val());
  });

  $('#datepicker').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  });

  $('#datepicker').change(function () {
    $('#fiter_menunggu').val('0');
    $('#fiter_verifikasi').val('0');
    $('#tgl').val($(this).val());
    table_user.ajax.reload(null, false);
  });

  function delete_user_plus(id) {
    var msg = confirm('Apakah anda yakin akan menghapus user dari layanan plus ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('layanan_plus/delete_user_plus');?>',
        data  : {
          'user_id'   : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_user').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_user").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_user').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }
</script>
