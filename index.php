<?php include('uploadimg.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload files to database</title>
	<style>
		* {padding: 0; margin: 0; box-sizing: border-box;}
		body {
			width: 100vw;
			padding: 10px 200px;
			font-family: arial;
		}
		form {
			padding: 10px 12px;
		}
		textarea {
			width: 500px;
			height: 200px;
			margin: 4px 0;
			padding: 4px;
			resize: none;
		}
		button {
			padding: 10px 14px;
			margin: 10px 0;
		}
		.render-page {
			background: #ccc;
			width: 100%;
			padding: 10px 12px;
		}
		.render-here {
			width: 100%;
			display: flex;
			flex-direction: column-reverse;
		}
		.img-div {
			width: 100%;
			margin: 8px 0;
			display: flex;
			flex-direction: row;
		}
		img {
			max-height: 480px;
			width: 60%;
			box-shadow: 4px 4px 12px #000;
			margin: 0 12px;
			border-radius: 4px;
		}
	</style>
</head>
<body>
	<form action="uploadimg.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="size" value="1000000">
		<input type="file" name="image"><br>
		<textarea name="text" placeholder="Write about your image..."></textarea><br>
		<button type="submit" name="upload">Upload</button>
		<?php echo $msg;?>
	</form>
	<div class="render-page">
		<h2>Recent Posts</h2>
		<div class="render-here">
			<?php
				$row = "";
				$conn = mysqli_connect('localhost', 'root', '', 'fileupload');
				$get = "SELECT * FROM uploads";
				$res = mysqli_query($conn, $get);
				if (mysqli_num_rows($res) > 0) {
					while ($row = mysqli_fetch_assoc($res)) {
						echo "<div class='img-div'>";
							echo "<img src='uploads/".$row['image']."'>";
							echo "<p>".$row['text']."</p>";
						echo "</div>";
					}
				}
			?>
		</div>
	</div>
</body>
</html>
