<form role="form" class="form-inline" action="<?php echo $basePath . "/admin/admins" ?>?do=submit-form&form=adminNewForm" method="post">
	<div class="form-group">
		<label>Orion login</label>
		<input name="login" type="text" class="form-control" placeholder="Orion login" required="">
	</div>
	<input name="send" type="submit" value="Vytvořit" class="btn btn-primary" />
</form>
