<section class="content">
  <div class="row">

    <div class="col-lg-3 col-xs-6" id="total_transaksi_count">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3 id="total_transaksi">0</h3>
          <p>Transaksi</p>
        </div>
        <div class="icon">
          <i class="fa fa-exchange"></i>
        </div>
        <a href="<?php echo base_url('list_transaksi');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6" id="total_produk_count">
      <div class="small-box bg-green">
        <div class="inner">
          <h3 id="total_produk">0</h3>
          <p>Produk</p>
        </div>
        <div class="icon">
          <i class="fa fa-file"></i>
        </div>
        <a href="<?php echo base_url('list_produk');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6" id="total_total_user_count">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3 id="total_user">0</h3>
          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="<?php echo base_url('list_user');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6" id="total_report_count">
      <div class="small-box bg-red">
        <div class="inner">
          <h3 id="total_report">0</h3>
          <p>Report User</p>
        </div>
        <div class="icon">
          <i class="fa fa-line-chart"></i>
        </div>
        <a href="<?php echo base_url('laporan_user') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div>

</section>

<script type="text/javascript">
  $(document).ready(function () {
    console.log("BISAAAAAAAAAAA");
    // $.ajax({
    //   url : '<?php //echo base_url('Adminopeo/get_data_total');?>',
    //   type : 'GET',
    //   dataType : 'jSON',
    //   beforeSend:function() {
    //     $('#total_transaksi_count').LoadingOverlay("show");
    //     $('#total_total_user_count').LoadingOverlay("show");
    //     $('#total_report_count').LoadingOverlay("show");
    //     $('#total_produk_count').LoadingOverlay("show");
    //   },
    //   complete:function() {
    //     $('#total_transaksi_count').LoadingOverlay("hide", true);
    //     $('#total_total_user_count').LoadingOverlay("hide", true);
    //     $('#total_report_count').LoadingOverlay("hide", true);
    //     $('#total_produk_count').LoadingOverlay("hide", true);
    //   },
    //   success : function (r) {
    //     $('#total_transaksi').html(r.transaksi);
    //     $('#total_user').html(r.user);
    //     $('#total_report').html(r.laporan_user);
    //     $('#total_produk').html(r.produk);
    //   }
    // });
  });

</script>
