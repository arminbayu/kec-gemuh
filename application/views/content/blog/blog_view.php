<?php $uri3 = (!empty($this->input->get('type'))) ? $this->input->get('type') : '';?>
<style media="screen">
.cut-text {
  text-overflow: ellipsis;
  overflow: hidden;
  width: 300px;
  white-space: nowrap;
}
.text-mute{
  color : #c3c3c3;
}
</style>
<section class="content">
      <div class="row">
        <div class="col-md-2">
          <a href="<?php echo base_url('blog/blogging')?>" class="btn btn-primary btn-block margin-bottom">Mulai Ngeblog</a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Kategori</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <?php
                    if (!empty($kategori)) {
                      foreach ($kategori as $key => $k) {
                        if (!empty($uri3)) {
                          echo '<li class="'.(($uri3 == $k->blog_kategori_id) ? 'active' : '').'" ><a href="'.base_url('blog?type='.$k->blog_kategori_id).'">'.$k->nama_kategori.'</a></li>';
                        }else {
                          if ($key == 0) {
                            echo '<li class="active" ><a href="'.base_url('blog?type='.$k->blog_kategori_id).'">'.$k->nama_kategori.'</a></li>';
                          }else {
                            echo '<li class="" ><a href="'.base_url('blog?type='.$k->blog_kategori_id).'">'.$k->nama_kategori.'</a></li>';
                          }
                        }
                      }
                    }
                 ?>
                <!-- <li class="<?php //echo (empty($uri3) || $uri3 == 'semua') ? 'active' : ''?>" ><a href="<?php echo base_url('list_email?type=semua');?>"><i class="fa fa-envelope-o text-primary"></i> Semua <span class="label label-primary pull-right count_mail_all">0</span> </a></li>
                <li class="<?php //echo ($uri3 == 'terkirim') ? 'active' : ''?>" ><a href="<?php echo base_url('list_email?type=terkirim');?>"><i class="fa fa-file-text text-success"></i> Terkirim <span class="label label-success pull-right count_mail_terkirim">0</span></a></li>
                <li class="<?php //echo ($uri3 == 'tertunda') ? 'active' : ''?>" ><a href="<?php echo base_url('list_email?type=tertunda');?>"><i class="fa fa-file-text-o text-danger"></i> Tertunda <span class="label label-danger pull-right count_mail_tertunda">0</span></a></li> -->
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-10">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">List Artikel</h3>
            </div>
            <div class="box-body">
              <div class="mailbox-messages">
                <table id="table_blog" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kategori</th>
                      <th width="1%">Judul</th>
                      <th>Isi</th>
                      <th>Publis On</th>
                      <th>Created On</th>
                      <th>View</th>
                      <th>#</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>

<script type="text/javascript">
var table_blog =  $('#table_blog').DataTable({
  "processing": true,
  "serverSide": true,
    ajax : {
      url   : '<?php echo base_url('blog/get_data')?>',
      type  : 'POST',
      data : {
        'type' : '<?php echo $uri3;?>'
      },
      beforeSend:function() {
        $('#table_blog').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_blog").LoadingOverlay("hide", true);
      },
    },
    columns: [
      { data: 'no' },
      { data: 'nama_kategori' },
      { data: 'judul' },
      { data: 'isi' },
      { data: 'publish_on' },
      { data: 'created_on' },
      { data: 'view' },
      { data: 'aksi' },
    ],
    'columnDefs': [
      { 'orderable': false, 'targets': 0 },
      { 'orderable': false, 'targets': 6 }
    ]
  });

  function detail_email(id) {
    // var data = [];
    //     data['id'] = id;
    // $.redirect('<?php echo base_url('list_email/detail_email');?>', data);
  }

  function detail_email_admin(id) {
    // var data = [];
    //     data['id'] = id;
    // $.redirect('<?php echo base_url('list_email/detail_email_admin');?>', data);
  }
</script>

<script>
  $(document).ready(function () {
    // $.ajax({
    //   url  : '<?php echo base_url('list_email/get_count_all_mail')?>',
    //   data : {
    //
    //   },
    //   beforeSend:function() {
    //     $('.count_mail_all').LoadingOverlay("show");
    //     $('.count_mail_terkirim').LoadingOverlay("show");
    //     $('.count_mail_tertunda').LoadingOverlay("show");
    //   },
    //   complete:function() {
    //     $(".count_mail_all").LoadingOverlay("hide", true);
    //     $(".count_mail_terkirim").LoadingOverlay("hide", true);
    //     $(".count_mail_tertunda").LoadingOverlay("hide", true);
    //   },
    //   type: 'POST',
    //   dataType : 'jSON',
    //   success : function (r) {
    //     $('.count_mail_all').html(r.semua);
    //     $('.count_mail_terkirim').html(r.terkirim);
    //     $('.count_mail_tertunda').html(r.tertunda);
    //   }
    // });
  });
</script>
