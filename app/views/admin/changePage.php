<h1>Změna stránky</h1>
<?php
$form = "changePageForm&id=$pageId";
include 'forms/pageForm.php';
?>
<h3>Připojené soubory</h3>
<?php
if (empty($files)) {
	echo "Zatím nemáte připojené žádné soubory.";
} else {
	?>
	<table class="table table-striped">
		<thead>
		<th>Název souboru</th>
		<th></th>
		<th></th>
	</thead>
	<tbody>
		<?php
		foreach ($files as $file) {
			echo "<tr>";
			echo "<td><a href='$basePath/files/$file->id.$file->suffix'>$file->name</a></td>";
			echo "<td class='td-action'><a href='$basePath/admin/changePage?id=$file->id' class='btn btn-default'>Upravit</a> ";
			if ($file->form == 0) {
				echo " <a href='?do=delete-page&id=$file->id' class='btn btn-danger'>Smazat</a>";
			} else {
				echo " <div class='label label-default'>s formulářem</div>";
			}
			echo "</td></tr>";
		}
		?>
	</tbody>
	</table>
	<?php
}
$form = "newFileForm";
include 'forms/fileForm.php';
?>

