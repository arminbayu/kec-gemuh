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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Dikirim Poin</th>
                    <th>Last Actived</th>
                    <th>Jumlah Produk + Varian</th>
                    <th style="width:15%">#</th>
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
      url  : '<?php echo base_url('rekomendasi_poin/get_data_user');?>',
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
      { data: 'nama' },
      { data: 'email' },
      { data: 'notelp' },
      { data: 'dikirim' },
      { data: 'last_active' },
      { data: 'total_produk' },
      { data: 'aksi' },
    ],
  });

  function modal_detail_user(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('list_user/detail_user_modal/'+id);
  }

  function kirim_poin(id, rekomendasi_id) {
    var msg = confirm('Apakah anda yakin akan mengirim poin untuk user ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('rekomendasi_poin/kirim_poin');?>',
        data  : {
          'user_id'          : id,
          'rekomendasi_id'   : rekomendasi_id,
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
          }else {
            alert('Gagal mengirim poin, ulangi beberapa saat lagi.')
          }
        }
      });
    }
  }
</script>
