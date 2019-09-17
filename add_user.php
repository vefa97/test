<?php include ('Model/conf.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add user</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="add_user.css">
</head>
<body>
	<div class="main-area">
		<div class="form">
			<h1 style="text-align: center;color: red;border-bottom: 1px dashed black">Add user</h1>
			<?php if (!$_POST) {
				# code...
			 ?>
			<form action="" method="POST">
				<div class="form-group col-12">
					<label for="exampleInputEmail1">Name</label>
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name" name="name">
				</div>
				<div class="form-group col-12">
					<label for="exampleInputEmail1">Email</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" name="email">
				</div>
				<div class="form-group col-12">
					<label for="exampleFormControlTextarea1">Text</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text"></textarea>
				</div>
				<button type="submit" class="btn btn-primary col-12">Submit</button>
				
			</form>
			<?php }
			else{
				if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['text']) ){
					$name = $_POST['name'];
					$email = $_POST['email'];
					$text = $_POST['text'];
					$insert = mysqli_query($conf,"INSERT INTO `users`(`name`, `email`, `textarea`) VALUES ('$name','$email','$text')");
					if ($insert) {
						echo "<script> alert('Data Added :)')
							setTimeout(function(){location.replace('add_user.php')},1)
						 </script>
						";	
					}
					else{
						echo "Connection is failed";
					}
				}
				else{
					echo "<script> alert('you may fill all area !') </script>";
				}
			} ?>
		</div>
	</div>
</body>
</html>