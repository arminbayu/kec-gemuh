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
              <h3 class="box-title">Flashsale</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12 well" id="div_form_input" hidden>
                <div class="row">
                  <form id="form_flashsale">
                    <div class="form-row">
                      <div class="col-md-12 mb-3">
                        <label>Nama Flashsale : </label>
                        <input type="text" class="form-control" id="nama" name="flashsale" autocomplete="on" required>
                        <input type="hidden" id="id_flashsale" name="id_flashsale">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-12 mb-3">
                        <label>Keterangan : </label>
                        <textarea type="text" class="form-control" id="keterangan" name="keterangan" rows="5" required></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 mb-3">

                        <div class="pull-left" style="margin-bottom:5px;">
                          <label>Masa Berlaku : </label>
                          <div class="input-group input-group-sm" style="width: 300px;">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="masa_berlaku" value="<?php echo date('d/m/Y')?>" readonly>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12" style="margin-top:10px;">
                      <button type="button" id="tambah_flashsale" class="btn btn-success" name="button">Tambah</button>
                      <button class="btn btn-info buttonload" id="bt_simpan_loading" style="display:none;margin-right: 5px;" disabled>
                        <i class="fa fa-circle-o-notch fa-spin"></i> Loading
                      </button>
                      <button type="button" class="btn btn-primary" id="bt_batal" onclick="kembali_input()">Kembali</button>
                      <button class="btn btn-info buttonload" id="bt_batal_loading" style="display:none;" disabled>
                        <i class="fa fa-circle-o-notch fa-spin"></i> Loading
                      </button>
                    </div>
                  </form>
                </div>
              </div>


              <div id="div_table_output">
                <div class="text-left" style="margin-bottom:10px;">
                  <button type="button" id="tambah_show" class="btn btn-success">Buat Flashsale</button>
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

                <table id="table_flashsale" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th>Nama</th>
                      <th>Keterangan</th>
                      <th>Masa Berlaku</th>
                      <th>Status</th>
                      <th>Pendaftar</th>
                      <th>#</th>
                    </tr>
                  </thead>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    <div>
</div>
</section>

<script type="text/javascript">

  function hide_show_div(key) {
    if (key == 1) {
      $('#div_table_output').hide(250);
      $('#div_form_input').show(250);
    }else {
      $('#div_form_input').hide(250);
      $('#div_table_output').show(250);
    }
  }

  $('#tambah_show').click(function() {
    hide_show_div(1);
  });

  function kembali_input() {
    bersihkan();
    hide_show_div(2);
  }

  function modal_detail_flashsale(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('flashsale/detail_modal/'+id);
  }

  function peserta_flashsale(id) {
    location.replace('<?php echo base_url('flashsale/peserta_flashsale/') ?>'+id);
  }

  $(document).ready(function() {
    get_data_flashsale('');
  });

  function get_data_flashsale(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_flashsale = $('#table_flashsale').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('flashsale/get_data_flashsale');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_flashsale').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_flashsale").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'nama' },
        { data: 'keterangan_f' },
        { data: 'masa_berlaku' },
        { data: 'status', className : 'text-center' },
        { data: 'peserta', className : 'text-center' },
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
    $('#table_flashsale').DataTable().destroy();
    get_data_flashsale($(this).val());
  });

  $('#masa_berlaku').daterangepicker({
    autoclose: true,
    locale: {
      format: 'YYYY-MM-DD H:m:s'
    },
    opens: "right",
    "timePicker": true,
    "timePicker24Hour": true,
    startDate: '<?php echo date('Y-m-d H:i')?>',
    endDate: '<?php echo date('Y-m-d H:i')?>'
  });

  var tanggal_mulai   = '<?php echo date('Y-m-d H:i')?>';
  var tanggal_selesai = '<?php echo date('Y-m-d H:i')?>';
  $('#masa_berlaku').change(function () {
    var array = $(this).val().split(" - ");
    tanggal_mulai   = array[0];
    tanggal_selesai = array[1];
  });

  $('#tambah_flashsale').click(function() {
    if ($('#nama').val() == '' || $('#keterangan').val() == '') {

    }else {
      simpan_flashsale();
    }
  });

  function simpan_flashsale() {

    $('#tambah_flashsale').hide();
    $('#bt_batal').hide();
    $('#bt_simpan_loading').show();
    $('#bt_batal_loading').show();
    $.ajax({
      url   : '<?php echo base_url('flashsale/simpan');?>',
      data  : {
        'id_flashsale'   : $('#id_flashsale').val(),
        'nama'           : $('#nama').val(),
        'keterangan'     : $('#keterangan').val(),
        'status'         : '1',
        'tanggal_mulai'  : tanggal_mulai,
        'tanggal_selesai': tanggal_selesai,
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_flashsale').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_flashsale").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_flashsale').DataTable().ajax.reload( null, false );
          $('#form_flashsale').find('input').each(function() {
            $(this).val($(this).data('default'));
            $('#tambah_flashsale').html('Tambah');
            kembali_input();
          });
        }else {
          confirm('Harap ganti masa belaku flashsale karena sudah dipakai');
          $('#tambah_flashsale').show();
          $('#bt_batal').show();
          $('#bt_simpan_loading').hide();
          $('#bt_batal_loading').hide();
        }
      }
    });
  }

  function delete_flashsale(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('flashsale/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_flashsale').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_flashsale").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_flashsale').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }

  function bersihkan() {
    $('#form_flashsale').find('input', 'textarea').each(function() {
      $(this).val($(this).data('default'));
      $('#tambah_flashsale').show();
      $('#bt_batal').show();
      $('#bt_simpan_loading').hide();
      $('#bt_batal_loading').hide();
    });
  }
</script>
