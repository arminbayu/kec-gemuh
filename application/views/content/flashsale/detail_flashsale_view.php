<style>
.form-horizontal .control-label {
  text-align: left;
}
</style>

<div class="panel panel-default" id="panel_user">
  <div class="panel-heading">
    <h3 style="margin:0">Detail Flashsale</h3>
  </div>
  <div class="panel-body">
    <table class="table">
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->nama) ? $flashsale->nama : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->keterangan) ? $flashsale->keterangan : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Masa Berlaku</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->masa_berlaku) ? $flashsale->masa_berlaku : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Aktif</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->tanggal_mulai_f) ? $flashsale->tanggal_mulai_f : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Status</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->status) ? $flashsale->status : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Pendaftar</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->jumlah_daftar) ? $flashsale->jumlah_daftar : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Menunggu Konfirmasi</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->komfirmasi) ? $flashsale->komfirmasi : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Disetujui</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->disetujui) ? $flashsale->disetujui : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Ditolak</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->ditolak) ? $flashsale->ditolak : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Dibuat</td>
        <td>:</td>
        <td><strong><?php echo !empty($flashsale->created_on_f) ? $flashsale->created_on_f : '-' ?></strong></td>
      </tr>
    </table>
  </div>
  <div class="panel-footer text-right">
    <button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
  </div>
</div>
