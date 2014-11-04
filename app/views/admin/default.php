<h1>Správa stránek</h1>
<h3>Vložit novou stránku</h3>
<?php
$form = "newPageForm";
include 'forms/pageForm.php';
?>
<h3>Seznam stránek</h3>
<table class="table table-striped">
	<thead>
	<th>Název stránky</th>
	<th></th>
	<th></th>
</thead>
<tbody>
	<?php
	foreach ($pages as $pg) {
		echo "<tr>";
		echo "<td>$pg->name</td>";
		echo "<td><a href='$basePath/admin/changePage?id=$pg->id' class='btn btn-default'>Upravit/Přidat soubory</a></td>";
		if ($pg->form == 0) {
			echo "<td><a href='?do=delete-page&id=$pg->id' class='btn btn-danger'>Smazat</a></td>";
		} else {
			echo "<td><div class='label label-default'>s formulářem</div></td>";
		}
		echo "</tr>";
	}
	?>
</tbody>
</table>