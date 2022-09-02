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
              <h3 class="box-title">Brankas User</h3>
            </div>

            <div class="box-body">
              <table id="table_user" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th style="width:20%">Nama</th>
                    <th>Saldo Opeopay</th>
                    <th>Saldo Penghasilan</th>
                    <th>Poin</th>
                    <th>Update Terakhir</th>
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
      url  : '<?php echo base_url('brankas_user/get_data_user');?>',
      type : 'POST',
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
      { data: 'saldo_f', className : 'text-right' },
      { data: 'saldo_penghasilan_f', className : 'text-right' },
      { data: 'poin', className : 'text-center' },
      { data: 'modified_on', className : 'text-center' },
      { data: 'aksi', className : 'text-center' },
    ],
  });

  function modal_detail_brankas(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('brankas_user/detail/'+id);
  }

  function modal_refund(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('brankas_user/refund_form/'+id);
  }
</script>
