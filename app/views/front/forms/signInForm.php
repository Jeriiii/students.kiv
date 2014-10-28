<form action="<?php echo $basePath . "/" . $page->url ?>?do=submit-form&form=signinForm" method="post">
	<label>Orion login:</label>
	<div>

		<input name="login" type="text" placeholder="Orion Login" />
	</div>
	<label>Heslo:</label>
	<div>
		<input name="password" type="password" placeholder="Heslo" rows="4" />
	</div>
	<input name="send" type="submit" value="Přihlásit" />
</form>