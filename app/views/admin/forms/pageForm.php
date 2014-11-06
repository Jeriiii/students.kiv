<form role="form" action="<?php echo $basePath . "/admin/" ?>?do=submit-form&form=<?php echo $form ?>" method="post">
	<div class="form-group">
		<label>Název stránky</label>
		<input name="name" type="text" class="form-control" placeholder="Název stránky" required="" value="<?php if (isset($name)) echo $name; ?>" >
	</div>
	<div class="form-group">
		<label>Text stránky</label>
		<textarea class="form-control" name="content" placeholder="Text stránky" rows="4" cols="50"><?php if (isset($content)) echo $content; ?></textarea>
	</div>
	<input name="send" type="submit" value="Odeslat" class="btn btn-primary" />
</form>

