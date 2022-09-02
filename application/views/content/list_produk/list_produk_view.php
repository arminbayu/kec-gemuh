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
              <h3 class="box-title">List Produk</h3>

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

              <div class="pull-right" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-filter"></i>
                    </div>
                    <select class="form-control" id="status_select">
                      <option value="">-- Filter Status --</option>
                      <option value="0">Semua</option>
                      <option value="1">Tidak Aktif</option>
                      <option value="2">Aktif</option>
                      <option value="3">Deleted</option>
                      <option value="4">Expired</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <div class="box-body">

              <table id="table_produk" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Nama Produk</th>
                    <th>Merk</th>
                    <th>Penjual</th>
                    <th>Harga</th>
                    <th>Jenis PO</th>
                    <th>Tanggal PO</th>
                    <th>Tanggal Post</th>
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

<input type="hidden" id="tgl" value="00/00/0000 - 31/12/9999">
<input type="hidden" id="filter_tidak_aktif" value="0">
<input type="hidden" id="filter_aktif" value="0">
<input type="hidden" id="filter_deleted" value="0">
<input type="hidden" id="filter_expired" value="0">

<script type="text/javascript">
  var table_produk = $('#table_produk').DataTable({
    dom: 'Blfrtip',
    buttons: [
        'excel', 'csv'
    ],
    "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
    "pageLength": 20,
    "processing": true,
    "serverSide": true,
    ajax : {
      url  : '<?php echo base_url('list_produk/get_data_produk');?>',
      type : 'POST',
      data : function ( d ) {
        d.tgl                 = $('#tgl').val();
        d.filter_tidak_aktif  = $('#filter_tidak_aktif').val();
        d.filter_aktif        = $('#filter_aktif').val();
        d.filter_deleted      = $('#filter_deleted').val();
        d.filter_expired      = $('#filter_expired').val();
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
      { data: 'merk_produk' },
      { data: 'created_by' },
      { data: 'harga_produk' },
      { data: 'jenis_po_text' },
      { data: 'tanggal_po' },
      { data: 'tanggal_buat' },
      { data: 'is_active' },
      { data: 'aksi' },
    ],
  });

  $('#datepicker').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  });

  $('#datepicker').change(function () {
    $('#filter_tidak_aktif').val('0');
    $('#filter_aktif').val('0');
    $('#filter_deleted').val('0');
    $('#filter_expired').val('0');
    $('#tgl').val($(this).val());
    table_produk.ajax.reload(null, false);
  });

  function aktifkan_produk(produk_id) {
    var msg = confirm('Apakah anda yakin akan mengaktifakn produk ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('list_produk/aktivasi_produk');?>',
        data  : {
          'produk_id'   : produk_id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_produk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_produk").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_produk').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function tolak_produk(produk_id) {
    var msg = confirm('Apakah anda yakin akan menolak produk ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('list_produk/tolak_produk');?>',
        data  : {
          'produk_id'   : produk_id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_produk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_produk").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_produk').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function unaktif_produk(produk_id) {
    var msg = confirm('Apakah anda yakin akan menonaktifkan produk ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('list_produk/unaktif_produk');?>',
        data  : {
          'produk_id'   : produk_id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_produk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_produk").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_produk').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function block_produk(produk_id) {
    var msg = confirm('Apakah anda yakin akan memblock produk ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('list_produk/block_produk');?>',
        data  : {
          'produk_id'   : produk_id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_produk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_produk").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_produk').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function modal_detail_produk(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('list_produk/detail_produk_modal/'+id);
  }

  $('#status_select').change(function () {
    $('#filter_tidak_aktif').val('0');
    $('#filter_aktif').val('0');
    $('#filter_deleted').val('0');
    $('#filter_expired').val('0');
    $('#tgl').val('00/00/0000 - 31/12/9999');
    table_produk.ajax.reload(null, false);
    let val = $(this).val();
    if (val != '0') {
      if (val == '1') {
        $('#filter_tidak_aktif').val('1');
      }else if (val == '2') {
        $("#filter_aktif").val('1');
      }else if (val == '3') {
        $("#filter_deleted").val('1');
      }else if (val == '4') {
        $("#filter_expired").val('1');
      }
      table_produk.ajax.reload(null, false);
    }
  });
</script>
