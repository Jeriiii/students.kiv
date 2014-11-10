<h1>Správa stránek</h1>
<h3>Vložit novou stránku</h3>
<a href="<?php echo $basePath ?>/admin/newPage" class="btn btn-primary">Nová stránka</a>
<h3>Seznam stránek</h3>
<div class="container-table">
	<table class="table table-striped">
		<thead>
		<th>Název stránky</th>
		<th></th>
		</thead>
		<tbody>
			<?php
			foreach ($pages as $pg) {
				echo "<tr>";
				echo "<td>$pg->name</td>";
				echo "<td class='td-action'><a href='$basePath/admin/changePage?id=$pg->id' class='btn btn-default'>Upravit</a>";
				if ($pg->form == 0) {
					echo "
					<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modal-$pg->id'>
  Smazat
</button>
					<div id='modal-$pg->id' class='modal fade'>
						<div class='modal-dialog'>
						  <div class='modal-content'>
							<div class='modal-header'>
							  <h4 class='modal-title'>Smazat stránku</h4>
							</div>
							<div class='modal-body'>
							  <p>Opravdu chcete smazat stránku $pg->name</p>
							</div>
							<div class='modal-footer'>
							  <a href='?do=delete-page&id=$pg->id' class='btn btn-danger'>Smazat</a>
							  <button type='button' class='btn btn-default' data-dismiss='modal'>Zavřít</button>
							</div>
						  </div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					  </div><!-- /.modal -->";
				} else {
					echo "<div class='label label-default'>s formulářem</div>";
				}
				echo "</td></tr>";
			}
			?>
		</tbody>
	</table>
</div>
<p>
	* stránky s formulářem nejde mazat. Formulář na kontakty se neukládá na server, ale posílá se emailem.
</p>
<p>
	** formuláře pak naleznete vždy v views/názevControleru/forms. Tedy pro FrontControler to bude
	views/front/forms
</p>
