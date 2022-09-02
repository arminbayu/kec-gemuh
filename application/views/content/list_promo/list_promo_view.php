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
              <h3 class="box-title">List Promo</h3>
            </div>

            <div class="box-body">
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

              <div class="pull-left" style="margin-bottom:5px;margin-right:10px;">
                <button type="button" class="btn btn-success" onclick="tambah_promo()">Tambah Promo</button>
              </div>

              <table id="table_promo" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Kode Promo</th>
                    <th>Nominal</th>
                    <th>Jenis</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Tanggal</th>
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

  $(document).ready(function() {
    get_data_promo('');
  });

  function get_data_promo(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_promo = $('#table_promo').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('list_promo/get_data_promo');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_promo').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_promo").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'kode_promo_f' },
        { data: 'nominal_promo_f' },
        { data: 'jenis_promo_f', className : 'text-center' },
        { data: 'tanggal_mulai_f' },
        { data: 'tanggal_selesai_f' },
        { data: 'created_on' },
        { data: 'is_aktif_f' },
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
    $('#table_promo').DataTable().destroy();
    get_data_promo($(this).val());
  });

  function tambah_promo() {
    location.replace('<?php echo base_url('list_promo/tambah_promo') ?>');
  }

  function modal_detail_promo(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('list_promo/detail_promo_modal/'+id);
  }

  function delete_promo(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('list_promo/delete_promo');?>',
        data  : {
          id : id
        },
        type  : 'POST',
        dataType : 'jSON',
        success : function (r) {
          if (r.success) {
            $('#table_promo').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }
</script>
