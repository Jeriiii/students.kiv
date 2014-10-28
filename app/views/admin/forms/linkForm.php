<form role="form" action="<?php echo $basePath . "/admin/links" ?>?do=submit-form&form=linkNewForm" method="post">
	<div class="form-group">
		<label>Název odkazu</label>
		<input name="name" type="text" class="form-control" placeholder="Název odkazu">
	</div>
	<div class="form-group">
		<label>Url</label>
		<input name="url" type="text" class="form-control" placeholder="Odkaz">
	</div>
	<input name="send" type="submit" value="Odeslat" class="btn btn-primary" />
</form>
