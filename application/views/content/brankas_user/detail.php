<div>
  <div class="modal-header">
    <h5 class="modal-title">Detail Brankas</h5>
  </div>
  <div class="modal-body">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">Rp</span>

            <div class="info-box-content">
              <span class="info-box-text">Saldo OpeoPay</span>
              <span class="info-box-number"><?php echo $user->saldo_f ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red">Rp</span>

            <div class="info-box-content">
              <span class="info-box-text">Saldo Penghasilan</span>
              <span class="info-box-number"><?php echo $user->saldo_penghasilan_f ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
    <table class="table table_history">
      <thead>
        <th>No</th>
        <th>Transaksi</th>
        <th class="text-right">Nominal</th>
        <th>Keterangan</th>
        <th>Pada</th>
      </thead>
      <tbody>
        <?php if ($data): ?>
          <?php foreach ($data as $key => $value): ?>
            <tr>
              <td><?php echo $value->no ?></td>
              <td><span class="text-<?php echo ($value->kode_transaksi_brankas == 'T01' || $value->kode_transaksi_brankas == 'T02' || $value->kode_transaksi_brankas == 'T03' || $value->kode_transaksi_brankas == 'N01' || $value->kode_transaksi_brankas == 'N03' ? 'success' : 'danger') ?>"><?php echo $value->jenis_trs ?></span></td>
              <td class="text-right"><?php echo ($value->kode_transaksi_brankas == 'T01' || $value->kode_transaksi_brankas == 'T02' || $value->kode_transaksi_brankas == 'T03' || $value->kode_transaksi_brankas == 'N01' || $value->kode_transaksi_brankas == 'N03' ? '+' : '-').$value->nominal ?></td>
              <td title="<?php echo $value->info_trs ?>"><?php echo $value->info_trs_sm ?></td>
              <td><?php echo $value->created_on ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
<script type="text/javascript">
  $('.table_history').DataTable();
</script>
