<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>
<title>Claybrook Zoo </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.php">Claybrook Zoo </a></h1>
      </div>
      <div class="menu_nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="species.php">Animals</a></li>
          <li><a href="sponsor.php">Sponsors</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <li class="active"><a href="login.php">Login</a></li>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
  </div>


<?php
include('db/db_connect.php');
if (isset($_POST['login'])){ //when form submitted or login button is pressed
  //get details from users table by username 
  $stmt = $pdo-> prepare("SELECT * FROM tb_user_details WHERE username= :username");
  $criteria = [
  'username' => $_POST['username'],
  ];
  $stmt->execute($criteria);
  if($stmt ->rowCount() > 0){
     $row = $stmt ->fetch();
    if(password_verify($_POST['password'], $row['password'])){ //checks the password entered and the password in the database
      $_SESSION['sessUserId'] = $row['user_id'];
      $_SESSION['sessUserType'] = $row['user_type'];
      if($_SESSION['sessUserType'] == 'admin') //if the user is admin
        header('Location:adminindex.php'); // go to admin index page
      else
        header('Location:index.php'); //else go to index home page
      }
  else{
    $showError = '<p> Login Failed. Please Try Again.</p>'; //display error message
  }
}
else
  $showError ='<p> Login Failed. Please Try Again.</p>'; //display error message
}
?>
 
 <div class="content">
  <div class="content_resize Content_resize">
    <!-- Form for the login page -->
    <form action="login.php" method="post" >
      <table cellspacing="10">
        <h2>LOGIN PAGE. .</h2>
        <tr>
          <td colspan="2"><?php echo @$showError;?></td> <!-- shows error message in this column -->
        </tr>
        <tr>
          <td>Username: </td>
          <td><input type="username" placeholder="Enter Your Username" name="username" required/></td>
        </tr>
        <tr>
          <td>Password: </td>
          <td><input type="password" placeholder="Enter Your Password" name="password" required/></td>
        </tr>
        <tr>
          <td colspan="1" align="center"><input type="submit" value="Login" name="login"/>
        </tr>
        <tr>
          <td> <div class="register">
            <p>Don't have an account? <a href="register.php"><br>  Sign Up</a>.</p> <!-- Redirect to registration page if not registered -->
            </div></td>
        </tr>
      </table>
    </form>
  </div>
</div>

  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2>About Zoo</h2>
        <img src="images/zoologo.jpg" width="80" height="100" alt="" />
          <p>Claybrook Zoo is a small family-oriented zoo in the Northwest of England. Established in 1965, the zoo has a long history of providing educational support resources for members of the public to enhance their visiting experience. </p>
        </div>
      </div>
      <div class="col c3">
        <h2>Image Galley</h2>
        <img src="images/lion.jpg" alt="" /> 
        <img src="images/panda.jpg" alt="" /> 
        <img src="images/monkey.jpg" alt="" /> 
        <img src="images/crocodile.jpg" alt="" /> 
        <img src="images/bird.jpg" alt="" /> 
        <img src="images/fish.jpg" alt="" /> 
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">&copy; Copyright ClayBrook Zoo 2020</p>
      <ul class="fmenu">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="species.php">Animals</a></li>
        <li><a href="sponsor">Sponsors</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>
  <script type="text/javascript" src="js/cufon-yui.js"></script>
  <script type="text/javascript" src="js/arial.js"></script>
  <script type="text/javascript" src="js/cuf_run.js"></script>
</body>
</html>










