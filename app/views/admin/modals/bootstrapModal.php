<!--
Dekladujte proměnné
ID - identifikátor objektu na stránce,
NAME - název objektu,
TITTLE - např. smazat stránku
MESSAGE - var. hláška
LINK - Link na smazání
-->

<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modal-<?php echo $id ?>'>
	Smazat
</button>
<div class='modal fade' id='modal-<?php echo $id ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title'><?php echo $tittle ?></h4>
			</div>
			<div class='modal-body'>
				<p><?php echo $message ?></p>
			</div>
			<div class='modal-footer'>
				<a href='<?php echo $link ?>' class='btn btn-danger'>Smazat</a>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Zavřít</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
