<div class="panel panel-default" id="panel_transaksi">
  <div class="panel-heading">
    <h3>Detail Invoice</h3>
  </div>
  <div class="panel-body">
    <table class="table">
      <tr class="header-tab">
        <td colspan="2"><h4>Tagihan</h4></td>
        <td class="text-right"><h4><?php echo !empty($tagihan->kode_tagihan) ? $tagihan->kode_tagihan : '-' ?></h4></td>
      </tr>
      <tr>
        <td>Jenis Pembayaran</td>
        <td>:</td>
        <td><strong><?php echo !empty($master_pembayaran->master_pembayaran) ? $master_pembayaran->master_pembayaran : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Pembayaran</td>
        <td>:</td>
        <td><strong><?php echo !empty($jenis_pembayaran->jenis_pembayaran) ? $jenis_pembayaran->jenis_pembayaran : '-' ?></strong></td>
      </tr>
      <?php if ($jenis_pembayaran->jenis_pembayaran_id == '14'): ?>
      <tr>
        <td>Payment Code</td>
        <td>:</td>
        <td><strong><?php echo !empty($tagihan->paymentcode) ? $tagihan->paymentcode : '-' ?></strong></td>
      </tr>
      <?php endif; ?>
      <?php if ($jenis_pembayaran->jenis_pembayaran_id == '14' || $jenis_pembayaran->jenis_pembayaran_id == '16'): ?>
      <tr>
        <td>Status</td>
        <td>:</td>
        <td><strong style="color: #078bff;"><?php echo !empty($tagihan->statustype) ? $tagihan->statustype : '-' ?></strong></td>
      </tr>
      <?php endif; ?>
      <tr>
        <td>Total Harga</td>
        <td>:</td>
        <td><strong><?php echo !empty($transaksi->total_harga) ? $this->all_library->format_harga($transaksi->total_harga,'Rp. ') : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Ongkos Kirim</td>
        <td>:</td>
        <td><strong><?php echo !empty($transaksi->total_ongkir) ? $this->all_library->format_harga($transaksi->total_ongkir,'Rp. ') : 'Gratis Ongkir' ?></strong></td>
      </tr>
      <tr>
        <td>Total Tagihan</td>
        <td>:</td>
        <td><strong><?php echo !empty($tagihan->total_tagihan) ? $this->all_library->format_harga($tagihan->total_tagihan,'Rp. ') : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Kode Unik</td>
        <td>:</td>
        <td><strong><?php echo !empty($tagihan->kode_unik) ? $this->all_library->format_harga($tagihan->kode_unik,'Rp. ') : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Biaya Admin</td>
        <td>:</td>
        <td><strong><?php echo !empty($tagihan->biaya_admin) ? $this->all_library->format_harga($tagihan->biaya_admin,'Rp. ') : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Total Tagihan</td>
        <td>:</td>
        <td><strong><?php echo !empty($tagihan->total_tagihan) ? $this->all_library->format_harga(($tagihan->total_tagihan + $tagihan->kode_unik + $tagihan->biaya_admin),'Rp. ') : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Status Pembayaran</td>
        <td>:</td>
        <td><strong><?php echo !empty($tagihan->status_pembayaran) ? $tagihan->status_pembayaran : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Batas Pembayaran</td>
        <td>:</td>
        <td><strong><?php echo !empty($tagihan->batas_bayar) ? $tagihan->batas_bayar : '-' ?></strong></td>
      </tr>
      <tr>
        <td>Bukti Bayar</td>
        <td>:</td>
        <td><?php echo !empty($tagihan->bukti_bayar) ? $tagihan->gambar_bukti : '-' ?></td>
      </tr>
      <tr>
        <td>Bukti Kirim</td>
        <td>:</td>
        <td><?php echo !empty($tagihan->bukti_kirim) ? $tagihan->gambar_bukti_kirim : '-' ?></td>
      </tr>
      <tr class="header-tab">
        <td colspan="2"><h4>Item Keranjang</h4></td>
        <td class="text-right"><h4><?php echo count($keranjang) ?></h4></td>
      </tr>
      <?php if ($keranjang): ?>
        <?php foreach ($keranjang as $key => $value): ?>
          <tr>
            <td>
              <div class="">
                <?php echo ($value->nama_produk) ? $value->nama_produk : '-' ?> <?php echo ($value->merk_produk) ? $value->merk_produk : '-' ?><br>
                <?php echo ($value->harga) ? $this->all_library->format_harga($value->harga) : '-' ?> x<?php echo ($value->qty) ? $value->qty : '-' ?> <?php echo ($value->satuan) ? $value->satuan : '-' ?>
              </div>
            </td>
            <td>:</td>
            <td><strong><?php echo ($value->qty) ? $this->all_library->format_harga($value->qty * $value->harga) : '-' ?></strong></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </table>
  </div>
  <div class="panel-footer text-right">
    <button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
  </div>
</div>
