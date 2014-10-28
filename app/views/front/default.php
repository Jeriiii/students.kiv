<article>
	<h1><?php echo $page->name ?></h1>
	<?php echo $page->content ?>
	<?php if ($page->form == 1) include 'forms/contactForm.php'; ?>
	<?php if ($page->form == 2) include 'forms/signInForm.php'; ?>
</article>
<section class="files">
	<?php
	if (!empty($files)) {
		echo "<h4>Soubory:</h4>";
	}
	foreach ($files as $file) {
		echo "<a href='$basePath/files/$file->id.$file->suffix'>";
		echo $file->name;
		echo "</a>";
	}
	?>
</section>

