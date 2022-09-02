<style>
.form-horizontal .control-label {
  text-align: left;
}
</style>

<div class="panel panel-default" id="panel_user">
  <div class="panel-heading">
    <h3 style="margin:0">Detail Promo</h3>
  </div>
  <div class="panel-body">
    <table class="table">

      <tr class="header-tab">
        <td colspan="3"><h4>User</h4></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td><strong><?php echo !empty($user[0]->nama) ? $user[0]->nama : '-' ?></strong></td>
      </tr>
      <tr>
        <td>No HP/WA</td>
        <td>:</td>
        <td><strong><?php echo !empty($user[0]->notelp) ? $user[0]->notelp : '-' ?></strong></td>
      </tr>

      <tr class="header-tab">
        <td colspan="2"><h4>Promo</h4></td>
        <td class="text-right"><h4><?php echo !empty($promo->jenis_promo_f) ? $promo->jenis_promo_f : '-' ?></h4></td>
      </tr>
      <tr>
        <td>Kode Promo</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->kode_promo) ? $promo->kode_promo : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Persentase Promo</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->persen) ? $promo->persen.'%' : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Nominal</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->nominal_promo_f) ? $promo->nominal_promo_f : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Tanggal Berlaku</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->tanggal_mulai_f) ? $promo->tanggal_mulai_f.' - '.$promo->tanggal_selesai_f : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Tanggal Post</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->created_on) ? $promo->created_on : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Minimal QTY</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->minimal_qty) ? $promo->minimal_qty : 'Bebas' ?></strong></td>
      </tr>
      <tr>
        <td>Minimal Harga</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->minimal_harga_f) ? $promo->minimal_harga_f : 'Bebas' ?></strong></td>
      </tr>
      <tr>
        <td>Kuota Promo</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->kuota) ? $promo->kuota.' Transaksi' : 'Tidak Terbatas' ?></strong></td>
      </tr>
      <tr>
        <td>Kuota Harian</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->kuota_harian) ? $promo->kuota_harian.' transaksi per user' : '' ?></strong></td>
      </tr>
      <tr>
        <td>Berlaku ke semua produk</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->is_all_f) ? $promo->is_all_f : '-' ?></strong></td>
      </tr>
      <tr data-id="tr_hidden" hidden>
        <td colspan="3">Terdapat <strong><?php echo count($promo_produk)?></strong> produk yang menggunakan promo ini : </td>
      </tr>
      <tr data-id="tr_hidden" hidden>
        <td colspan="3" style="padding:0">
          <table id="table_promo_modal" class="table table-bordered table-striped" style="margin-bottom:0">
            <thead class="thead-bawah">
              <tr>
                <th style="width:5%">No</th>
                <th style="width:45%">Nama Produk</th>
                <th style="width:50%">Merk Produk</th>
              </tr>
            </thead>
          </table>
        </td>
      </tr>
      <tr data-id="tr_hidden" hidden>
        <td colspan="3" style="padding:0">
          <div style="max-height: 200px;overflow-y: scroll">
            <table id="table_promo_modal" class="table table-bordered table-striped ">
              <tbody class="tbody-bawah">
               <?php
                 if(!empty($promo_produk)) {
                   foreach ($promo_produk as $key => $value) {
                     foreach ($value->produk as $k => $v) {
                       echo '<tr role="row" class="odd">
                               <td style="width:5%" class="sorting_1">'.($key+1).'</td>
                               <td style="width:45%" class="sorting_1">'.$v->nama_produk.'</td>
                               <td style="width:50%" class="sorting_1">'.$v->merk_produk.'</td>
                             <tr>';
                     }
                   }
                 }
                ?>
              </tbody>
            </table>
          </div>
        </td>
      </tr>


      <tr>
        <td>Berlaku ke semua pembayaran</td>
        <td>:</td>
        <td><strong><?php echo !empty($promo->is_all_pembayaran_f) ? $promo->is_all_pembayaran_f : '-' ?></strong></td>
      </tr>
      <tr data-id="tr_pembayaran_hidden" hidden>
        <td colspan="3">Terdapat <strong><?php echo count($pembayaran)?></strong> pembayaran yang menggunakan promo ini : </td>
      </tr>
      <tr data-id="tr_pembayaran_hidden" hidden>
        <td colspan="3" style="padding:0">
          <table id="table_promo_modal" class="table table-bordered table-striped" style="margin-bottom:0">
            <thead class="thead-bawah">
              <tr>
                <th style="width:5%">No</th>
                <th style="width:95%">Pembayaran</th>
              </tr>
            </thead>
          </table>
        </td>
      </tr>
      <tr data-id="tr_pembayaran_hidden" hidden>
        <td colspan="3" style="padding:0">
          <div style="max-height: 200px;overflow-y: scroll">
            <table id="table_promo_modal" class="table table-bordered table-striped ">
              <tbody class="tbody-bawah">
               <?php
                 if(!empty($pembayaran)) {
                   // foreach ($pembayaran as $key => $value) {
                     foreach ($pembayaran as $k => $v) {
                       echo '<tr role="row" class="odd">
                               <td style="width:5%" class="sorting_1">'.($k+1).'</td>
                               <td style="width:45%" class="sorting_1">'.$v->jenis_pembayaran.'</td>
                             <tr>';
                     }
                   // }
                 }
                ?>
              </tbody>
            </table>
          </div>
        </td>
      </tr>


    </table>
  </div>
  <div class="panel-footer text-right">
    <button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function() {
    if ('<?php echo $promo->is_all_f ?>' == 'Tidak') {
      $('[data-id="tr_hidden"]').show();
    }
    if ('<?php echo $promo->is_all_pembayaran_f ?>' == 'Tidak') {
      $('[data-id="tr_pembayaran_hidden"]').show();
    }
  });
</script>
