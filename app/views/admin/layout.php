<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>Dashboard Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo $basePath ?>/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="<?php echo $basePath ?>/css/dashboard.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Administrace</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="?do=sing-out">Odhlášení</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li <?php if ($active == "pages") echo 'class="active"' ?>>
							<a href="<?php echo $basePath ?>/admin/">Správa stránek</a>
						</li>
						<li <?php if ($active == "admins") echo 'class="active"' ?>>
							<a href="<?php echo $basePath ?>/admin/admins">Správa uživatelů</a>
						</li>
						<li <?php if ($active == "links") echo 'class="active"' ?>>
							<a href="<?php echo $basePath ?>/admin/links">Správa linků</a>
						</li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<div>
						<?php
						foreach ($messages->getAll() as $message) {
							echo "<div class='alert alert-warning' role='alert'>";
							echo $message;
							echo "</div>";
						}
						$messages->clear();
						?>
					</div>
					<?php include_once $includeTemplate; ?>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</body>
</html>
