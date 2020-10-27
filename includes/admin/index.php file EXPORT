<!-- index.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Export ke Excel</title>
</head>
<body>
	<form method="POST" action="export.php" id="form_content">
		<table border="1" id="table_content">
			<tr>
				<th>NIS</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Jurusan</th>
			</tr>
			<tr>
				<td>111</td>
				<td>Yobi</td>
				<td>X</td>
				<td>RPL</td>
			</tr>
			<tr>
				<td>112</td>
				<td>Yoba</td>
				<td>X</td>
				<td>RPL</td>
			</tr>
			<tr>
				<td>113</td>
				<td>Yobu</td>
				<td>X</td>
				<td>RPL</td>
			</tr>
			<tr>
				<td>114</td>
				<td>Yobe</td>
				<td>X</td>
				<td>RPL</td>
			</tr>
		</table>
		<input type="hidden" name="file_content" id="file_content">
		<br>
		<button type="submit" name="export" id="export">Export</button>
	</form>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$("#export").click(function() {
			var table_content = '<table>';
			table_content += $('#table_content').html();
			table_content += '</table>';
			$("#file_content").val(table_content);
			$('#form_content').html();
		});
	});
</script>