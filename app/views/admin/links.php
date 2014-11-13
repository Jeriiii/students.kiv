<h1>Správa linků</h1>
<h3>Seznam odkazů</h3>
<div class="container-table">
	<table class="table table-striped">
		<thead>
		<th>Název</th>
		<th>Akce</th>
		</thead>
		<tbody>
			<?php
			foreach ($links as $link) {
				echo "<tr>";
				echo "<td>$link->name</td>";
				echo "<td class='td-action'><a href='$basePath/admin/changeLink?id=$link->id' class='btn btn-default'>Upravit</a> ";
				$id = $link->id;
				$name = $link->name;
				$tittle = "Smazat odkaz";
				$message = "Opravdu chcete smazat odkaz?";
				$link = "?do=delete-link&id=$link->id";
				include 'modals/bootstrapModal.php';
				echo "</tr>";
			}
			?>
		</tbody>
	</table>

	<h3>Vložit nový odkaz</h3>
	<?php
	$form = "newLinkForm";
	include 'forms/linkForm.php';
	?>
</div>
