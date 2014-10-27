<form action="<?php echo $basePath . "/" . $page->url ?>?do=submit-form&form=signinForm" method="post">
	<div>
		<input name="login" placeholder="Orion Login" />
	</div>
	<div>
		<input name="password" placeholder="Heslo" rows="4" />
	</div>
	<input name="send" type="submit" value="Odeslat" />
</form>