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
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: middle;
}

.center-img {
  text-align: -webkit-center;
}
</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Jenis PO</h3>
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

              <table id="table_feed_user" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th style="width:75px">Gambar</th>
                    <th>Nama User</th>
                    <th>Keluhan</th>
                    <th>Tanggal</th>
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
    get_data_feed_user('');
  });

  function get_data_feed_user(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_feed_user = $('#table_feed_user').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('feed_user/get_data_feed_user');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_feed_user').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_feed_user").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'img', orderable : false, className : 'center-img' },
        { data: 'nama', orderable : false, },
        { data: 'keluhan', orderable : false },
        { data: 'created_on', orderable : false },
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
    $('#table_feed_user').DataTable().destroy();
    get_data_feed_user($(this).val());
  });

  $('#tambah_feed_user').click(function() {
    if ($('#feed_user').val() == '') {

    }else {
      simpan_feed_user();
    }
  });

  function simpan_feed_user() {
    $.ajax({
      url   : '<?php echo base_url('feed_user/simpan');?>',
      data  : {
        'id_feed_user'   : $('#id_feed_user').val(),
        'feed_user'      : $('#feed_user').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_feed_user').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_feed_user").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_feed_user').DataTable().ajax.reload( null, false );
          $('#form_feed_user').find('input').each(function() {
            $(this).val($(this).data('default'));
            $('#tambah_feed_user').html('Tambah');
          });
        }
      }
    });
  }

  function edit_data(id) {
    $.ajax({
      url   : '<?php echo base_url('feed_user/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        $('[name=id_feed_user]').val(r.feed_user_id);
        $('[name=feed_user]').val(r.nama_kategori);
        $('#tambah_feed_user').html('Ubah');
      }
    });
  }

  function delete_feed_user(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('feed_user/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_feed_user').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_feed_user").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_feed_user').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }
</script>
