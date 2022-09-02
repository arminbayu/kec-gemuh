<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tambah Lokasi</h3>
        </div>

        <div class="box-body">
          <form class="form-horizontal col-sm-6" action="<?php echo base_url('master_lokasi/proses_lokasi')?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>File Excel</label>
                <input type="file" name="file_excel" class="form-control">
              </div>
              <div class="form-group">
                <label></label>
                <button type="submit" name="button" class="btn btn-info">Upload</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
