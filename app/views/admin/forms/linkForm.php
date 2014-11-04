<form role="form" action="<?php echo $basePath . "/admin/links" ?>?do=submit-form&form=<?php echo $form; ?>" method="post">
	<div class="form-group">
		<label>Název odkazu</label>
		<input name="name" type="text" class="form-control" placeholder="Název odkazu" required="" value="<?php if (isset($name)) echo $name; ?>">
	</div>
	<div class="form-group">
		<label>Url</label>
		<input name="url" type="text" class="form-control" placeholder="Odkaz" required="" value="<?php if (isset($url)) echo $url; ?>">
	</div>
	<input name="send" type="submit" value="Odeslat" class="btn btn-primary" />
</form>
