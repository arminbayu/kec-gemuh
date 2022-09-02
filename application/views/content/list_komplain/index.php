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
              <h3 class="box-title">List User</h3>
            </div>

            <div class="box-body">
            <div class="box-body">

              <table id="table_user" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Pembeli</th>
                    <th>No Telp Pembeli</th>
                    <th>Penjual</th>
                    <th>No Telp Penjual</th>
                    <th>Transaksi</th>
                    <th>Alasan</th>
                    <th>Status</th>
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
      url  : '<?php echo base_url('list_komplain/get_data_komplain');?>',
      type : 'POST',
      data : function ( d ) {

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
      { data: 'pembeli' },
      { data: 'no_pembeli' },
      { data: 'penjual' },
      { data: 'no_penjual' },
      { data: 'transaksi' },
      { data: 'keterangan' },
      { data: 'status' },
      { data: 'aksi' },
    ],
  });

  function modal_detail(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('list_user/detail_user_modal/'+id);
  }

  function modal_detail_transaksi(id) {
    location.replace('<?php echo base_url('list_transaksi/detail_transaksi/') ?>'+id);
  }

  function proses(id, status) {
  }

</script>
