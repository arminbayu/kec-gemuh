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
              <h3 class="box-title">Penarikan Saldo</h3>
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

              <table id="table_user" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Nama User</th>
                    <th>Atas Nama Rekening</th>
                    <th>No Rekening	Bank</th>
                    <th>Nama Bank</th>
                    <th>Nominal (IDR)</th>
                    <th>Potongan (IDR)</th>
                    <th>Bukti Rekening</th>
                    <th>Status</th>
                    <th>Waktu</th>
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
<script type="text/html" id="template_harga">
  <style>
  .form-horizontal .control-label {
    text-align: left;
  }
  </style>

  <div class="panel panel-default">
    <div class="panel-heading" style="height:55px;">
      <div class="col-sm-6" style="padding:0;">
        <h3 style="margin:0; text-align:left;" id="h3_title"></h3>
      </div>
      <div class="col-sm-6 text-right" style="padding:0;">
        <button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
      </div>
    </div>
    <div class="panel-body" id="div_panel_body"></div>
    <div class="panel-footer text-right"></div>
  </div>

</script>
<script type="text/javascript">

  $(document).ready(function() {
    get_data_penarikan('');
  });

  function get_data_penarikan(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

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
        url  : '<?php echo base_url('penarikan_saldo/get_data_penarikan');?>',
        type : 'POST',
        data : {
          tgl : tgl
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
        { data: 'nama_user' },
        { data: 'atas_nama' },
        { data: 'no_rek' },
        { data: 'nama_bank' },
        { data: 'nominal' },
        { data: 'potongan' },
        { data: 'img_rekening' },
        { data: 'status_f' },
        { data: 'created_on' },
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
    $('#table_user').DataTable().destroy();
    get_data_penarikan($(this).val());
  });

  function aksi_transfer(id, type) {
    var msg = confirm('Apakah anda yakin dan sudah mengecek bukti ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('penarikan_saldo/aksi_transfer');?>',
        data  : {
          'id'   : id,
          'type' : type,
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
          }
        }
      });
    }
  }

  function modal_foto(gambar, title) {
    var template_harga = $('#template_harga').html();
    url = '<?php echo URL_UPLOAD.'/bukti_rekening/' ?>';
    $('#allmodal').modal('show');
    $('#allmodalcontent').append(template_harga);
    $('#div_panel_body').append('<img style="width:100%;" src="'+url+gambar+'" class="img-responsive">');
    $('#h3_title').html(title);
  }
</script>
