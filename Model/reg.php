<?php require ("conf.php");
	if (isset($_SESSION['login'])) {
		if ($_SESSION['login']==true) {
			echo "<script>setTimeout(function(){location.replace('home.php')},1);</script>";
		}
		else{
			echo "Error 404";
		}
	}
	else{
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<style>
		input{width: 250px;padding: 10px 0;}
		button{padding: 10px 30px;background-color: orange;color: white;font-weight: 700}
	</style>
</head>
<body>
	<center>
		<h2>Sign Up page</h2>
		<?php if (!$_POST) {
			# code...
		?>
		<form action="" method="POST" enctype="multipart/form-data"> 
			<input type="text" name="name1" placeholder="name" required=""><br><br>
			<input type="text" name="surname1" placeholder="surname" required=""><br><br>
			<input type="email" name="email1" placeholder="email" required=""><br><br>
			<input type="password" name="password1" placeholder="password" required=""><br><br>
			Choose your photo: <input type="file" name="profile_photo1"><br><br>
			<button type="submit" class="confir">Sign Up</button>
		</form><br><br>
		<?php } 
			else{
				if (!empty($_POST['name1']) && !empty($_POST['surname1']) && !empty($_POST['email1']) && !empty($_POST['password1']) && $_FILES['profile_photo1']) {
					$email = $_POST['email1'];

					$select = mysqli_query($conf,"SELECT email FROM `user_info` WHERE email='$email'");
					$photo_types = ["image/jpg","image/png","image/jpeg","image/bmp","image/webp"];
					$profile_photo = $_FILES['profile_photo1'];
					
					if (in_array($profile_photo['type'], $photo_types)) {
						if (mysqli_num_rows($select)==0) {
							$name = $_POST['name1'];
							$surname = $_POST['surname1'];
							$password = crc32(md5(sha1($_POST['password1'])));
							
							$exp = explode(".", $profile_photo['name']);
							$photoNewName = rand(999999,100000000000000) . "." .end($exp);

							if (move_uploaded_file($profile_photo['tmp_name'], 'images/'.$photoNewName)) {
								if ($profile_photo['size']> 40*1024) {
									echo "this image is very large size
									<script>setTimeout(function(){location.replace('reg.php')},1100);</script>";
								}
								else{
									$insert = mysqli_query($conf,"INSERT INTO `user_info`(`name`, `surname`, `email`, `password`, `profile_image`) VALUES ('$name','$surname','$email','$password','$photoNewName')");

									if ($insert) {
										$_SESSION["login"] = true;
										$_SESSION['email'] = $email;
										echo "Your information added
										<script>setTimeout(function(){location.replace('home.php')},1500);</script>";
									}
									else{
										echo "Something is wrong";
									}
								}
							}
							else{
								echo "Something is wrong";
							}

						}
						else{
							echo "This email has registered this site!
							<script>setTimeout(function(){location.replace('login.php')},1500);</script>";
						}
					}
					else{
						echo "This is not image format !
						<script>setTimeout(function(){location.replace('reg.php')},1500);</script>";
					}
				}
				else{
					echo "You have to complete all register area
					<script>setTimeout(function(){location.replace('reg.php')},1500);</script>";
				}

			}

		 ?><br><br>
		<a href="login.php" style="text-decoration: none;color: white;font-size: 20px;padding: 5px 30px;background: red;">Log in</a>
	</center>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript">
		$(".confir").click(function(e){
			var c = confirm("are you sure?");
			if (c!=true) {
				e.preventDefault();
			}
		});
	</script>
</body>
</html>
<?php } ?>