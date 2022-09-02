
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon"
		href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/598px-WhatsApp.svg.png"
		type="image/x-icon" />
	<script>
		WebFontConfig = {
			google: {
				families: ['Roboto:300,400,700']
			}
		};

		(function(d) {
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);
	</script>

    
  <?php 
    include($_SERVER['DOCUMENT_ROOT']."/PHP/kecamatan-geru/themes/header.php");
  ?>
</head>

<body class="login">
	<div>
		<div style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
			<div class="container container-login container-transparent animated fadeIn bg-white" style="border:
				ridge;padding:30px;width:500px;border-radius:10px;">

				<h1 class="text-center fw-bold">Sign In</h1>
				<h3 class="text-center fw-bold">Dashboard Whatsapp API</h3>
        <br>
				<div class="login-form">
					<form action="/auth" method="POST">
						<div class="form-group">
							<label for="password"
								class="placeholder"><b>E-Mail</b></label>
							<input type="text" class="form-control" name="email"
								placeholder="E-Mail">
						</div>
						<div class="form-group">
							<label for="password"
								class="placeholder"><b>Password</b></label>
							<input type="password" class="form-control" name="password"
								placeholder="Password">
						</div>
						<div class="form-group">
							<label for="password"
								class="placeholder"><b>Gambar</b></label>
							<input type="file" class="form-control" name="password"
								placeholder="Password">
						</div>
						<div class="form-group form-action-d-flex mb-3">
							<button type="submit"
								class="btn btn-primary col-md-12 float-right mt-3 mt-sm-0 fw-bold">Ajukan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>