<link href="https://showus.biz/themes/superuser/plugins/bootstrap-wysihtml5/richtext.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/typehead/css.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datetimepicker/bootstrap-datetimepicker.css" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datetimepicker/bootstrap-datetimepicker.js"></script>
<script src="https://showus.biz/themes/superuser/plugins/bootstrap-wysihtml5/jquery.richtext.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/jquery.fileupload.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/fileupload/upload_image.js"></script>
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/typehead/typeahead.bundle.min.js"></script>
<style>
  .select2-dropdown .select2-search__field:focus, .select2-search--inline .select2-search__field:focus {
    outline: none;
    border: 1px solid transparent;
  }
  .bootstrap-tagsinput {
    border-radius: 0px;
  }
  .mailbox-attachment-name {
      font-weight: bold;
      color: #666;
      font-size: 12px;
      word-wrap: break-word;
  }
  .richText .richText-toolbar ul li a {
    color : #333333;
  }
</style>

<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="form-group">
          <ul class="mailbox-attachments clearfix">
            <li style="float: left;width: 100%; border: 1px solid #eee; margin-bottom: 0; margin-right: 0;">
              <div class="mailbox-attachment-icon <?php echo (!empty($blog) ? 'has-img' : '')?>" id="preview">
                <?php
                    if (!empty($blog)) {
                      echo '<img src="'.URL_UPLOAD.'/blog/'.$blog->gambar.'" class="img-responsive">';
                    }else {
                      echo '<i class="fa fa-file"></i>';
                    }
                 ?>
              </div>
              <div class="mailbox-attachment-info">
                <div id="progress" class="progress" hidden>
                  <div class="progress-bar progress-bar-success"></div>
                </div>
                <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <span id="name_file" ><?php echo (!empty($blog) ? $blog->gambar : '')?></span> </a>
                    <span class="mailbox-attachment-size">
                      <span id="mail_attachment_size"><?php echo (!empty($blog) ? number_format(filesize(DIR_UPLOAD.'/blog/'.$blog->gambar) / 1024, 2).' Kb' : '')?></span>
                      <form>
                        <div class="form-group">
                          <label>Alt Image</label>
                          <input id="nama_file" type="text" name="nama_file" class="form-control">
                        </div>
                        <div hidden>
                            <input id="fileupload" type="file" name="files" data-url="<?php echo base_url('blog/upload_cover')?>" >
                        </div>
                      </form>
                      <a href="javascript:void(0);" class="btn btn-default btn-xs pull-right btn_upload" style="margin-bottom:2px;"><i class="fa fa-cloud-upload"></i></a>
                    </span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Artikel Baru</h3>
        </div>
        <form action="<?php echo base_url('blog/simpan');?>" method="post">
        <div class="box-body">
            <div class="form-group">
              <label>Kategori</label>
              <select class="form-control" name="kategori">
                <option value="">- Pilih Kategori -</option>
                <?php
                    $blog_kategori_id = (!empty($blog)) ? $blog->blog_kategori_id : '';
                    if (!empty($kategori)) {
                      foreach ($kategori as $key => $kt) {
                        if ($kt->blog_kategori_id == $blog_kategori_id) {
                          echo '<option value="'.$blog_kategori_id.'" selected>'.$kt->nama_kategori.'</option>';
                        }else {
                          echo '<option value="'.$kt->blog_kategori_id.'">'.$kt->nama_kategori.'</option>';
                        }
                      }
                    }
                 ?>
              </select>
            </div>
            <div class="form-group">
              <label>Judul</label>
              <input class="form-control" type="text" name="judul" value="<?php echo (!empty($blog) ? $blog->judul : '')?>" required>
              <input class="form-control" type="hidden" name="blog_id" value="<?php echo (!empty($blog) ? $blog->blog_id : '')?>">
              <input name="file_upload_name" id="file_upload_name" type="hidden"  value="<?php echo (!empty($blog) ? $blog->gambar : '')?>">
            </div>
            <div class="form-group">
              <label>Artikel</label>
              <textarea id="isi" name="isi" class="form-control" required rows="50"><?php echo (!empty($blog) ? $blog->isi : '')?></textarea>
            </div>

            <div class="form-group">
              <label>Tag</label><br>
              <input class="form-control" name="tag" id="tag" data-role="tagsinput" value="<?php echo (!empty($blog) ? $blog->tag : '')?>" required>
            </div>

            <div class="form-group">
              <label>Tanggal Publish</label><br>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="tanggal_publish" name="tanggal_publish" required>
              </div>
            </div>

            <div class="form-group">
              <label>Publish ?</label><br>
              <input class="" type="checkbox" name="publish" <?php echo (!empty($blog) ? (($blog->publish == '1') ? 'checked' : '') : 'checked')?>> Ya <small> <em>(Abaikan untuk simpan ke draft)</em> </small>
            </div>

          </div>
          <div class="box-footer">
            <div class="pull-right">
              <!-- <a class="btn btn-default"><i class="fa fa-pencil"></i> Draft</a> -->
              <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            <a href="<?php echo base_url('blog?type='.$blog_kategori_id)?>" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<script>
  var data1 = Array();
  $(document).ready(function () {
    $('#tanggal_publish').data("DateTimePicker").date('<?php echo (!empty($blog) ? $blog->tanggal_publish : '')?>')
    $('#isi').richText({
      useParagraph: true,
    });
  });

  $('#tanggal_publish').datetimepicker({
      format : 'YYYY-MM-DD HH:mm',
      defaultDate: new Date(),
   });

  $('#tanggal_publish').on('dp.change', function() {
    var dateChange = new Date($(this).val());
    $('[name=publish]').attr('disabled', false);
    $( "[name=publish]" ).prop( "checked", true );
    if (formatDate(dateChange) > formatDate(new Date())) {
      $('[name=publish]').attr('disabled', true);
      $('[name=publish]').attr('checked', false);
    }
  });

  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
  }

 var countries = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  prefetch: {
		url: '<?php echo base_url('blog/get_t');?>',
		filter: function(list) {
		  return $.map(list, function(name) {
			  return { name: name };
      });
		},
    cache :false
	  }
	});
	countries.initialize();

	$('#tag').tagsinput({
	  typeaheadjs: {
		name: 'countries',
		displayKey: 'name',
		valueKey: 'name',
		source: countries.ttAdapter()
	  }
	});

</script>
