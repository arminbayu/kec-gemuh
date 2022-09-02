<style>
.form-horizontal .control-label {
  text-align: left;
}
</style>

<div class="panel panel-default" id="panel_user">
  <div class="panel-heading">
    <h3 style="margin:0">Produk</h3>
  </div>
  <div class="panel-body">

    <table id="table_produk" class="table table-bordered table-striped ">
      <thead>
        <tr>
          <th style="width:5%">No</th>
          <th>Nama Produk</th>
          <th>Tanggal Selesai</th>
          <th>Status</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="panel-footer text-right">
    <button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function() {
    get_data_produk();
  });

  function get_data_produk(){
    var table_produk = $('#table_produk').DataTable({
      searching: false,
      paging: false,
      info: false,
      ajax : {
        url  : '<?php echo base_url('flashsale/produk_tabel_view');?>',
        type : 'POST',
        data : {
          id:'<?php echo $id ?>'
        },
        beforeSend:function() {
          $('#table_produk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_produk").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'nama_produk' },
        { data: 'tanggal_selesai_po' },
        { data: 'is_active', className : 'text-center' },
      ],
    });
  }
</script>
