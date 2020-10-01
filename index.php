<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload files using php</title>
</head>
<body>
	<form method="POST" action="upload.php" enctype="multipart/form-data">
		<input type="file" name="file">
		<button type="submit" name="upload">Upload</button>
	</form>
</body>
</html>