<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/upload_image.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/jquery.fileupload.js"></script>
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
              <h3 class="box-title">Data Notifikasi</h3>
            </div>

            <div class="box-body" id="content">
              <div class="col-sm-12 well">
                <div class="row">
                  <form id="form_notifikasi">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Kepada</label>
                        <div class="input-group">
                          <select id="select_to" name="kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Kepada:" required style="width:100%"></select>
                          <span class="input-group-addon"> <input type="checkbox" id="select_all_to"> Select All</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" autocomplete="on" required>
                      </div>
                      <div class="form-group">
                        <label>Pesan</label>
                        <textarea name="pesan" id="pesan" class="form-control" rows="3" cols="30" required></textarea>
                      </div>
                      <div class="form-group">
                        <label></label>
                        <button type="button" id="subm_notif" class="btn btn-info btn-sm" name="button">Kirim</button>
                        <input name="file_upload_name" id="file_upload_name" type="hidden">
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <table id="table_notifikasi" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Pesan</th>
                    <th>Pada</th>
                    <th>Status</th>
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
var table_notif = $('#table_notifikasi').DataTable({
    "processing": true,
    "serverSide": true,
    ajax : {
      url   : '<?php echo base_url('notif/get_notif')?>',
      type  : 'POST',
      beforeSend:function() {
        $('#table_notifikasi').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_notifikasi").LoadingOverlay("hide", true);
      },
    },
    columns: [
        { data: 'no' },
        { data: 'kepada' },
        { data: 'judul' },
        { data: 'pesan' },
        { data: 'created_on' },
        { data: 'status' },
    ]
  });

  $(".select2").select2({
    ajax: {
      url: '<?php echo base_url('notif/get_user')?>',
      data: function (params) {
       var query = {
         search: params.term,
         page: params.page || 1
       }
       return query;
     },
      dataType: 'json'
    }
  });

  $("#select_all_to").click(function(){
      if($(this).is(':checked') ){
        $.ajax({
            url: '<?php echo base_url('notif/get_user/all')?>',
            type: 'POST',
            // data: { taillePage: 100 },
            dataType: 'json',
            cache: false
        }).done(function (data) {
            var select2 = $('#select_to'),
                selectedValues = [];
            select2.empty();
            $.each(data.results, function (i, item) {
                select2.append($('<option>', {
                    value: item.id,
                    text: item.text
                }));
                selectedValues.push(item.id);
            });
            select2.val(selectedValues);
            $("#select_to").trigger("change");
        });
      }else{
        $("#select_to > option").removeAttr("selected");
        $("#select_to").trigger("change");
      }
  });

  $('#subm_notif').click(function () {
    var data_user_id = $(".select2").val();
    var jdl          = $('#judul').val();
    var msg          = $('#pesan').val();
    $.ajax({
      url   : '<?php echo base_url('notif/save_notif');?>',
      data  : {
        'to_id'           : data_user_id,
        'judul'           : jdl,
        'type'            : 2,
        'pesan'           : msg,
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('#table_notifikasi').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_notifikasi").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_notifikasi').DataTable().ajax.reload( null, false );
        }
      }
    });
  });

</script>
