<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>

<section class="content">
  <div class="row">
    <div class="box">

      <div class="box-header">
        <div class="pull-left" style="margin-bottom:5px;" hidden>
          <div class="input-group input-group-sm" style="width: 300px;" id="filter1">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo date('d/m/Y')?>" readonly>
            </div>
          </div>

        </div>
        <div class="pull-left" style="margin-left:10px;">
          <div class="input-group input-group-sm">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-filter"></i>
              </div>
              <select class="form-control" id="provinsi_select">
                <option value="0">-- Filter Provinsi --</option>
                <option value="0">Semua</option>
                 <?php
                   if(!empty($provinsi)) {
                     foreach ($provinsi as $key => $value) {
                       echo '<option value="'.$value->propinsi.'">'.$value->nama.'</option>';
                     }
                   }
                  ?>
              </select>
            </div>
          </div>
        </div>

      </div>

      <div class="box-body">
        <div class="col-lg-4 col-xs-6">

          <div class="panel panel-default" id_panel="panel_user">
            <div class="panel-heading bg-green">
              <a href="<?php echo base_url('list_user');?>" class="small-box-footer pull-right" style="color:#fff;font-size:18px;">More info <i class="fa fa-arrow-circle-right"></i></a>
              <h3 style="margin:0">Statistics User</h3>
            </div>
            <div class="panel-body" style="height: 650px;">
              <table class="table">
                <tr>
                  <td style="width:200px">Info</td>
                  <td style="width:10px">:</td>
                  <td><strong id_lokasi="lokasi">Seluruh Indonesia</strong></td>
                </tr>
                <tr class="header-tab">
                  <td colspan="3"><strong>Status User</strong></td>
                </tr>
                <tr>
                  <td>Total User</td>
                  <td>:</td>
                  <td><strong id="u_total_user"></strong></td>
                </tr>
                <tr>
                  <td>Aktif</td>
                  <td>:</td>
                  <td><strong id="u_aktif"></strong></td>
                </tr>
                <tr>
                  <td>Suspend</td>
                  <td>:</td>
                  <td><strong id="u_suspend"></strong></td>
                </tr>
                <tr>
                  <td>Tidak Aktif</td>
                  <td>:</td>
                  <td><strong id="u_tidak_aktif"></strong></td>
                </tr>
                <tr>
                  <td>Deleted</td>
                  <td>:</td>
                  <td><strong id="u_deleted"></strong></td>
                </tr>

                <tr class="header-tab">
                  <td colspan="3"><strong>Verifikasi</strong></td>
                </tr>
                <tr>
                  <td>Pending</td>
                  <td>:</td>
                  <td><strong id="u_pending"></strong></td>
                </tr>
                <tr>
                  <td>Menunggu</td>
                  <td>:</td>
                  <td><strong id="u_menunggu"></strong></td>
                </tr>
                <tr>
                  <td>Verifikasi</td>
                  <td>:</td>
                  <td><strong id="u_verifikasi"></strong></td>
                </tr>

                <tr class="header-tab">
                  <td colspan="3"><strong>Posting Produk</strong></td>
                </tr>
                <tr>
                  <td>User Sudah Post</td>
                  <td>:</td>
                  <td><strong id="u_sudah"></strong></td>
                </tr>
                <tr>
                  <td>User Belum Post</td>
                  <td>:</td>
                  <td><strong id="u_belum"></strong></td>
                </tr>
                <tr>
                  <td>User Dengan Produk Aktif</td>
                  <td>:</td>
                  <td><strong id="u_produk_aktif"></strong></td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">

          <div class="panel panel-default" id_panel="panel_user">
            <div class="panel-heading bg-aqua">
              <a href="<?php echo base_url('list_produk');?>" class="small-box-footer pull-right" style="color:#fff;font-size:18px;">More info <i class="fa fa-arrow-circle-right"></i></a>
              <h3 style="margin:0">Statistics Produk</h3>
            </div>
            <div class="panel-body" style="height: 650px;">
              <table class="table">
                <tr>
                  <td style="width:200px">Info</td>
                  <td style="width:10px">:</td>
                  <td><strong id_lokasi="lokasi">Seluruh Indonesia</strong></td>
                </tr>
                <tr class="header-tab">
                  <td colspan="3"><strong>Rekap Post Produk</strong></td>
                </tr>
                <tr>
                  <td>Total Produk</td>
                  <td>:</td>
                  <td><strong id="p_total_produk"></strong></td>
                </tr>
                <tr>
                  <td>Aktif</td>
                  <td>:</td>
                  <td><strong id="p_aktif"></strong></td>
                </tr>
                <tr>
                  <td>Tidak Aktif</td>
                  <td>:</td>
                  <td><strong id="p_tidak_aktif"></strong></td>
                </tr>
                <tr>
                  <td>Deleted</td>
                  <td>:</td>
                  <td><strong id="p_deleted"></strong></td>
                </tr>
                <tr class="header-tab">
                  <td colspan="3"><strong>Rekap Produk Varian</strong></td>
                </tr>
                <tr>
                  <td>Total Varian</td>
                  <td>:</td>
                  <td><strong id="p_total_varian"></strong></td>
                </tr>
                <tr>
                  <td>Produk Dengan Varian</td>
                  <td>:</td>
                  <td><strong id="p_ada_varian"></strong></td>
                </tr>
                <tr>
                  <td>Produk Tanpa Varian</td>
                  <td>:</td>
                  <td><strong id="p_tanpa_varian"></strong></td>
                </tr>
                <tr>
                  <td>Total Produk + Varian</td>
                  <td>:</td>
                  <td><strong id="p_total_produk_varian"></strong></td>
                </tr>

                <tr class="header-tab">
                  <td colspan="3"><strong>Rekap Produk User Aktif</strong></td>
                </tr>
                <tr>
                  <td>Aktif</td>
                  <td>:</td>
                  <td><strong id="ua_produk_aktif"></strong></td>
                </tr>
                <tr>
                  <td>Tidak Aktif & Deleted</td>
                  <td>:</td>
                  <td><strong id="ua_tidak_aktif"></strong></td>
                </tr>

                <tr class="header-tab">
                  <td colspan="3"><strong>Rekap Produk User Suspend</strong></td>
                </tr>
                <tr>
                  <td>Aktif</td>
                  <td>:</td>
                  <td><strong id="us_produk_aktif"></strong></td>
                </tr>
                <tr>
                  <td>Tidak Aktif & Deleted</td>
                  <td>:</td>
                  <td><strong id="us_tidak_aktif"></strong></td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6" id_panel="panel_user">
          <div class="panel panel-default" id_panel="panel_user">
            <div class="panel-heading bg-yellow">
              <a href="<?php echo base_url('list_transaksi');?>" class="small-box-footer pull-right" style="color:#fff;font-size:18px;">More info <i class="fa fa-arrow-circle-right"></i></a>
              <h3 style="margin:0">Statistics Transaksi</h3>
            </div>
            <div class="panel-body" style="height: 650px;">
              <table class="table">
                <tr>
                  <td style="width:200px">Info</td>
                  <td style="width:10px">:</td>
                  <td><strong id_lokasi="lokasi">Seluruh Indonesia</strong></td>
                </tr>
                <tr class="header-tab">
                  <td colspan="4"><strong>Rekap Transaksi</strong></td>
                </tr>
                <tr>
                  <td>Total Transaksi</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_total_transaksi"></strong></td>
                </tr>
                <tr>
                  <td>Dalam Keranjang</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_keranjang"></strong></td>
                </tr>
                <tr>
                  <td>Transaksi Selesai</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_selesai"></strong></td>
                </tr>
                <tr>
                  <td>Menunggu</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_menunggu"></strong></td>
                </tr>
                <tr>
                  <td>Dibayar</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_dibayar"></strong></td>
                </tr>
                <tr>
                  <td>Proses</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_proses"></strong></td>
                </tr>
                <tr>
                  <td>Transaksi Batal</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_batal"></strong></td>
                </tr>
                <tr class="header-tab">
                  <td colspan="4"><strong>Total Transaksi Berdasarkan Pembayaran</strong></td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><strong>Selesai</strong></td>
                  <td><strong>Gagal</strong></td>
                </tr>
                <tr>
                  <td>Transfer Manual</td>
                  <td>:</td>
                  <td id="t_s_manual"></td>
                  <td id="t_b_manual"></td>
                </tr>
                <tr>
                  <td>Pembayaran Digital</td>
                  <td>:</td>
                  <td id="t_s_digital"></td>
                  <td id="t_b_digital"></td>
                </tr>
                <tr>
                  <td>Bayar Ditempat</td>
                  <td>:</td>
                  <td id="t_s_cod"></td>
                  <td id="t_b_cod"></td>
                </tr>
                <tr>
                  <td>Vitual Account</td>
                  <td>:</td>
                  <td id="t_s_virtual"></td>
                  <td id="t_b_virtual"></td>
                </tr>
                <tr class="header-tab">
                  <td colspan="4"><strong>Alasan Transaksi Gagal</strong></td>
                </tr>
                <tr>
                  <td>Tidak Diproses Penjual</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_a_tidak_diproses"></strong></td>
                </tr>
                <tr>
                  <td>Pesanan Belum Dibayar</td>
                  <td>:</td>
                  <td colspan="2"><strong id="t_a_tidak_dibayar"></strong></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</section>

