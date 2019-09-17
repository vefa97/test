<?php require ("Model/conf.php");
if (isset($_SESSION['login'])) {
  if ($_SESSION['login']==true) {
    echo "<script>setTimeout(function(){location.replace('admin.php')},1);</script>";
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin giriş</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Admin Panel Girişi </b></a>
      </div>
      <div class="login-box-body">
        <?php if (!$_POST) {

         ?>
         <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email1">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password1">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>

      <?php }
      else{
        if (!empty($_POST['email1']) && !empty($_POST['password1'])) {
          $email = $_POST['email1'];
          $select = mysqli_query($conf,"SELECT email,password FROM `admin_panel_users` WHERE email='$email'");
          if ($select) {
            if (mysqli_num_rows($select)==1) {
              $row = mysqli_fetch_assoc($select);
              $password = $_POST['password1'];
              if ($row['password']==$password) {
                $_SESSION['login'] = true;
                $_SESSION['email'] = $email;
                echo "<script>setTimeout(function(){location.replace('admin.php')},1);</script>";;   
              }
              else{
                echo "<h3>Password is wrong</h3> !
                <script>setTimeout(function(){location.replace('login.php')},1000);</script>";
              }
            }
            else{
              echo "<h1>This email is not registered !</h1>
              <script>setTimeout(function(){location.replace('login.php')},2000);</script><br>
              ";
            }
          }
          else{
            echo "Something is wrong !";
          }
        }
        else{
          echo "You have to complete all area
          <script>setTimeout(function(){location.replace('login.php')},1000);</script>";
        }
      }
      ?>

    </div>
  </div>

  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../../plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>
</html>
<?php } ?>