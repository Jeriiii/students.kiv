<h1>Správa uživatelů</h1>
<div class="container-table">
	<h3>Administrátoři</h3>
	<?php include 'forms/adminForm.php'; ?>
	<table class="table table-striped">
		<thead>
		<th>Login</th>
		<th></th>
		</thead>
		<tbody>
			<?php
			foreach ($admins as $admin) {
				echo "<tr>";
				echo "<td>$admin->name</td>";
				echo "<td class='td-action-short'>";
				$id = $admin->id;
				$name = $admin->name;
				$tittle = "Smazat administrátora";
				$message = "Opravdu chcete smazat administráotra?";
				$link = "?do=delete-admin&id=$admin->id";
				include 'modals/bootstrapModal.php';
				echo "</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>