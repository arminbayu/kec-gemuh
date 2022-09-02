<style>
div#table_user_length {
  width: 30%;
  position: absolute;
  left: 8%;
}
#allmodalcontent {
  width: 750px;
}
</style>
<div class="content">
  <div class="box-header">
    <h3 class="box-title">List User : <?php echo $name_prov ?></h3>
    <button type="button" data-dismiss="modal" class="btn btn-danger pull-right">Tutup</button>
  </div>

  <div class="box-body">

    <table id="table_user_fillter" class="table table-bordered table-striped ">
      <thead>
        <tr>
          <th style="width:5%">No</th>
          <th>Nama</th>
          <th>No Telp</th>
          <th>Tanggal Daftar</th>
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
      url  : '<?php echo base_url('list_user/get_data_filter_user');?>',
      type : 'POST',
      data : function ( d ) {
        d.id_prov = '<?php echo $id_prov ?>';
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
      { data: 'nama' },
      { data: 'notelp' },
      { data: 'created_on' },
    ],
  });
</script>