<input type="hidden" id="tgl" value="00/00/0000 - 31/12/9999">
<input type="hidden" id="fiter_provinsi" value="0">

<script type="text/javascript">
  $(document).ready(function () {
    getData();
  });

  $('#provinsi_select').change(function () {
    $('#fiter_provinsi').val($(this).val());
    var loc = $(this).find('option:selected').text();
    if (loc == 'Semua' || loc == '-- Filter Provinsi --') {
      loc = 'Seluruh Indonesia';
    }
    $("[id_lokasi=lokasi]").html(loc);
    getData();
  });

  $('#datepicker').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  });

  $('#datepicker').change(function () {
    $('#tgl').val($(this).val());
    getData();
  });

  function getData() {
    $.ajax({
      url : '<?php echo base_url('statistics/get_data_total');?>',
      data  : {
        'tgl'     : $('#tgl').val(),
        'prov'    : "AND user.location_dump LIKE '%{\"provinsi\":\""+$('#fiter_provinsi').val()+"\"%'",
        'prov_if' : $('#fiter_provinsi').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        $('[id_panel=panel_user]').LoadingOverlay("show");
      },
      complete:function() {
        $('[id_panel=panel_user]').LoadingOverlay("hide", true);
      },
      success : function (r) {
        $('#u_total_user').html(r.u_total_user);
        $('#u_aktif').html(r.user_aktif);
        $('#u_suspend').html(r.user_suspend);
        $('#u_tidak_aktif').html(r.user_tidak_aktif);
        $('#u_deleted').html(r.user_deleted);
        $('#u_pending').html(r.user_pending);
        $('#u_menunggu').html(r.user_menunggu);
        $('#u_verifikasi').html(r.user_verifikasi);
        $('#u_sudah').html(r.user_sudah_post);
        $('#u_belum').html(r.user_belum_post);
        $('#u_produk_aktif').html(r.user_produk_aktif);

        //produk
        $('#ua_produk_aktif').html(r.ua_produk_aktif);
        $('#ua_tidak_aktif').html(r.ua_tidak_aktif);
        $('#us_produk_aktif').html(r.us_produk_aktif);
        $('#us_tidak_aktif').html(r.us_tidak_aktif);
        $('#p_total_produk').html(r.p_total_produk);
        $('#p_aktif').html(r.p_aktif);
        $('#p_tidak_aktif').html(r.p_tidak_aktif);
        $('#p_deleted').html(r.p_deleted);
        $('#p_total_varian').html(r.p_total_varian);
        $('#p_ada_varian').html(r.p_ada_varian);
        $('#p_tanpa_varian').html(r.p_tanpa_varian);
        $('#p_total_produk_varian').html(r.p_total_produk_varian);

        //transaksi
        $('#t_total_transaksi').html(r.t_total_transaksi);
        $('#t_keranjang').html(r.t_keranjang);
        $('#t_selesai').html(r.t_selesai);
        $('#t_menunggu').html(r.t_menunggu);
        $('#t_dibayar').html(r.t_dibayar);
        $('#t_proses').html(r.t_proses);
        $('#t_batal').html(r.t_batal);
        $('#t_s_manual').html(r.t_s_manual);
        $('#t_b_manual').html(r.t_b_manual);
        $('#t_s_digital').html(r.t_s_digital);
        $('#t_b_digital').html(r.t_b_digital);
        $('#t_s_cod').html(r.t_s_cod);
        $('#t_b_cod').html(r.t_b_cod);
        $('#t_s_virtual').html(r.t_s_virtual);
        $('#t_b_virtual').html(r.t_b_virtual);

        $('#t_a_tidak_diproses').html(r.t_a_tidak_diproses);
        $('#t_a_tidak_dibayar').html(r.t_a_tidak_dibayar);
      }
    });
  }

</script>
