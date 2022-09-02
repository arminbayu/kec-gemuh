<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Pengajuan Pencairan</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/bootstrap/css/bootstrap.min.css">
    <style>
      .form-horizontal .control-label {
        text-align: center;
      }
      @media (min-width:720px){
        .center {
          margin: auto;
          width: 400px;
        }
      }
      .table>tbody>tr>td, .table>tfoot>tr>td {
        border-top: 1px solid #f4f4f4;
      }
    </style>
  </head>
  <body>
    <div class="panel panel-default center" id="panel_user">
      <div class="panel-body">
        <table class="table">
          <tr>
            <td colspan="3"><?php echo !empty($img) ? $img : '-' ?></td>
          </tr>
          <tr>
            <td colspan="3" style="text-align: left;"><h3>Detail Pengajuan</h3></td>
          </tr>
          <tr style="height:40px;">
            <td>Atas Nama</td>
            <td>:</td>
            <td><strong><?php echo $rekening->atas_nama_user ?></strong></td>
          </tr>
          <tr style="height:40px;">
            <td>Bank</td>
            <td>:</td>
            <td><strong><?php echo $bank ?></strong></td>
          </tr>
          <tr style="height:40px;">
            <td>No Rekening</td>
            <td>:</td>
            <td><strong><?php echo $rekening->nomor_rekening_user ?></strong></td>
          </tr>
          <tr style="height:40px;">
            <td>Nominal</td>
            <td>:</td>
            <td><strong><?php echo $nominal ?></strong></td>
          </tr>
          <tr style="height:40px;">
            <td>Waktu Pengajuan</td>
            <td>:</td>
            <td><strong><?php echo $created_on ?></strong></td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>
