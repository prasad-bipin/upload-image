<?php
$conn = mysqli_connect('localhost', 'root', '', 'fileupload');
if(!$conn) {
	die("Not connected! ".mysqli_connect_error());
} else {
	echo "<h3>Connected!</h3><hr>";
}
$msg = "";
if (isset($_REQUEST["upload"])) {
	// File details
	$imgName = $_FILES['image']['name'];
	$imgTmpName = $_FILES['image']['tmp_name'];
	$imgError = $_FILES['image']['error'];

	// Getting text from textarea
	$txt = $_REQUEST['text'];

	// Getting, checking and validating image
	$fileseparate = explode('.', $imgName);

	$fileextcheck = strtolower(end($fileseparate));
	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileextcheck, $allowed)) {
		if ($imgError === 0) {
			// File new name for supporting duplicate file
			$fileNewName = uniqid("$fileseparate[0]_", true).".".$fileextcheck;

			// Destination
			$target = "uploads/".$fileNewName;

			// Insert to database
			$sql = "INSERT INTO uploads(image, text) VALUES('$fileNewName', '$txt')";
			$result = mysqli_query($conn, $sql);
			if (!$result) {
				die("Unable to upload. ".mysqli_error($conn));
			}

			// Move uploaded image to folder
			if (move_uploaded_file($imgTmpName, $target)) {
				$msg = "<h3>Image Uploaded Successfully!</h3>";
			} else {
				$msg = "<h3>Unable to upload image.</h3>";
			}

		} else {
			echo "Error in Image!";
		}
	} else {
		echo "Unsupported file format: $imgName. Allowed jpg, jpeg, png files only.";
	}


	// Redirect to Form page
	header("Location: index.php?uploaded_successfylly");
}




?>
