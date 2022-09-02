<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">MENU UTAMA</li>
      <?php $uri = $this->uri->segment(1); ?>
      <li class="<?php echo ($uri == 'home') ? 'active' : ''?>"><a href="<?php echo base_url('home')?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li class="<?php echo ($uri == 'list_user') ? 'active' : ''?>"><a href="<?php echo base_url('list_user')?>"><i class="fa fa-users"></i> <span>List User</span><small class="label label-danger pull-right" id="count_user">0</small></a></li>
      <li class="<?php echo ($uri == 'layanan_plus') ? 'active' : ''?>"><a href="<?php echo base_url('layanan_plus')?>"><i class="fa fa-user-plus"></i> <span>Layanan Plus</span></a></li>
      <li class="<?php echo ($uri == 'rekomendasi_poin') ? 'active' : ''?>"><a href="<?php echo base_url('rekomendasi_poin')?>"><i class="fa fa-list-alt"></i> <span>Rekomendasi Poin</span><small class="label label-danger pull-right" id="count_rekomen_poin">0</small></a></li>
      <a href="<?php echo base_url('login/logout')?>" class="btn btn-default btn-flat">Sign out</a>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
