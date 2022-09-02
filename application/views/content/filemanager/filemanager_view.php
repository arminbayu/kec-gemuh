<script>
  var base = '<?php echo base_url('themes/adminopeo/plugins/el/');?>';
</script>
<script data-main="<?php echo base_url('themes/adminopeo/plugins/el/main.default.js');?>" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.5/require.min.js"></script>
<script>
  define('elFinderConfig', {
    defaultOpts       : {
      url             : base+'php/connector.minimal.php',
      commandsOptions : {
        edit : {
          extraOptions          : {
            creativeCloudApiKey : '',
            managerUrl          : ''
          }
        },
        quicklook : {
          sharecadMimes : ['image/vnd.dwg', 'image/vnd.dxf', 'model/vnd.dwf', 'application/vnd.hp-hpgl', 'application/plt', 'application/step', 'model/iges', 'application/vnd.ms-pki.stl', 'application/sat', 'image/cgm', 'application/x-msmetafile'],
          googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/postscript', 'application/rtf'],
          officeOnlineMimes : ['application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation']
        }
      },
      bootCallback : function(fm, extraObj) {},
      height: 700,
      resizable : false,
    },
    managers : {
      'elfinder': {}
    }
  });
</script>
<style>
  .elfinder {
    position: relative;
    border:0 !important;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de !important;
    margin-bottom: 20px;
    width: 100% !important;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
  }
  .ui-widget-header{
    display: block;
    padding: 10px !important;
    position: relative;
    font-weight: normal;
    border: 0;
    border-bottom: 1px solid #d2d6de;
    background: #fff;
    color: #222222;
  }
  .ui-widget.ui-widget-content {
    border: 1px solid #d2d6de;
  }
  .elfinder .elfinder-navbar {
    background: #fafafa;
  }

  .ui-state-default, .ui-widget-content .ui-state-default{
    border-right: 1px solid #d2d6de;
  }
  .elfinder-statusbar {
    display: flex !important;
    border-top: 1px solid #d2d6de;
  }
  .elfinder-ltr .elfinder-cwd-view-icons .elfinder-cwd-file {
    float: left;
    margin: 2px 3px 2px 2px;
  }

  .std42-dialog .ui-dialog-titlebar .elfinder-titlebar-button {
    padding: 1px !important;
  }
  .ui-icon-closethick {
    background-position: -97px -129px;
  }
  .ui-icon-minusthick {
    background-position: -64px -129px;
  }
</style>

<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div id="elfinder"></div>
  <div>
</div>
</section>
