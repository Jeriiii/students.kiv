<form action="<?php echo $basePath . "/" . $page->url ?>?do=submit-form&form=contactForm" method="post">
	<div>
		<textarea name="note" placeholder="popište svůj problém..." rows="4" cols="50"></textarea>
	</div>
	<input name="send" type="submit" value="Odeslat" />
</form>