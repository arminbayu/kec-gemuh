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
              <button class="btn btn-info buttonload" onclick="kembali()">
                <i class="fa fa-arrow-left"></i> Kembali
              </button>
            </div>

            <div class="box-body">
              <h3 style="margin-top:0" class="box-title text-center">Daftar anggota : Flashsale <?php echo $flashsale->nama ?></h3>
              <table id="table_flashsale" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Nama</th>
                    <th>Jumlah Produk</th>
                    <th>Status</th>
                    <th>Keterangan</th>
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

  function ditolak(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').append('<div class="panel-body">'+
    '<label>Alasan Ditolak : </label>'+
    '<textarea type="text" class="form-control" id="alasan_tolak" name="alasan_tolak" rows="3" required></textarea>'+
    '</div>'+
    '<div class="panel-footer text-right">'+
      '<button type="button" data-dismiss="modal" class="btn btn-danger" style="margin-right:10px;" >Batal</button>'+
      '<button type="button" data-dismiss="modal" class="btn btn-success" onclick="tolak_pengajuan('+id+',2)">Simpan</button>'+
    '</div>');
  }

  function produk_modal_view(id) {
    $('#allmodal').modal('show');
    $('#allmodalcontent').load('<?php echo base_url('/flashsale/produk_modal_view/');?>'+id);
  }

  function kembali(id) {
    location.replace('<?php echo base_url('flashsale') ?>');
  }

  function diterima(id) {

    $.ajax({
      url   : '<?php echo base_url('flashsale/cek_produk');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        if (r.success) {
          var msg = confirm('Kamu yakin akan menerima penajuan dari user ini ?');
          if (msg) {
            tolak_pengajuan(id, '1');
          }
        }else {
          confirm('Tidak dapat menerima karena terdapat produk yang dihapus atau masa selesai po nya kurang dari flashsale, cek produk untuk detailnya');
        }
      }
    });
  }

  function tolak_pengajuan(id, status) {
    if ($('#alasan_tolak').val() == '') {
      confirm('Alasan tidak boleh kosong');
    }else {
      $.ajax({
        url   : '<?php echo base_url('flashsale/tolak_pengajuan');?>',
        data  : {
          'id'       : id,
          'status'   : status,
          'alasan'   : $('#alasan_tolak').val(),
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

  $(document).ready(function() {
    get_data_flashsale('');
  });

  function get_data_flashsale(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_flashsale = $('#table_flashsale').DataTable({
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('flashsale/get_data_peserta');?>',
        type : 'POST',
        data : {
          tgl : tgl,
          id : '<?php echo $flashsale->flashsale_id ?>'
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
        { data: 'nama_user' },
        { data: 'jum_produk' },
        { data: 'status', className : 'text-center' },
        { data: 'alasan_tolak' },
        { data: 'aksi' },
      ],
    });
  }
</script>
