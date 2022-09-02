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

              <div class="pull-right" style="margin-bottom:5px;">
                <div class="input-group input-group-sm" style="width: 300px;" id="filter1">
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
                    <select class="form-control" id="status_akun_select">
                      <option value="0">-- Filter Status --</option>
                      <option value="0">Semua</option>
                      <option value="1">Belum Aktif</option>
                      <option value="2">Aktif</option>
                      <option value="3">Suspend</option>
                      <option value="4">Delete</option>
                    </select>
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
                      <option value="0">-- Filter Verifikasi --</option>
                      <option value="0">Semua</option>
                      <option value="1">Menunggu</option>
                      <option value="2">Verifikasi</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="pull-right" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-filter"></i>
                    </div>
                    <select class="form-control" id="provinsi_select">
                      <option value="0">-- Filter Provinsi --</option>
                      <option value="0">Semua</option>
                       <?php
                         if(!empty($provinsi)) {
                           foreach ($provinsi as $key => $value) {
                             echo '<option value="'.$value->propinsi.'">'.$value->nama.'</option>';
                           }
                         }
                        ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="pull-right" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-filter"></i>
                    </div>
                    <select class="form-control" id="posting_select">
                      <option value="0">-- Filter Posting Produk --</option>
                      <option value="0">Semua</option>
                      <option value="1">Sudah Posting Produk</option>
                      <option value="2">Belum Posting Produk</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <div class="box-body">

              <div class="pull-right" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      User Suspend
                    </div>
                    <input class="form-control" value="<?php echo $user_suspend ?>" style="width:75px" readonly></input>
                  </div>
                </div>
              </div>

              <div class="pull-right" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      User Tidak Aktif
                    </div>
                    <input class="form-control" value="<?php echo $user_tidak_aktif ?>" style="width:75px" readonly></input>
                  </div>
                </div>
              </div>

              <div class="pull-right" style="margin-right:10px;">
                <div class="input-group input-group-sm">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      User Aktif
                    </div>
                    <input class="form-control" value="<?php echo $user_aktif ?>" style="width:75px" readonly></input>
                  </div>
                </div>
              </div>
            </div>

            <div class="box-body">

              <table id="table_user" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <!-- <th>User Id</th> -->
                    <th>Nama</th>
                    <th>Merk Produk</th>
                    <th>No Telp</th>
                    <th>Status</th>
                    <th>Status Verifikasi</th>
                    <th>Tanggal Daftar</th>
                    <th>Last Actived</th>
                    <th>Jumlah Posting</th>
                    <th style="width:300px">#</th>
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
<input type="hidden" id="fiter_menunggu" value="0">
<input type="hidden" id="fiter_verifikasi" value="0">
<input type="hidden" id="fiter_posting" value="0">
<input type="hidden" id="fiter_status_akun" value="0">
<input type="hidden" id="fiter_provinsi" value="0">

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
      url  : '<?php echo base_url('list_user/get_data_user');?>',
      type : 'POST',
      data : function ( d ) {
        d.tgl              = $('#tgl').val();
        d.fiter_menunggu   = $('#fiter_menunggu').val();
        d.fiter_verifikasi = $('#fiter_verifikasi').val();
        d.fiter_posting    = $('#fiter_posting').val();
        d.fiter_status_akun = $('#fiter_status_akun').val();
        d.fiter_provinsi    = "AND user.location_dump LIKE '%{\"provinsi\":\""+$('#fiter_provinsi').val()+"\"%'";
        d.fiter_provinsi_if    = $('#fiter_provinsi').val();
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
      // { data: 'user_id' },
      { data: 'nama' },
      { data: 'merk_produk' },
      { data: 'notelp' },
      { data: 'status_akun' },
      { data: 'status_verifikasi' },
      { data: 'created_on' },
      { data: 'last_active_f' },
      { data: 'jumlah_produk' },
      { data: 'aksi' },
    ],
  });

  function modal_detail_user(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('list_user/detail_user_modal/'+id);
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
    $('#fiter_status_akun').val('0');
    $('#fiter_menunggu').val('0');
    $('#fiter_verifikasi').val('0');
    $('#tgl').val($(this).val());
    table_user.ajax.reload(null, false);
  });

  function verifikasi_user(id) {
    var msg = confirm('Apakah anda yakin akan memverifikasi user ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('List_user/verifikasi_user');?>',
        data  : {
          'verifikasi_user_id'   : id,
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

  function user_plus(id) {
    var msg = confirm('Apakah anda yakin akan memasukan user ini dalam daftar layanan plus ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('List_user/user_plus');?>',
        data  : {
          'user_id'   : id,
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
  function non_aktif_user(id) {
    var msg = confirm('Apakah anda yakin akan mennonaktifkan user ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('List_user/nonaktif_user');?>',
        data  : {
          'user_id'   : id,
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
            var msg = confirm('User tidak bisa di nonaktifkan karena temasuk yang aktif');
          }
        }
      });
    }
  }

  function aktif_user(id) {
    var msg = confirm('Apakah anda yakin akan aktifkan user ini ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('List_user/aktif_user');?>',
        data  : {
          'user_id'   : id,
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

  $('#provinsi_select').change(function () {
    // if ($(this).val() != '') {
    //   $('#allmodal').modal('show');
    //   $('#allmodalcontent').load('list_user/fillter_user_modal/'+$(this).val());
    // }
    table_user.ajax.reload(null, false);
    let val = $(this).val();
    if (val != '0') {
      $('#fiter_provinsi').val(val);
      table_user.ajax.reload(null, false);
    }else {
      $('#fiter_provinsi').val('0');
      table_user.ajax.reload(null, false);
    }
  });

  $('#status_select').change(function () {
    $('#fiter_menunggu').val('0');
    $('#fiter_verifikasi').val('0');
    // $('#tgl').val('00/00/0000 - 31/12/9999');
    table_user.ajax.reload(null, false);
    let val = $(this).val();
    if (val != '0') {
      if (val == '1') {
        $('#fiter_menunggu').val('1');
      }else if (val == '2') {
        $("#fiter_verifikasi").val('1');
      }
      table_user.ajax.reload(null, false);
    }else {
      $('#fiter_menunggu').val('0');
      $('#fiter_verifikasi').val('0');
      table_user.ajax.reload(null, false);
    }
  });

  $('#status_akun_select').change(function () {
    $('#fiter_status_akun').val('0');
    // $('#tgl').val('00/00/0000 - 31/12/9999');
    table_user.ajax.reload(null, false);
    let val = $(this).val();
    if (val != '0') {
      $('#fiter_status_akun').val(val);
      table_user.ajax.reload(null, false);
    }else {
      $('#fiter_status_akun').val('0');
      table_user.ajax.reload(null, false);
    }
  });

  $('#posting_select').change(function () {
    $('#fiter_posting').val('0');
    // $('#tgl').val('00/00/0000 - 31/12/9999');
    table_user.ajax.reload(null, false);
    let val = $(this).val();
    if (val != '0') {
      if (val == '1') {
        $('#fiter_posting').val('1');
      }else if (val == '2') {
        $("#fiter_posting").val('2');
      }
      table_user.ajax.reload(null, false);
    }else {
      $('#fiter_posting').val('0');
      table_user.ajax.reload(null, false);
    }
  });
</script>
