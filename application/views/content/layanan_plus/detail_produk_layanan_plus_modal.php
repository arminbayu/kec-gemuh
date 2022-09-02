<style>
div#table_user_length {
  /* width: 30%;
  position: absolute;
  left: 8%; */
}
.modal-dialog {
  width: 1024px;
}
</style>
<div class="content">
  <div class="box-header">
    <h3 class="box-title">List Produk : <?php echo $user->nama ?></h3>
    <button type="button" data-dismiss="modal" class="btn btn-danger pull-right">Tutup</button>
  </div>

  <div class="box-body">

    <table id="table_user_fillter" class="table table-bordered table-striped ">
      <thead>
        <tr>
          <th style="width:5%">No</th>
          <th>Nama Produk</th>
          <th>Merk Produk</th>
          <th>Harga</th>
          <th>Jenis PO</th>
          <th>Status</th>
          <th>Tanggal PO</th>
          <th>Tanggal Post</th>
          <th>Last Actived</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<script type="text/javascript">
  var table_user = $('#table_user_fillter').DataTable({
    "bFilter"   : false,
    "bLengthChange": false,
    "processing": true,
    "serverSide": true,
    ajax : {
      url  : '<?php echo base_url('layanan_plus/get_data_produk_user');?>',
      type : 'POST',
      data : function ( d ) {
        d.created_by = '<?php echo $user->user_id ?>';
      },
      beforeSend:function() {
        $('#table_user_fillter').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_user_fillter").LoadingOverlay("hide", true);
      },
    },
    columns: [
      { data: 'no' },
      { data: 'nama_produk' },
      { data: 'merk_produk' },
      { data: 'harga_produk_f' },
      { data: 'jenis_po_id_f' },
      { data: 'is_active_f' },
      { data: 'tanggal_kirim_f' },
      { data: 'created_on_f' },
      { data: 'tanggal_selesai_po_f' },
    ],
  });
</script>
