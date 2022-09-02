<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Tagihan</h3>
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
              <table id="table_invoice" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Kode Tagihan</th>
                    <th>Pembeli</th>
                    <th>Total Tagihan</th>
                    <th>Potongan Poin</th>
                    <th>Total Transaksi</th>
                    <th>Status Pembayaran</th>
                    <th>Bukti Bayar</th>
                    <th>Bukti Kirim</th>
                    <th style="width:220px">#</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
    </div>
</section>

<script type="text/javascript">

  $(document).ready(function() {
    get_data_invoice('');
  });

  function get_data_invoice(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_invoice = $('#table_invoice').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      lengthMenu : [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      pageLength : 20,
      processing : true,
      serverSide : true,
      ajax : {
        url  : '<?php echo base_url('list_invoice/get_data_invoice');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_invoice').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_invoice").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no', orderable : false, },
        { data: 'kode_transaksi', orderable : false, },
        { data: 'kode_tagihan', orderable : false, },
        { data: 'pembayaran', orderable : false},
        { data: 'nominal', orderable : false, className : 'text-right' },
        { data: 'potongan_poin_v', orderable : false, className : 'text-right' },
        { data: 'total_transaksi', orderable : false, className : 'text-right' },
        { data: 'status_pembayaran', orderable : false, className : 'text-center' },
        { data: 'tanda_bukti', orderable : false, className : 'text-center' },
        { data: 'tanda_bukti_kirim', orderable : false, className : 'text-center' },
        { data: 'aksi', orderable : false },
      ],
    });
  }
  //
  $('#datepicker').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  });

  $('#datepicker').change(function () {
    $('#table_invoice').DataTable().destroy();
    get_data_invoice($(this).val());
  });

  function detail_invoice(id) {
    location.replace('<?php echo base_url('list_transaksi/detail_transaksi/') ?>'+id);
  }

</script>
