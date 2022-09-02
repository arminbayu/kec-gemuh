<style>
.form-horizontal .control-label {
  text-align: left;
}
</style>

<div class="panel panel-default" id="panel_user">
  <div class="panel-heading">
    <h3 style="margin:0">Detail User</h3>
  </div>
  <div class="panel-body" style="height: 600px;overflow-y: scroll">
    <table class="table">
      <tr>
        <td colspan="3"><img style="max-width: 100%; align: 'center'" src="<?php echo !empty($user->foto) ? $user->foto : '-' ?>" alt=""></td>
      </tr>
      <tr>
        <td>Nama User</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->nama) ? $user->nama : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Nomor HP</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->notelp) ? $user->notelp : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Email</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->email) ? $user->email : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->lokasi_user) ? $user->lokasi_user : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Jam Operasional</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->waktu  ) ? $user->waktu   : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Tanggal Daftar</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->created_on) ? $user->created_on : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Status Email</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->is_verif_email) ? $user->is_verif_email : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Status Review</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->is_review) ? $user->is_review : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Foto KTP</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->img_ktp) ? $user->img_ktp : '-' ?></strong>
      </tr>
      <tr>
        <td>Foto Selfi</td>
        <td>:</td>
        <td><strong><?php echo !empty($user->img_selfi) ? $user->img_selfi : '-' ?></strong></td>
      </tr>


    </table>
  </div>
  <div class="panel-footer text-right">
    <button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
  </div>
</div>
