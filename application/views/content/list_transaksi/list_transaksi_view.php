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
              <h3 class="box-title">List Transaksi</h3>
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
              <table id="table_transaksi" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Penjual</th>
                    <th>Pembeli</th>
                    <th>Pembayaran</th>
                    <th>Total Tagihan</th>
                    <th>Poin</th>
                    <th>Promo</th>
                    <th>Promo Ongkir</th>
                    <th>Total Transaksi</th>
                    <th>Status Pesanan</th>
                    <!-- <th>Bukti Bayar</th>
                    <th>Bukti Kirim</th> -->
                    <th style="width:220px">#</th>
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
    get_data_transaksi('');
  });

  function get_data_transaksi(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_transaksi = $('#table_transaksi').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      lengthMenu : [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      pageLength : 20,
      processing : true,
      serverSide : true,
      ajax : {
        url  : '<?php echo base_url('list_transaksi/get_data_transaksi');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_transaksi').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_transaksi").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'kode_transaksi' },
        { data: 'penjual' },
        { data: 'pembeli' },
        { data: 'pembayaran' },
        { data: 'nominal', className : 'text-right' },
        { data: 'potongan_poin_v', className : 'text-right' },
        { data: 'potongan_produk_v', className : 'text-right' },
        { data: 'potongan_v', className : 'text-right' },
        { data: 'total_transaksi', className : 'text-right' },
        { data: 'status_pesanan', orderable : false, className : 'text-center' },
        // { data: 'tanda_bukti', orderable : false, className : 'text-center' },
        // { data: 'tanda_bukti_kirim', orderable : false, className : 'text-center' },
        { data: 'aksi', orderable : false },
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
    $('#table_transaksi').DataTable().destroy();
    get_data_transaksi($(this).val());
  });

  function aktifkan_transaksi(transaksi_id) {
    var msg = confirm('Apakah kamu yakin akan menyetujui transaksi ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('list_transaksi/aktivasi_transaksi');?>',
        data  : {
          'transaksi_id'   : transaksi_id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_transaksi').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_transaksi").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_transaksi').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function selesai_transaksi(transaksi_id) {
    var msg = confirm('Apakah kamu yakin dengan bukti yang dikirimkan oleh penjual ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('list_transaksi/selesai_transaksi');?>',
        data  : {
          'transaksi_id'   : transaksi_id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_transaksi').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_transaksi").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_transaksi').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function batal_transaksi(transaksi_id) {
    var msg = confirm('Apakah kamu yakin akan membatalkan transaksi ini, coba di cek bukti pengirimanya dulu ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('list_transaksi/batal_transaksi');?>',
        data  : {
          'transaksi_id'   : transaksi_id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_transaksi').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_transaksi").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_transaksi').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function detail_transaksi(id) {
    location.replace('<?php echo base_url('list_transaksi/detail_transaksi/') ?>'+id);
  }
</script>
