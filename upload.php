<?php

if (isset($_REQUEST["upload"])) {
	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName); // separates file name by '.'
	$fileActualExt = strtolower(end($fileExt)); /* converts separated names to lowercase and selects end part i.e. extension part */

	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 100000) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: index.php?uploaded_successfylly");
			} else {
				echo "Your file size is too big!";
			}
		} else {
			echo "There is an error uploading the file!";
		}
	} else {
		echo "You can't upload files of this type!";
	}
}
?>