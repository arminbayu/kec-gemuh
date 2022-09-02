<style>
.form-horizontal .control-label {
  text-align: left;
}
</style>

<div class="panel panel-default" id="panel_produk">
  <div class="panel-heading">
    <h3 style="margin:0">Detail Produk</h3>
  </div>
  <div class="panel-body" style="height: 600px;overflow-y: scroll">
    <table class="table">
      <tr>
        <td colspan="3">
          <div class="panel panel-default">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators" id="div_indicator"></ol>
              <div class="carousel-inner" id="div_panel_body"></div>
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>Nama Produk</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->nama_produk) ? $produk->nama_produk : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Merk Produk</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->merk_produk) ? $produk->merk_produk : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Penjual</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->created_by) ? $produk->created_by : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Harga Produk</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->harga_produk) ? $produk->harga_produk : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Jenis</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->jenis_po_text) ? $produk->jenis_po_text : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Lokasi Produk</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->lokasi_produk) ? $produk->lokasi_produk : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Map</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->lokasi_map) ? $produk->lokasi_map : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Tanggal PO</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->tanggal_po) ? $produk->tanggal_po : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Tanggal Posting</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->tanggal_buat) ? $produk->tanggal_buat : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Durasi Persiapan</td>
        <td>:</td>
        <td><strong><?php echo !empty($produk->persiapan) ? $produk->persiapan : '-' ?></strong></td>
      </tr>
    </table>
  </div>
  <div class="panel-footer text-right">
    <button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var url = '<?php echo URL_UPLOAD.'/produk/' ?>';
    $.ajax({
      url   : '<?php echo base_url('list_produk/get_data_gambar');?>',
      data  : {
        'id' : <?php echo $produk->session_upload_id ?>,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        for (var i = 0; i < r.length; i++) {
          if (i == 0) {
            $('#div_panel_body').append('<div class="item active" style="text-align: -webkit-center;"><img style="height:300px;" src="'+url+r[i].file_name+'" class="img-responsive"></div>');
          }else {
            $('#div_panel_body').append('<div class="item" style="text-align: -webkit-center;"><img style="height:300px;" src="'+url+r[i].file_name+'" class="img-responsive"></div>');
          }
          $('#div_indicator').append('<li data-target="#myCarousel" data-slide-to="'+i+'"></li>');
        }
      }
    });
  });
</script>
