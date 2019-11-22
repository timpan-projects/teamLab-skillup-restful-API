<?php
//Using POST body to upload record to database
//Try and move image uploading to this phase afterwards...
	//if ($_FILES["image"] != null) {
	//	$target_dir = "../uploads/guests/";
	//	if (!file_exists($target_dir)) {
    //		mkdir($target_dir, 0777, true);
	//	}
	//	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	//	$uploadOk = 1;
	//	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	//	// Check if image file is a actual image or fake image
	//	if(isset($_POST["submit"])) {
	//	    $check = getimagesize($_FILES["image"]["tmp_name"]);
	//	    if($check !== false) {
	//	        echo "File is an image - " . $check["mime"] . ".";
	//	        $uploadOk = 1;
	//	    } else {
	//	        echo "File is not an image.";
	//	        $uploadOk = 0;
	//	    }
	//	}
	//}
	
	// Check if file already exists
	//if (file_exists($target_file)) {
	//    echo "Sorry, file already exists.";
	//    $uploadOk = 0;
	//}
	//// Check file size
	//if ($_FILES["fileToUpload"]["size"] > 500000) {
	//    echo "Sorry, your file is too large.";
	//    $uploadOk = 0;
	//}
	//// Allow certain file formats
	//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	//&& $imageFileType != "gif" ) {
	//    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	//    $uploadOk = 0;
	//}


	//// Check if $uploadOk is set to 0 by an error
	//if ($uploadOk == 0)
    //	echo "Sorry, your file was not uploaded.";
	//// if everything is ok, try to upload file
	//else {
	//    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	//        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
	//    } else {
	//        echo "Sorry, there was an error uploading your file.";
	//    }
	//}
	
	//Get POST body
	$body = json_decode(file_get_contents('php://input'), true);

	$id = $body['id'];
	$title = $body['title'];
	$description = $body['description'];
	$price = $body['price'];
	$image_path = '';
	if ($body['image_path'] != null)
		$image_path = 'uploads/guests/' . $body['image_path'];
	//'uploads/guests/' . basename( $_FILES["image"]["name"]);
	//round(microtime(true) * 1000); //use timestamp as image name, combine username after login control
	
	//database connection
	$host = '127.0.0.1';
	$user = 'root';
	$password = '';
	$db ='teamlab_practice';
	
	$connection = mysqli_connect($host,$user,$password,$db);
	echo "<br>Establishing database connection...<br>";
	if($connection)
	{
		echo "Connection success!<br>";
		echo"Updating record in database...<br>";
		$sql = "UPDATE merchandise SET title = '$title', description = '$description', price = '$price', image_path = '$image_path' WHERE id = '$id'";
		if ($connection->query($sql) === TRUE)
		{
   			echo "Record updated successfully";
		}
		else
		{
		    echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
	else
	{
	   echo "db connection error because of".mysqli_connect_error()."<br>";
	}
	
?>