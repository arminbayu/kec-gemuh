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
              <h3 class="box-title">Rekening Bank</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12 well">
                <div class="row">
                  <form id="form_rekening_bank">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>Nama Bank : </label>
                        <input type="text" class="form-control" id="nama_bank" name="nama_bank" autocomplete="on" required>
                        <input type="hidden" id="id_rekening_bank" name="id_rekening_bank">
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>Kode Bank : </label>
                        <input type="text" class="form-control" id="kode_bank" name="kode_bank" autocomplete="on" required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>Potongan : </label>
                        <input type="text" class="form-control" id="potongan" name="potongan" autocomplete="on" required>
                      </div>
                      </div>
                      <div class="col-sm-12" style="margin-top:10px;">
                        <button type="button" id="tambah_rekening_bank" class="btn btn-success" name="button">Tambah</button>
                      </div>
                  </form>
                </div>
              </div>

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

              <table id="table_rekening_bank" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Nama Bank</th>
                    <th>Kode Bank</th>
                    <th>Potongan</th>
                    <th>Tanggal</th>
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
    get_data_rekening_bank('');
  });

  function get_data_rekening_bank(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_rekening_bank = $('#table_rekening_bank').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('rekening_bank/get_data_rekening_bank');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_rekening_bank').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_rekening_bank").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'nama_bank' },
        { data: 'kode_bank' },
        { data: 'potongan' },
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
    $('#table_rekening_bank').DataTable().destroy();
    get_data_rekening_bank($(this).val());
  });

  $('#tambah_rekening_bank').click(function() {
    if ($('#nama_bank').val() == '' || $('#kode_bank').val() == '') {

    }else {
      simpan_rekening_bank();
    }
  });

  function simpan_rekening_bank() {
    $.ajax({
      url   : '<?php echo base_url('rekening_bank/simpan');?>',
      data  : {
        'id_rekening_bank' : $('#id_rekening_bank').val(),
        'nama_bank'        : $('#nama_bank').val(),
        'kode_bank'        : $('#kode_bank').val(),
        'potongan'         : $('#potongan').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_rekening_bank').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_rekening_bank").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_rekening_bank').DataTable().ajax.reload( null, false );
          $('#form_rekening_bank').find('input').each(function() {
            $(this).val($(this).data('default'));
            $('#tambah_rekening_bank').html('Tambah');
          });
        }
      }
    });
  }

  function edit_data(id) {
    $.ajax({
      url   : '<?php echo base_url('rekening_bank/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        $('[name=id_rekening_bank]').val(r.rekening_bank_id);
        $('[name=nama_bank]').val(r.nama_bank);
        $('[name=kode_bank]').val(r.kode_bank);
        $('[name=potongan]').val(r.potongan);
        $('#tambah_rekening_bank').html('Ubah');
      }
    });
  }

  function delete_rekening_bank(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('rekening_bank/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_rekening_bank').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_rekening_bank").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_rekening_bank').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }
</script>
