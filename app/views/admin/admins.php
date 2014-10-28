<h1>Správa uživatelů</h1>
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
		echo "<td><a href='?do=delete-admin&id=$admin->id' class='btn btn-danger'>Smazat</a></td>";
		echo "</tr>";
	}
	?>
</tbody>
</table>
