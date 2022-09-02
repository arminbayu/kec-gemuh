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
              <h3 class="box-title">Jenis PO</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12 well">
                <div class="row">
                  <form id="form_blog_kategori">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>Nama blog_kategori : </label>
                        <input type="text" class="form-control" id="blog_kategori" name="blog_kategori" autocomplete="on" required>
                        <input type="hidden" id="id_blog_kategori" name="id_blog_kategori">
                      </div>
                      </div>
                      <div class="col-sm-12" style="margin-top:10px;">
                        <button type="button" id="tambah_blog_kategori" class="btn btn-success" name="button">Tambah</button>
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

              <table id="table_blog_kategori" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Kategori</th>
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
    get_data_blog_kategori('');
  });

  function get_data_blog_kategori(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_blog_kategori = $('#table_blog_kategori').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('blog_kategori/get_data_blog_kategori');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_blog_kategori').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_blog_kategori").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'nama_kategori' },
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
    $('#table_blog_kategori').DataTable().destroy();
    get_data_blog_kategori($(this).val());
  });

  $('#tambah_blog_kategori').click(function() {
    if ($('#blog_kategori').val() == '') {

    }else {
      simpan_blog_kategori();
    }
  });

  function simpan_blog_kategori() {
    $.ajax({
      url   : '<?php echo base_url('blog_kategori/simpan');?>',
      data  : {
        'id_blog_kategori'   : $('#id_blog_kategori').val(),
        'blog_kategori'      : $('#blog_kategori').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_blog_kategori').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_blog_kategori").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_blog_kategori').DataTable().ajax.reload( null, false );
          $('#form_blog_kategori').find('input').each(function() {
            $(this).val($(this).data('default'));
            $('#tambah_blog_kategori').html('Tambah');
          });
        }
      }
    });
  }

  function edit_data(id) {
    $.ajax({
      url   : '<?php echo base_url('blog_kategori/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        $('[name=id_blog_kategori]').val(r.blog_kategori_id);
        $('[name=blog_kategori]').val(r.nama_kategori);
        $('#tambah_blog_kategori').html('Ubah');
      }
    });
  }

  function delete_blog_kategori(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('blog_kategori/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_blog_kategori').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_blog_kategori").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_blog_kategori').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }
</script>
