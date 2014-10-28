<h1>Správa linků</h1>
<h3>Vložit nový odkaz</h3>
<?php include 'forms/linkForm.php'; ?>
<h3>Seznam odkazů</h3>
<table class="table table-striped">
	<thead>
	<th>Název</th>
	<th></th>
</thead>
<tbody>
	<?php
	foreach ($links as $link) {
		echo "<tr>";
		echo "<td>$link->name</td>";
		echo "<td><a href='$basePath/admin/changeLink?id=$pg->id' class='btn btn-default'>Upravit</a></td>";
		echo "<td><a href='?do=delete-link&id=$link->id' class='btn btn-danger'>Smazat</a></td>";
		echo "</tr>";
	}
	?>
</tbody>
</table>

