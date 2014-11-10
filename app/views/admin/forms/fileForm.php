<form enctype="multipart/form-data" role="form" action="<?php echo $basePath . "/admin/files" ?>?do=submit-form&form=<?php echo $form; ?>" method="post">
	<div class="form-group">
		<label>Název souboru</label>
		<input name="name" type="text" class="form-control" placeholder="Název odkazu" required="" value="<?php if (isset($fileName)) echo $fileName; ?>">
	</div>
	<?php if (empty($hideFileInput)) { ?>
		<div class="form-group">
			<label>Soubor</label>
			<input type="file" name="fileToUpload" class="form-control" required="">
		</div>
	<?php } ?>
	<input type="hidden" name="pageId" value="<?php echo $pageId ?>">
	<input name="send" type="submit" value="Uložit" class="btn btn-primary" />
</form>
