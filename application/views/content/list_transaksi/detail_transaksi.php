<style media="screen">
  s, strike{text-decoration:none;position:relative;}
  s::before, strike::before {
    top: 50%; /*tweak this to adjust the vertical position if it's off a bit due to your font family */
    background:red; /*this is the color of the line*/
    opacity:.7;
    content: '';
    width: 110%;
    position: absolute;
    height:.1em;
    border-radius:.1em;
    left: -5%;
    white-space:nowrap;
    display: block;
    transform: rotate(-15deg);
  }
  s.straight::before, strike.straight::before{transform: rotate(0deg);left:-1%;width:102%;}
</style>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Detail Transaksi</h3>
          </div>
          <div class="">
            <table class="table">
              <tr class="header-tab">
                <td colspan="2"><h4>Transaksi</h4></td>
                <td class="text-right"><h4><?php echo !empty($transaksi->kode_transaksi) ? $transaksi->kode_transaksi : '-' ?></h4></td>
              </tr>
              <tr>
                <td>Penjual</td>
                <td>:</td>
                <td><strong><?php echo !empty($penjual->nama) ? $penjual->nama : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Pembeli</td>
                <td>:</td>
                <td><strong><?php echo !empty($pembeli->nama) ? $pembeli->nama : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Status Pesanan</td>
                <td>:</td>
                <td><strong><?php echo !empty($transaksi->status_pesanan) ? $transaksi->status_pesanan : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Tanggal Pesanan</td>
                <td>:</td>
                <td><strong><?php echo !empty($transaksi->created_on) ? $this->all_library->datetime($transaksi->created_on) : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Tanggal Perubahan</td>
                <td>:</td>
                <td><strong><?php echo !empty($transaksi->modified_on) ? $this->all_library->datetime($transaksi->modified_on) : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Tanggal Pengiriman</td>
                <td>:</td>
                <td><strong><?php echo !empty($transaksi->tanggal_kirim) ? $this->all_library->datetime($transaksi->tanggal_kirim) : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Pengiriman</td>
                <td>:</td>
                <td><strong><?php echo !empty($transaksi->pengiriman_f) ? $transaksi->pengiriman_f : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Catatan</td>
                <td>:</td>
                <td><strong><?php echo !empty($transaksi->catatan) ? $transaksi->catatan : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Otomatis Sistem</td>
                <td>:</td>
                <td><?php echo !empty($otomatis_sistem) ? $otomatis_sistem : '-' ?></td>
              </tr>
              <tr>
                <td>Alasan Batal</td>
                <td>:</td>
                <td><?php echo !empty($transaksi->alasan_batal) ? $transaksi->alasan_batal : '-' ?></td>
              </tr>

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

                    <?php  if ($value->potongan):  ?>
                      <td><s><?php echo ($value->qty) ? $this->all_library->format_harga($value->qty * $value->harga) : '-' ?></s> <strong><?php echo ($value->qty) ? $this->all_library->format_harga($value->potongan) : '-' ?></strong></td>
                    <?php else: ?>
                      <td><strong><?php echo ($value->qty) ? $this->all_library->format_harga($value->qty * $value->harga) : '-' ?></strong></td>
                    <?php endif; ?>

                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
