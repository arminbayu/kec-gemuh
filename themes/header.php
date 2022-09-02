<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/plugins/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/plugins/select2/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/plugins/noty/noty.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/plugins/fancy/jquery.fancybox.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/plugins/bootstrap-taginput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/assets/css/styles.css" />
    <script src = "<?php echo base_url();?>themes/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src = "<?php echo base_url();?>themes/plugins/jQuery/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/js/jquery.redirect.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/fastclick/fastclick.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/jquery-loading/loadingoverlay.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/dist/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/js/mustache.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/js/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/noty/noty.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/fancy/jquery.fancybox.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/bootstrap-taginput/bootstrap-tagsinput.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/knob/jquery.knob.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/flot/jquery.flot.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/dist/js/jquery.sparkline.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/parsley/indonesia.js"></script>
    <script src="<?php echo base_url(); ?>themes/plugins/parsley/parsley.js"></script>
    <style>
    body, table {
      font-size: 14px;
    }
    .dataTables_filter {
      margin-top:10px;
    }
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
    .form-horizontal .control-label {
      text-align: left;
    }
    .panel-heading h3 {
      margin: 0;
    }
    div#table_transaksi_length {
      width: 30%;
      position: absolute;
      left: 8%;
    }
    .header-tab {
      background-color: #e6e6e6;
    }
    .header-tab td {
      padding: 0px 10px !important;
    }
    .table .panel-default {
      border-color : transparent;
    }
    .skin-blue .main-header .navbar .sidebar-toggle:hover, .skin-blue .main-header .logo:hover {
      background-color: #b70000;
    }
    </style>

  </head>
