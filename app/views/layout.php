<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $tittle . " - " . $page->name ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php echo $basePath ?>/css/layout.css"/>
		<!--[if lt IE 9]>
            <script src="/js/html5shiv.js"></script>
        <![endif]-->
	</head>
	<body>
		<header>
			<div>
				<a class="logo-students" href="#" title="students.kiv">
					<h1>< students.kiv ></h1>
					<span>Informační portál pro studenty</span>
				</a>
				<a class="logo-kiv" href="http://www.kiv.zcu.cz/" title="kiv">
					<img src="img/layout/header_kiv_logo.png" alt="kiv" />
				</a>
				<a class="logo-zcu" href="http://www.zcu.cz/" title="zcu">
					<img src="img/layout/header_uwb_logo.png" alt="kiv" />
				</a>
				<span id="login-container">
					<?php
					if ($user->isLoggedIn()) {
						echo "<a href='$basePath/?do=sign-out' class='login'>Odhlášení</a>";
						if ($user->isAdmin()) {
							echo "<a href='$basePath/admin/' class='login'>Administrace&nbsp;</a>";
						}
					} else {
						echo "<a href='$basePath/prihlaseni' class='login'>Přihlášení</a>";
					}
					?>
				</span>
			</div>
			<div class="vertical-menu"></div>
		</header>
		<section class="main">
			<div class="left-side">
				<h4 class="menu">Menu</h4>
				<nav>
					<?php
					foreach ($pages as $pg) {
						echo "<a href='$basePath/$pg->url'>";
						echo $pg->name;
						echo "</a>";
					}
					?>
				</nav>
				<h4>Užitečné odkazy</h4>
				<div class="link-bar">
					<?php
					foreach ($links as $link) {
						echo "<a href='$link->url'>";
						echo $link->name;
						echo "</a>";
					}
					?>
				</div>
			</div>
			<div class="right-side">
				<div id="messages">
					<?php
					foreach ($messages->getAll() as $message) {
						echo "<div class='message'>";
						echo $message;
						echo "</div>";
					}
					?>
				</div>
				<?php include $includeTemplate; ?>

			</div>
			<div class = "clear"></div>
		</section>
		<footer>
			2007 - 2014 Katedra informatiky a výpočetní techniky, Západočeská univerzita Plzeň
		</footer>
	</body>
</html>

