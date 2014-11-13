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
					$id = $pg->id;
					$name = $pg->name;
					$tittle = "Smazat stránku";
					$message = "Opravdu chcete smazat stránku?";
					$link = "?do=delete-page&id=$id";
					include 'modals/bootstrapModal.php';
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
