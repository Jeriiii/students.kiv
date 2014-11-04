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
						<?php if (empty($active)) $active = "" ?>
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
		<!-- Place inside the <head> of your HTML -->
		<script type="text/javascript" src="<?php echo $basePath ?>/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea",
				theme: "modern",
				height: 300,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				content_css: "css/content.css",
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
				style_formats: [
					{title: 'Nadpis 1', block: 'h1'},
					{title: 'Nadpis 2', block: 'h2'},
					{title: 'Nadpis 3', block: 'h3'}
				]
			});
		</script>
	</body>
</html>
