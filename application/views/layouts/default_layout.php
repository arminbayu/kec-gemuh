<?php
$template_path = getcwd().'/themes/';
include($template_path.'header.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
	<?php include($template_path.'menu.php'); ?>
	<?php include($template_path.'sidebar.php'); ?>
    <div class="content-wrapper">
			<?php echo $contents;?>
    </div>
		<div class="modal fade" id="modal-default">
	    <div class="modal-dialog">
				<div class="modal-content">
				</div>
	    </div>
	  </div>
	<?php include($template_path.'footer.php'); ?>
	</div>
</body>
</html>
