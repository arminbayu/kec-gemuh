<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<style>
div#table_laporan_user_length {
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
            </div>

            <div class="box-body">

              <table id="table_laporan_user" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Produk</th>
                    <th>Alasan</th>
                    <th style="width:15%">Tanggal</th>
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
    get_data_laporan_user('');
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

  function get_data_laporan_user(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_laporan_user = $('#table_laporan_user').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('laporan_user/get_data_laporan_user');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_laporan_user').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_laporan_user").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'produk' },
        { data: 'alasan' },
        { data: 'tanggal' },
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
    $('#table_laporan_user').DataTable().destroy();
    get_data_laporan_user($(this).val());
  });

  function delete_laporan_user(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('laporan_user/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_laporan_user').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_laporan_user").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_laporan_user').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }
</script>
