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
				echo "<td class='td-action-long'><a href='$basePath/admin/changePage?id=$pg->id' class='btn btn-default'>Upravit/Přidat soubory</a>";
				if ($pg->form == 0) {
					echo "<a href='?do=delete-page&id=$pg->id' class='btn btn-danger'>Smazat</a>";
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
