<link href="<?php echo base_url('themes/adminopeo/plugins/easyui/themes/icon.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('themes/adminopeo/plugins/easyui/themes/default/easyui.css') ?>" rel="stylesheet">
<script src="<?php echo base_url('themes/adminopeo/plugins/easyui/jquery.easyui.min.js') ?>"></script>
<style media="screen">
  .datagrid-wrap.panel-body.tree-lines {
    height: auto;
  }
</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Master Lokasi</h3>
              <div class="box-tools">
                <div class="box-tools pull-right text-black">
                  <a href="<?php echo base_url('master_lokasi/tambah_lokasi')?>" class="btn btn-primary">Tambah</a>
                </div>
              </div>
            </div>

            <div class="box-body">
              <table id="dg" title="Folder Browser" class="easyui-treegrid" style="width:100%;"
                          data-options="
                              url: '<?php echo base_url('master_lokasi/get_data')?>',
                              method: 'post',
                              rownumbers: true,
                              idField: 'kode',
                              treeField: 'nama',
                              lines: true,
                          ">
                      <thead>
                          <tr>
                              <th data-options="field:'nama'" width="25%">Nama</th>
                              <th data-options="field:'kode_1'" width="15%">Kode</th>
                              <th data-options="field:'jne_origin_code'" width="10%">JNE Origin</th>
                              <th data-options="field:'jne_dest_code'" width="10%">JNE Destination</th>
                              <th data-options="field:'total'" width="15%">Jumlah</th>
                              <th data-options="field:'aksi'" width="25%">Aksi</th>
                          </tr>
                      </thead>
                  </table>
            </div>
          </div>
        </div>
      </div>
    <div>
</div>

<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog modal-sm">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Edit</h4>
       </div>
       <div class="modal-body">
         <div class="col-sm-12">
     <form id="edit" method="post">
           <div class="form-group">
             <label>Nama</label>
             <input type="text" name="nama" id="nama" class="form-control">
             <input type="hidden" name="id" id="id">
           </div>
           <div class="form-group">
             <label>JNE Origin Code</label>
             <input type="text" name="jne_origin_code" id="jne_origin_code" class="form-control">
           </div>
           <div class="form-group">
             <label>JNE Destination Code</label>
             <input type="text" name="jne_dest_code" id="jne_dest_code" class="form-control">
           </div>
           <div id="new">

           </div>
         </form>
   </div>
       </div>
       <div class="modal-footer">
         <button type="button" id="btn_simpan" class="btn btn-info" onclick="simpan();">Simpan</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>

   </div>
 </div>

</section>

    <script type="text/javascript">
      function edit(id, nama, origin, destination){
        $('#new').empty();
        $('#myModal').modal('toggle');
        $('#nama').val(nama);
        $('#jne_origin_code').val(origin);
        $('#jne_dest_code').val(destination);
        $('#btn_simpan').attr('onclick', 'simpan();');
        $('#id').val(id);
      }

      function simpan() {
        $.ajax({
          url : '<?php echo base_url('master_lokasi/simpan')?>',
          data : $('#edit').serialize(),
          type : 'POST',
          dataType : 'jSON',
          success : function (r) {
            $('#myModal').modal('toggle');
            $('#dg').treegrid('reload');
          }
        });
      }

      function hapus(id) {
        $.ajax({
          url : '<?php echo base_url('master_lokasi/hapus')?>',
          data : {id : id},
          type : 'POST',
          dataType : 'jSON',
          success : function (r) {
            $('#dg').treegrid('reload');
          }
        });
      }

      function tambah_prop(kode) {
        $('#myModal').modal('toggle');
        $('#btn_simpan').attr('onclick', 'simpan_prop();');
        var form = '<div class="form-group">'
          +'<label>Kode</label>'
          +'<input type="text" name="kode" id="kode" class="form-control" value="'+kode+'">'
          +'</div>';
        $('#nama').val();
        $('#id').val();
        $('#new').empty();
        $('#new').append(form);
      }

      function simpan_prop() {
        $.ajax({
          url : '<?php echo base_url('master_lokasi/simpan_prop')?>',
          data : $('#edit').serialize(),
          type : 'POST',
          dataType : 'jSON',
          success : function (r) {
            $('#myModal').modal('toggle');
            $('#dg').treegrid('reload');
          }
        });
      }
    </script>
