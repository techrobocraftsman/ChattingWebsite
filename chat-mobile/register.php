<?php

	require_once('initialize.php');
	session_start();
	if(isset($_SESSION['loggedin']))header('location: chatting.php');

	$allowed_extensions = array('jpg','png','gif','jpeg');
	$error = array();
	$pass = FALSE;
	
	if(isset($_POST['reg'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$file_name = explode('.',$_FILES['userfile']['name']);
		$file_ext = end($file_name);
		$img_dir = 'images/'.$username.$email.rand(1,1000).'.'.$file_ext;

		if(in_array($file_ext , $allowed_extensions)){
			$pass = true;
		}
		else  $error['warning'] = 'Please Browse an Profile picture';

		$emailase = $connection->query("SELECT * FROM ".$user_table." WHERE email='$email'");
		
		if(mysqli_num_rows($emailase)>=1)$error['warning'] = "Email already exists";
		elseif($email != NULL && $password != NULL && $pass){
			$query = $connection->query("INSERT INTO ".$user_table." (username,email,password,img_dir) VALUES ('$username','$email','$password','$img_dir')");
			if($query){
				if(!isset($_SESSION['cropped_image']))
                    move_uploaded_file($_FILES['userfile']['tmp_name'], $img_dir);
				else file_put_contents($img_dir, $_SESSION['cropped_image']);
				if(!isset($error['success']))$error['success'] = 'Successfully registered!';
			}
		}
		else if(!isset($error['warning']))$error['warning'] = 'Fill all the fields';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon.ico">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" integrity="sha512-NCJ1O5tCMq4DK670CblvRiob3bb5PAxJ7MALAz2cV40T9RgNMrJSAwJKy0oz20Wu7TDn9Z2WnveirOeHmpaIlA==" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js" integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA==" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
        
	<div class="box register">
		<h2>Create an account</h2>
		<form action="" method="POST" class="userregistration" enctype="multipart/form-data">
			<input class="my-inputs" type="text" name="username" placeholder="User name">
			<input class="my-inputs" type="email" name="email" placeholder="Email">
			<input class="my-inputs" type="password" name="password" placeholder="Password">
			<input class="my-inputs image" type="file" name="userfile">

			<input class="btn btn-outline-primary" type="submit" value="Register" name="reg">
		</form>
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-lg modal-fullscreen-sm-down" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">  
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="image">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
		<div class="success"><?php if(isset($error['success']))echo $error['success'];?></div>
		<div class="warning"><?php if(isset($error['warning']))echo $error['warning'];?></div><br>
		Already Have an account? <a class="login" href="login.php">please log in</a>
	</div>

<script>
	
    var bs_modal = $('#modal');
    var image = document.getElementById('image');
    var cropper,reader,file;
   

    $("body").on("change", ".image", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            bs_modal.modal('show');
        };


        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    bs_modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "upload.php",
                    data: {image: base64data},
                    success: function(data) { 
                        bs_modal.modal('hide');
                    //    alert("success upload image");
                    }
                });
            };
        });
    });


</script>

</body>
</html>